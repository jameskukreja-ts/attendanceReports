<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * Shared component
 */
class SharedComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function getCsvData($tableName, $fileName, $headings = []){
        
        while(in_array($fileName, [null, false, ""])){
          
          $this->out('Filename not entered please try again.');
          $fileName = $this->in("Please enter the file name without the extension for ".$tableName);
        }

        $fileName = $fileName.'.csv';
        if (!file_exists($fileName) ) {
            
            $this->out('File not found.');
            return false;
        }        
        ini_set('auto_detect_line_endings', true);
        $fp = fopen($fileName,'r');
        $data = array();
        while (($row = fgetcsv($fp)) !== FALSE) {
          if(str_replace(" ", "", implode('', $row)) == ''){
            continue;
          }
          $data[] = $row;

        }
        if(empty($headings)){
	        $headings = $data[0];
	        unset($data[0]);
        }

        foreach ($headings as $key => $value) {
            $headings[$key] = strtolower(Text::slug($value, '_'));
        }
        
        $tempData = []; 
        foreach ($data as $key => $value) {

            $value = (new Collection($value))->map(function($val, $key){
                return trim($val);
            })->toArray();
          
            $tempData[] = array_combine($headings, $value);
        }
        if(empty($tempData)){
            
            $this->out('No Data found in the uploaded file.');
            return false;
        }

        return $tempData;
    }
}
