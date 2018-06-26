<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Core\Configure;

/**
 * AttendanceCsvs Model
 *
 * @method \App\Model\Entity\AttendanceCsv get($primaryKey, $options = [])
 * @method \App\Model\Entity\AttendanceCsv newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AttendanceCsv[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AttendanceCsv|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AttendanceCsv|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AttendanceCsv patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AttendanceCsv[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AttendanceCsv findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AttendanceCsvsTable extends Table
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

        $this->setTable('attendance_csvs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->addBehavior('Josegonzalez/Upload.Upload', [
          'file_name' => [
            'path' => Configure::read('CSVUpload.uploadRelativePath'),
            'unlinkPath' => Configure::read('CSVUpload.uploadRelativePath'),
            'fields' => [
              'dir' => 'file_path'
            ],
            'nameCallback' => function ($data, $settings) {
              return time()."_". $data['name'];
            },
          ],
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

        return $validator;
    }
}
