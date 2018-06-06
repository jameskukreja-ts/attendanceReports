<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\I18n\Time;

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
    public function view($id = null)
    {
        $employee = $this->Employees->get($id, [
            'contain' => ['AttendanceLogs']
        ]);

        $this->set('employee', $employee);
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
        $attendanceCsv = $this->AttendanceCsvs->newEntity();
        if ($this->request->is('post')) {
            $data=$this->request->getData();
            $attendanceCsv = $this->AttendanceCsvs->patchEntity($attendanceCsv, $data);
            if(!$this->AttendanceCsvs->save($attendanceCsv)){
                $this->Flash->error(__("not saved"));
            }
            $this->Flash->success(__("Saved"));
            $headings=['employee_id', 'timestamp', 'a', 'b', 'mode_id','c'];
            $fileData =$this->Shared->getCsvData('AttendanceLogs',$attendanceCsv->full_file_path, $headings);
            

            $employeeIds=$this->Employees->find()->combine('machine_generated_id','id')->toArray();
            $modes=$this->Modes->find()->combine('machine_mode_id','id')->toArray();
            die;
            foreach($filedata as $row){
                //Remove this line when you have added employees.
                if(!isset($employeeIds[$row['employee_id']])){
                    Log::write("Machine generated id ".$row['employee_id']." does not have an associated employee on db.");
                    continue;
                }

                $employees[]=[
                    'log_timestamp'=> $row['timestamp'],
                    'employee_id'=> $employeeIds[$row['employee_id']],
                    'mode_id'=> $modes[$row['mode_id']]
                ];
            }

        }
        $this->set(compact('attendanceCsv'));
    }

    public function attendanceReport(){

        $this->viewBuilder()->layout('login-default');
        $this->loadModel('AttendanceLogs');
        
        $report=[];
        
        if ($this->request->is('post')) {
            $data=$this->request->getData();
            $employee=$this->Employees->findByOfficeId($data['office_id'])->first();
           
            if($employee){
                $report=$this->AttendanceLogs
                             ->findByEmployeeId($employee->id)
                             ->contain('Employees')
                             ->where(['log_timestamp >='=>$data['start_date'],'log_timestamp <='=>$data['end_date']])
                             ->toArray();    
            }
             
        }
       
        $this->set(compact('report'));
       
    }
   

}
