<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Mode Entity
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $machine_mode_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\MachineMode $machine_mode
 * @property \App\Model\Entity\AttendanceLog[] $attendance_logs
 */
class Mode extends Entity
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
        'name' => true,
        'description' => true,
        'machine_mode_id' => true,
        'created' => true,
        'modified' => true,
        'machine_mode' => true,
        'attendance_logs' => true
    ];
}
