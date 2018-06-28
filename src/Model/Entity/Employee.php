<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Routing\Router;
/**
 * Employee Entity
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $office_id
 * @property int $machine_generated_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Office $office
 * @property \App\Model\Entity\MachineGenerated $machine_generated
 * @property \App\Model\Entity\AttendanceLog[] $attendance_logs
 */
class Employee extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'first_name' => true,
        'last_name' => true,
        'office_id' => true,
        'machine_generated_id' => true,
        'created' => true,
        'modified' => true,
        'office' => true,
        'machine_generated' => true,
        'attendance_logs' => true
    ];

    protected function _getFullName()
   {   //Was giving an error in new entity
        if(!isset($this->_properties['first_name']) && !isset($this->_properties['last_name'])){
            return false;
        }

        $name = $this->_properties['first_name'] .' '.$this->_properties['last_name'];
        
        return $name;
   }
}

