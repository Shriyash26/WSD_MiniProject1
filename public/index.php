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