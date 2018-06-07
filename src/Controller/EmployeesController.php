<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\I18n\FrozenTime;
use Cake\I18n\Time;
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
            
        ];
        $employees = $this->paginate($this->Employees);

        $this->set(compact('employees'));
    }

    /**
     * View method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($date, $id)
    {   
        if(!$this->Auth->user()){
            $this->viewBuilder()->layout('login-default');
        }
        
        $this->loadModel('AttendanceLogs');
        $report=$this->AttendanceLogs
                             ->findByEmployeeId($id)
                             ->contain(['Modes'])
                             ->toArray(); 
        
        $collection = new Collection($report); 
        $newCollection = $collection->map(function($value, $key){

            $timestamp = strtotime($value->log_timestamp);
            $date=date('d-m-Y' ,$timestamp) ; 
            $time=date('H-i-s' ,$timestamp) ; 
            return  ['date' => $date, 'time' => $time,'mode'=>$value->mode->name];   
        });



        $new=$newCollection->groupBy('date')->toArray();
        $details=$new[$date];
        $this->set(compact('details'));

    }

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
        }
        $this->loadModel('AttendanceLogs');
        $this->loadModel('Modes');

        
        $report=[];
        
        if ($this->request->is('post')) {
            $data=$this->request->getData();
            $employee=$this->Employees->findByOfficeId($data['office_id'])->first();
            $data['end_date']=new FrozenTime($data['end_date']);
            $data['end_date']=$data['end_date']->modify('+1 day');
            $data['start_date']=new FrozenTime($data['start_date']);
           
            if($employee){
                $attendanceLogs=$this->AttendanceLogs
                             ->findByEmployeeId($employee->id)
                             ->contain(['Modes'])
                             ->where(['log_timestamp >='=>$data['start_date'],'log_timestamp <'=>$data['end_date']])
                             ->order(['log_timestamp' => 'ASC'])
                             ->toArray(); 
                $collection = new Collection($attendanceLogs); 
                $newCollection = $collection->map(function($value, $key){

                    $timestamp = strtotime($value->log_timestamp);
                    $date=date('d-m-Y' ,$timestamp) ; 
                    $time=date('H-i-s' ,$timestamp) ; 
                    return  ['date' => $date, 'time' => $time];   
                });

                $new=$newCollection->groupBy('date')->map(function($value, $key){
                   
                    return  ['in'=>$value[0],'out'=>end($value)];  
                });
                $report=$new->toArray();

            }
             
        }

        $this->set(compact('employee'));
        $this->set(compact('report'));
       
    }

    public function employeeReport($id = null){
        $this->loadModel('AttendanceLogs');
        $reports=[];

        $employee = $this->Employees->get($id, [ ]);
        $attendanceLogs=$this->AttendanceLogs
                             ->findByEmployeeId($id)
                             ->contain(['Modes'])
                             ->order(['log_timestamp' => 'DESC'])
                             ->toArray(); 

        $collection = new Collection($attendanceLogs); 
        $newCollection = $collection->map(function($value, $key){

            $timestamp = strtotime($value->log_timestamp);
            $date=date('d-m-Y' ,$timestamp) ; 
            $time=date('H-i-s' ,$timestamp) ; 
            return  ['date' => $date, 'time' => $time];   
        });

        $new=$newCollection->groupBy('date')->map(function($value, $key){
           
            return  ['out'=>$value[0],'in'=>end($value)];  
        });
        $reports=$new->toArray(); 
       
        $this->set('employee', $employee);
        $this->set(compact('reports'));
       
    }





}
