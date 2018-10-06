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
                var_dump($fieldNames);
                $count++;

            }
            else
            {
                var_dump($record); // get only table data

            }
        }

        fclose($file);
        return $record;

    }

}
