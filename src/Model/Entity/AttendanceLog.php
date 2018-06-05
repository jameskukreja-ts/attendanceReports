<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AttendanceLog Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime $log_timestamp
 * @property int $employee_id
 * @property int $mode_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Employee $employee
 * @property \App\Model\Entity\Mode $mode
 */
class AttendanceLog extends Entity
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
        'log_timestamp' => true,
        'employee_id' => true,
        'mode_id' => true,
        'created' => true,
        'modified' => true,
        'employee' => true,
        'mode' => true
    ];
}
