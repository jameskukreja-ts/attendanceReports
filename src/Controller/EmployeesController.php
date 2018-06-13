<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\I18n\FrozenTime;
use Cake\I18n\Time;
use Cake\I18n\Date;
use Cake\Log\Log;
use Cake\Collection\Collection;


/**
 * Employees Controller
 *
 * @property \App\Model\Table\EmployeesTable $Employees
 *
 * @method \App\Model\Entity\Employee[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmployeesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
   
    public function index()
    {
        $this->paginate = [
            'limit' => 10,
        ];
        $employees = $this->paginate($this->Employees);
        
        //$employees = $this->Employees->find()->toArray();

        $this->set(compact('employees'));
    }

    /**
     * View method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function view($date, $id)
    // {   
    //     if(!$this->Auth->user()){
    //         $this->viewBuilder()->layout('login-default');
    //     }
        
    //     $this->loadModel('AttendanceLogs');
    //     $report=$this->AttendanceLogs
    //                          ->findByEmployeeId($id)
    //                          ->contain(['Modes'])
    //                          ->toArray(); 
        
    //     $collection = new Collection($report); 
    //     $newCollection = $collection->map(function($value, $key){
    //         $timestamp = strtotime($value->log_timestamp);
    //         $date=date('d-m-Y' ,$timestamp) ; 
    //         $time=date('H-i-s' ,$timestamp) ; 
    //         return  ['date' => $date, 'time' => $time,'mode'=>$value->mode->name];   
    //     });

    //     $new=$newCollection->groupBy('date')->toArray();
    //     $details=$new[$date];
    //     $this->set(compact('date'));
    //     $this->set(compact('details'));
    // }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $employee = $this->Employees->newEntity();
        if ($this->request->is('post')) {
            $employee = $this->Employees->patchEntity($employee, $this->request->getData());
            if ($this->Employees->save($employee)) {
                
                $this->Flash->success(__('The employee has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The employee could not be saved. Please, try again.'));
        }
        
        $this->set(compact('employee'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $employee = $this->Employees->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $employee = $this->Employees->patchEntity($employee, $this->request->getData());
            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('The employee has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The employee could not be saved. Please, try again.'));
        }
        // $offices = $this->Employees->Offices->find('list', ['limit' => 200]);
        // $machineGenerateds = $this->Employees->MachineGenerateds->find('list', ['limit' => 200]);
        $this->set(compact('employee'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $employee = $this->Employees->get($id);
        if ($this->Employees->delete($employee)) {
            $this->Flash->success(__('The employee has been deleted.'));
        } else {
            $this->Flash->error(__('The employee could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['attendanceReport','view']);
    }

    public function isAuthorized($user)
    {
        // By default deny access.
        return true;
    }
    
    public function syncAttendance()
    {
        

        $this->loadModel('Modes');
        $this->loadComponent('Shared');
        $this->loadModel('AttendanceCsvs');
        $this->loadModel('AttendanceLogs');
        
        $attendanceCsv = $this->AttendanceCsvs->newEntity();
        
        if ($this->request->is('post')) {
            $data=$this->request->getData();
            if(!$data){
                $this->Flash->error(__("No file Entered"));
                 
            }
            
            $attendanceLogs=[];
            $attendanceCsv = $this->AttendanceCsvs->patchEntity($attendanceCsv, $data);
    
            if(!$this->AttendanceCsvs->save($attendanceCsv)){
                $this->Flash->error(__("not saved"));
            }else{
                $this->Flash->success(__("1: Csv File Saved in Database"));
            }
            $headings=['employee_id', 'timestamp', 'a', 'b', 'mode_id','c'];
            $fileData =$this->Shared->getCsvData('AttendanceLogs',$attendanceCsv->full_file_path, $headings);
            

            $employeeIds=$this->Employees->find()->combine('machine_generated_id','id')->toArray();
            $modes=$this->Modes->find()->combine('machine_mode_id','id')->toArray();
            
            foreach($fileData as $row){
                
                //Remove this line when you have added employees.
                
                if(!isset($employeeIds[$row['employee_id']])){
                    Log::write("debug","Machine generated id ".$row['employee_id']." does not have an associated employee on db.");
                    continue;
                }
                $data = [
                    'log_timestamp'=> (new FrozenTime($row['timestamp'])),
                    'employee_id'=> $employeeIds[$row['employee_id']],
                    'mode_id'=> $modes[$row['mode_id']]
                ];

                $attendanceLog =$this->AttendanceLogs->find()->where($data)->first();
                if($attendanceLog){
                    Log::write("debug",'Value already exists in Database.');
                    continue;
                }
                $attendanceLogs[]= $data;
            
            }
            if(empty($attendanceLogs)){
                Log::write("debug","No value to update in logs");
                $this->Flash->default(__("No new logs present in the provided file"));

            }else{

                $attendanceLogs=$this->AttendanceLogs->newEntities($attendanceLogs);
                
                if(!$this->AttendanceLogs->saveMany($attendanceLogs)){
                    $this->Flash->error(__("Logs not saved"));
                }else{

                    $this->Flash->success(__("2: Logs have been updated."));
                }
            }
        }
        $this->set(compact('attendanceCsv'));
    }

    public function attendanceReport(){

        if(!$this->Auth->user()){
            $this->viewBuilder()->layout('login-default');
        }else{
            $employees = $this->Employees->find()->combine('office_id', 'full_name');
        }
        $this->loadModel('AttendanceLogs');
                                 
        $report=[];
        $holidays=Configure::read('Holidays');
        $holidays = new Collection($holidays); 
        $holidays = $holidays->groupBy('date')->toArray();
        
        if ($this->request->is('post')) {

            $data=$this->request->getData();
             
            $employee=$this->Employees->findByOfficeId($data['office_id'])->first();
            $endDate =new FrozenTime($data['end_date']);
            $startDate =  new FrozenTime($data['start_date']);

            if($employee){
                $report=$this->AttendanceLogs->employeeAttendanceLogs($employee->id,$startDate,$endDate);
            }
            $this->set(compact('startDate', 'endDate'));
            $this->set(compact('employee'));

        }
        $details=$this->Employees->employeeDetail($report);
        $this->set(compact('report', 'employees','details'));

       
    }
    
    public function settings(){
        $this->loadModel('Settings');
        $data = array();
        $data=$this->request->getData();
        if ($this->request->is('post')) {
            $settings=[
                [
                 'id'=>1,
                 'value'=>$data['half_day_hours']  
                ],
                [
                 'id'=>2,
                 'value'=>$data['full_day_hours']  
                ]
            ];
            // pr($data);
            // pr($settings); die();
            $settings=$this->Settings->patchEntities($data,$settings);
            // pr($settings);die;
            if(!$this->Settings->saveMany($settings)){
                $this->Flash->error(__('Settings could not be saved'));
            }
            $this->Flash->success(__('Settings saved successfully'));
        }
    }
    public function aggregateReport(){
        $this->loadModel('AttendanceLogs');
        
        $report=[];
        $holidays=Configure::read('Holidays');
        $holidays = new Collection($holidays); 
        $holidays = $holidays->groupBy('date')->toArray();
        $employeeDetails=[];
        if ($this->request->is('post')) {

            $data=$this->request->getData();
             
            $employees=$this->Employees->find()->toArray();
            
            $endDate=new FrozenTime($data['end_date']);
            $startDate=new FrozenTime($data['start_date']);

            if($employees){
                foreach ($employees as $employee) {
                    $report=$this->AttendanceLogs->employeeAttendanceLogs($employee->id,$startDate,$endDate);
                    $employeeDetails[]=['id'=>$employee->id,'name'=>$employee->full_name,'report'=>$this->Employees->employeeDetail($report)];
                }
            }
            
        }
        //pr($employeeDetails);die;
        $this->set(compact('employeeDetails'));
        $this->set(compact('startDate', 'endDate'));
    }

}
