<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Core\Configure;

/**
 * Employees Model
 *
 * @property \App\Model\Table\OfficesTable|\Cake\ORM\Association\BelongsTo $Offices
 * @property \App\Model\Table\MachineGeneratedsTable|\Cake\ORM\Association\BelongsTo $MachineGenerateds
 * @property \App\Model\Table\AttendanceLogsTable|\Cake\ORM\Association\HasMany $AttendanceLogs
 *
 * @method \App\Model\Entity\Employee get($primaryKey, $options = [])
 * @method \App\Model\Entity\Employee newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Employee[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Employee|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Employee|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Employee patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Employee[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Employee findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EmployeesTable extends Table
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

        $this->setTable('employees');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->hasMany('AttendanceLogs', [
            'foreignKey' => 'employee_id',
            // 'dependent' => true,
            // 'cascadeCallbacks' => true
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
            ->scalar('first_name')
            ->maxLength('first_name', 255)
            ->requirePresence('first_name', 'create')
            ->notEmpty('first_name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 255)
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name');
        $validator
            ->scalar('office_id')
            ->maxLength('office_id', 255)
            ->requirePresence('office_id', 'create')
            ->notEmpty('office_id');

        $validator
            ->scalar('machine_generated_id')
            
            ->requirePresence('machine_generated_id', 'create')
            ->notEmpty('machine_generated_id');

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
        // $rules->add($rules->existsIn(['office_id'], 'Offices'));
        // $rules->add($rules->existsIn(['machine_generated_id'], 'MachineGenerateds'));

        return $rules;
    }
    public function employeeDetail($startDate,$endDate,$report){
        
        $date = $startDate;
        $halfdays=0;
        $workingdays=0;
        $absents=0;
        $fulldays=0;
        while($date <= $endDate){
            $status="";
            $weekEnd=date('l',strtotime($date));
            if(isset($report[$date->i18nFormat('dd-MM-yyyy')])){
                if($report[$date->i18nFormat('dd-MM-yyyy')]['duration']<8&&$report[$date->i18nFormat('dd-MM-yyyy')]['duration']>=4){
                    $status='Halfday';
                    $halfdays++;
                }elseif($report[$date->i18nFormat('dd-MM-yyyy')]['duration']<4){
                    $status='Absent';
                    $absents++;
                }else{
                     $status='Fullday';
                     $fulldays++;
                }
            }
            if(isset($holidays[$date->i18nFormat('dd-MM-yyyy')])){
                $status='Holiday';    
            }elseif($weekEnd=='Saturday'||$weekEnd=='Sunday'){
                $status='Weekend';
            }elseif(!isset($report[$date->i18nFormat('dd-MM-yyyy')])){
                $status='Absent';
                $absents++;
            }

        $date = $date->modify('+1 day');
        }
        $workingdays=$halfdays+$fulldays+$absents;
        return ['workingdays'=>$workingdays,'fulldays'=>$fulldays,'halfdays'=>$halfdays,'absents'=>$absents];
                               
    }
}
