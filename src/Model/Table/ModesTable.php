<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Modes Model
 *
 * @property \App\Model\Table\MachineModesTable|\Cake\ORM\Association\BelongsTo $MachineModes
 * @property \App\Model\Table\AttendanceLogsTable|\Cake\ORM\Association\HasMany $AttendanceLogs
 *
 * @method \App\Model\Entity\Mode get($primaryKey, $options = [])
 * @method \App\Model\Entity\Mode newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Mode[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Mode|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Mode|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Mode patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Mode[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Mode findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ModesTable extends Table
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

        $this->setTable('modes');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('MachineModes', [
            'foreignKey' => 'machine_mode_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('AttendanceLogs', [
            'foreignKey' => 'mode_id'
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmpty('description');

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
        $rules->add($rules->existsIn(['machine_mode_id'], 'MachineModes'));

        return $rules;
    }
}
