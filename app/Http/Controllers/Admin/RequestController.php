<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Request_info;
use Auth;
class RequestController extends Controller
{
    public function getRequest(){
    	$list_request = Request_info::select('*')->orderBy('idRequest','desc')->get();	
    	return view('admin.request_notification',compact('list_request'));
    }

    public function postRequest(Request $request, $id){
    	if($request->input('accept'))
    	{
    		// $confirm = new Request_info;
    		// $confirm->status = 1;
    		// if($confirm->save())
    		// {
    		//   	return redirect()->back()->with('messages','Successful!');
      //       }
      //       	return redirect()->back()->with('messages','Failed!');
    		return 'Accepted!';
    	}
    	else if($request->input('reject'))
    	{
    		return 'Rejected!';
    	}
    }
}
