<?php
/**
 * Created by PhpStorm.
 * User: shri
 * Date: 10/5/18
 * Time: 5:01 PM
 */

main::start("example.csv");

class main{

    public static function start($fileName){

        $records = csv::getRecords($fileName); // get csv file records

        $table = html::generateTable($records); // generate table

        system::printTable($table);             // print html table
    }
}

class csv {

    static public function getRecords($filename){
        $file = fopen($filename,  "r");

        $fieldNames = array();

        $count = 0;

        while(! feof($file)) {

            $record = fgetcsv($file);
            if($count == 0){
                $fieldNames = $record; // get only field names
                $count++;

            }
            else
            {
                $records[] = recordFactory::create($fieldNames, $record);// get fieldNames and table data

            }
        }

        fclose($file);
        return $record;

    }

}

class record {
    public function __construct( array $fieldNames = null, array $values = null){
        $record = array_combine($fieldNames,$values);
        foreach ($record as $property => $value){

            $this->createProperty($property,$value);
        }
    }

    public function createProperty($name, $value){
        $this->{$name} = $value;
    }

    public function returnArray(){
        $array = (array) $this;
        return $array;
    }
 }

class recordFactory {
    public static  function  create( array $fieldNames = null, array  $values = null) {
        $record = new record($fieldNames, $values);

        return $record;

    }

}
