<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;

class Functions extends Controller {

    //
    private $failure = 400;
    
    public static function insertoDB($array, $tableName) {
        $timestime = time();
        $addsql = "";
        //$rand = substr(sha1(mt_rand()),7,20);;
        
        foreach ($array as $key => $value) {
           
            $addsql .= '`' . $key . '` = "' . trim($value) . '" , ';
        }
        $addsql = substr($addsql, 0, -2);
        // echo $addsql;
        $copysql = "INSERT INTO `$tableName` SET $addsql";
        $success = collect(DB::insert(DB::raw($copysql)));
        
         if($success){
             return $success;
        }else{
             return $failure;
        }
       
    }

  

}
