<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Core\Configure;

/**
 * AttendanceCsv Entity
 *
 * @property int $id
 * @property string $file_name
 * @property string $file_path
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class AttendanceCsv extends Entity
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
        'file_name' => true,
        'file_path' => true,
        'created' => true,
        'modified' => true
    ];

    protected $_virtual = ['full_file_path'];

    protected function _getFullFilePath(){
        if(isset($this->_properties['file_name']) && !empty($this->_properties['file_name'])) {
            return Configure::read('CSVUpload.uploadFullPath')."/".$this->_properties['file_name'];
        }
        return false;
    }
}