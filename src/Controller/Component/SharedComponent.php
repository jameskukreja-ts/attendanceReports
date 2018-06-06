<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Collection\Collection;
use Cake\Utility\Text;

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

    public function getCsvData($tableName, $filePath, $headings = []){
        
      
        if (!file_exists($filePath) ) {
            
           // $this->out('File not found.');
            pr('here ');
            return false;
        }        
        ini_set('auto_detect_line_endings', true);
        $fp = fopen($filePath,'r');
        $data = array();
        while (($row = fgetcsv($fp, 0, "\t")) !== FALSE) {
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
            
           // $this->out('No Data found in the uploaded file.');
            return false;
        }

        return $tempData;
    }
}
