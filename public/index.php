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

//        $table = html::generateTable($records); // generate table

//        system::print($table);             // print html table
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
        var_dump($records);
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
class system{
    public static function print($value){
        echo $value;
    }

}
// get html header
class html_header{
    public static function getHtmlHeader(){
        $html_header = '<head>';
        $html_header .= '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">';
        $html_header .= '<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>';
        $html_header .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>';
        $html_header .= '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>';
        $html_header .= '</head>';
        return $html_header;
    }
}

// create html body
class html_body{
    public static function open_HtmlBody(){
        return '<body>';
    }
    public static function close_HtmlBody(){
        return '</body>';
    }
}

// create html table
class html_table{
    public static function open_htmlTable(){
        return '<table  class="table table-bordered table-striped">';
    }
    public static function close_htmlTable(){
        return '</table>';
    }

}