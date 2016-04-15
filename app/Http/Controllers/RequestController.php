<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Clients;
use App\Request_info;
use App\Employee;
use Mail;
use Carbon;
class RequestController extends Controller
{
    public function postSendRequest($id){
    	$idAccount = Auth::user()->idAccount;
        $mytime = Carbon\Carbon::now();
    	if(Auth::user()->idRole == 4)
    	{
    		$idClient = Clients::select('idClient')
    					->where('idAccount', '=', $idAccount)->first()->idClient;
    		$send_request = new Request_info;
    		$send_request->idClient = $idClient;
    		$send_request->idEmployee2 = $id;
            $send_request->dateCreate = $mytime;
    		if($send_request->save())
            {
    		  return redirect()->back()->with('messages','The request has sent!');
            }
            return redirect()->back()->with('messages','Something went wrong, please try again!');
    	}
    	else {
    		$idEmployee1 = Employee::select('idEmployee')
                        ->where('idAccount', '=', $idAccount)->first()->idEmployee;
            $send_request = new Request_info;
            $send_request->idEmployee1 = $idEmployee1;
            $send_request->idEmployee2 = $id;
            $send_request->dateCreate = $mytime;
            if($send_request->save())
            {
              return redirect()->back()->with('messages','The request has sent!');
            }
            return redirect()->back()->with('messages','Something went wrong, please try again!');
    	}
    }
}
