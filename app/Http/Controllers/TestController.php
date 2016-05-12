<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DateTime;
use DateInterval;
use Carbon\Carbon;
class TestController extends Controller
{
    public function test(){
    	$string = "astro@enclave";
    	$array = explode("@",$string);
    	if(strpos($array[1], '.') == false)
    		return 'OK';
    	return 'NOT OK';

    }
    public function test1(){
    	$string = "1234567";
    	if((preg_match('/[A-Z]+[a-z]/',$string)) == false){
    		return ' NOT OK';
    	}
    	return 'OK';
    }
    public function test2(){
        return $date->format("Y");
         $date = DateTime::createFromFormat("Y-m-d", "2068-06-15");
                    $date1 = $date->format("Y");
        return (strtotime(date("m/d/Y")->format('m')) - strtotime($date)->format('m'));
        if((strtotime(date("Y/m/d")) - strtotime($date)) > 1){
            return ' NOT OK';
        }
        return 'OK';
    }
    public function test3(){
        echo phpinfo();


    }
}
