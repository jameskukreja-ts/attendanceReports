<?php
namespace App\Controller\Api;

use App\Controller\Api\ApiController;
use Cake\I18n\FrozenTime;
use Cake\I18n\Time;


/**
 * Employees Controller
 *
 * @property \App\Model\Table\EmployeesTable $Employees
 *
 * @method \App\Model\Entity\Employee[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmployeesController extends ApiController
{

    public function getLogsByDate($employeeId,$date){
    	$this->loadModel('AttendanceLogs');
        $date=new FrozenTime($date);
        $date1=$date->modify('+1 day');
        $details=$this->AttendanceLogs
                             ->findByEmployeeId($employeeId)
                             ->where(['log_timestamp >='=>$date,'log_timestamp <'=>$date1])
                             ->contain(['Modes'])
                             ->order(['log_timestamp' => 'ASC'])
                             ->map(function($value, $key){
                                $timestamp = strtotime($value->log_timestamp);
                                $value->time = date('H:i:s' , $timestamp);
                                return $value;
                             })
                             ->toArray();
        
        $this->set(compact('details'));
        $this->set('_serialize', ['details']);

    }
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['getLogsByDate']);
       
    }
    
}
