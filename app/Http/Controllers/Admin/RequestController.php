<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Request_info;
use App\RequestE_E;
use App\Notification_Admin;
use Auth;
use Carbon;
use DB;
class RequestController extends Controller
{
    public function getRequest(){
        $list_requestC_E = Request_info::select()->orderBy('idRequest','desc')->get();
        $list_requestE_E = RequestE_E::select()->orderBy('idRequestE_E','desc')->get();
        return view('admin.request_notification',compact('list_requestC_E', 'list_requestE_E'));
    }

    public function postRequestC_E(Request $request, $id){
        $mytime = Carbon\Carbon::now();
        if($request->input('yes-accept'))
        {
            $data = array(
                    'responseTime' => $mytime,
                    'status' => 1
                );
            $confirm = Request_info::where('idRequest', '=', $id)->update($data);
            if($confirm)
            {
                return redirect()->back()->with('messages','Successful!');
            }
                return redirect()->back()->with('messages','Failed!');
        }
        else if($request->input('yes-reject'))
        {
            $data = array(
                    'responseTime' => $mytime,
                    'status' => 2
                );
            $confirm = Request_info::where('idRequest', '=', $id)->update($data);
            if($confirm)
            {
                return redirect()->back()->with('messages','Successful!');
            }
                return redirect()->back()->with('messages','Failed!');
        }
    }
    public function postRequestE_E(Request $request, $id){
        $mytime = Carbon\Carbon::now();
        if($request->input('yes-accept'))
        {
            $data = array(
                    'responseTime' => $mytime,
                    'status' => 1
                );
            $confirm = RequestE_E::where('idRequestE_E', '=', $id)->update($data);
            if($confirm)
            {
                return redirect()->back()->with('messages','Successful!');
            }
                return redirect()->back()->with('messages','Failed!');
        }
        else if($request->input('yes-reject'))
        {
            $data = array(
                    'responseTime' => $mytime,
                    'status' => 2
                );
            $confirm = RequestE_E::where('idRequestE_E', '=', $id)->update($data);
            if($confirm)
            {
                return redirect()->back()->with('messages','Successful!');
            }
                return redirect()->back()->with('messages','Failed!');
        }
    }
    
}
