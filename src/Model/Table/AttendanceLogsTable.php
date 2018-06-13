<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\FrozenTime;
use Cake\I18n\Time;
use Cake\I18n\Date;
use Cake\Collection\Collection;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;

/**
 * AttendanceLogs Model
 *
 * @property \App\Model\Table\EmployeesTable|\Cake\ORM\Association\BelongsTo $Employees
 * @property \App\Model\Table\ModesTable|\Cake\ORM\Association\BelongsTo $Modes
 *
 * @method \App\Model\Entity\AttendanceLog get($primaryKey, $options = [])
 * @method \App\Model\Entity\AttendanceLog newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AttendanceLog[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AttendanceLog|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AttendanceLog|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AttendanceLog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AttendanceLog[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AttendanceLog findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AttendanceLogsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('attendance_logs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Employees', [
            'foreignKey' => 'employee_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Modes', [
            'foreignKey' => 'mode_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->dateTime('log_timestamp')
            ->requirePresence('log_timestamp', 'create')
            ->notEmpty('log_timestamp');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['employee_id'], 'Employees'));
        $rules->add($rules->existsIn(['mode_id'], 'Modes'));

        return $rules;
    }
    public function employeeAttendanceLogs($id,$startDate,$endDate){

         
        $this->Settings = TableRegistry::get('Settings');
        $settings=$this->Settings->find()->toArray();
        $holidays=Configure::read('Holidays');
        $holidays = new Collection($holidays); 
        $holidays = $holidays->groupBy('date')->toArray();
        $endDate1=$endDate->modify('+1 day');

        $attendanceLogs=$this
                     ->findByEmployeeId($id)
                     ->where(['log_timestamp >='=>$startDate,'log_timestamp <'=>$endDate1])
                     ->order(['log_timestamp' => 'ASC'])
                     ->toArray(); 
        $collection = new Collection($attendanceLogs); 
        $newCollection = $collection->map(function($value, $key){

            $timestamp = strtotime($value->log_timestamp);
            $date=date('d-m-Y' ,$timestamp) ; 
            $time=date('H:i:s' ,$timestamp) ; 
            return  ['date' => $date, 'time' => $time, 'timestamp' => $timestamp];   
        });
        
        $new=$newCollection->groupBy('date')->map(function($value, $key){
            $duration = (end($value)['timestamp'] -$value[0]['timestamp'])/3600;
            return  ['in'=>$value[0]['time'],'out'=>end($value)['time'], 'duration' => round($duration, 2)];  
        });
        $new=$new->toArray();
        $date = $startDate;
        $report=[];
        while($date <= $endDate){
            $status="";
            $weekEnd=date('l',strtotime($date));
            if(isset($new[$date->i18nFormat('dd-MM-yyyy')])){
                if($new[$date->i18nFormat('dd-MM-yyyy')]['duration']<$settings[1]->value&&$new[$date->i18nFormat('dd-MM-yyyy')]['duration']>=$settings[0]->value){
                    $status='Halfday';
                }elseif($new[$date->i18nFormat('dd-MM-yyyy')]['duration']<$settings[0]->value){
                    $status='Absent';
                }else{
                     $status='Fullday';
                }
                $report[]=[
                    'date'=>$date->i18nFormat('dd-MM-yyyy'),
                    'in'=>$new[$date->i18nFormat('dd-MM-yyyy')]['in'],
                    'out'=>$new[$date->i18nFormat('dd-MM-yyyy')]['out'],
                    'duration'=>$new[$date->i18nFormat('dd-MM-yyyy')]['duration'],
                    'status'=>$status
                ];
            }else{
                if(isset($holidays[$date->i18nFormat('dd-MM-yyyy')])){
                    $status='Holiday';    
                }elseif($weekEnd=='Saturday'||$weekEnd=='Sunday'){
                    $status='Weekend';
                }elseif(!isset($new[$date->i18nFormat('dd-MM-yyyy')])){
                    $status='Absent';
                }
                $report[]=[
                    'date'=>$date->i18nFormat('dd-MM-yyyy'),
                    'in'=>'-',
                    'out'=>'-',
                    'duration'=>'-',
                    'status'=>$status
                ];
            }  
            $date = $date->modify('+1 day');
        }
        return $report;

    }
}
