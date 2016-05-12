<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Clients;
use App\Request_info;
use App\RequestE_E;
use App\Employee;
use App\Notification_Admin;
use Mail;
use Carbon;
class RequestController extends Controller
{
    public function postSendRequest($id){
        $idAccount = Auth::user()->idAccount;
        $mytime = Carbon\Carbon::now();
        if(Auth::user()->idRole == 4)
        {
            $Client = Clients::select()
                        ->where('idAccount', '=', $idAccount)->first();
            $send_request = new Request_info;
            $send_request->idClient = $Client->idClient;
            $send_request->idEmployee2 = $id;
            $send_request->dateCreate = $mytime;
            if($send_request->save())
            {
                $name = Employee::where('idEmployee', '=', $id)->first()->E_EngName;
                $data = [
                    'hoten' => $Client->ClientName,
                    'eName' => $name
                ];
                Mail::send('emails.email', $data, function ($message) {
                    $message->from('bims.enclavesystem@gmail.com', 'System BIMS');
                    $message->to('testlaravel94@gmail.com', 'Admin BIMS');
                    $message->subject('[BIMS]New request from client!');
                });
                return redirect()->back()->with('messages','The request has sent!');
            }
            return redirect()->back()->with('messages','Something went wrong, please try again!');
        }
        else {
            $Employee1 = Employee::select()
                        ->where('idAccount', '=', $idAccount)->first();
            $send_request = new RequestE_E;
            $send_request->idEmployee1 = $Employee1->idEmployee;
            $send_request->idEmployee2 = $id;
            $send_request->dateCreate = $mytime;
            if($send_request->save())
            {
                $name = Employee::where('idEmployee', '=', $id)->first()->E_EngName;
                $data = [
                    'hoten' => $Employee1->E_EngName,
                    'eName' => $name
                ];
                Mail::send('emails.email', $data, function ($message) {
                    $message->from('bims.enclavesystem@gmail.com', 'System BIMS');
                    $message->to('testlaravel94@gmail.com', 'Admin BIMS');
                    $message->subject('[BIMS]New request from Employee!');
                });
                return redirect()->back()->with('messages','The request has sent!');
            }
            return redirect()->back()->with('messages','Something went wrong, please try again!');
        }
    }
    public function postNotify(){

        $idRole = Auth::user()->idRole;
        $idAccount = Auth::user()->idAccount;

        if($idRole == 4)
        {
            $idClient = Clients::select()
                            ->where('idAccount', '=', $idAccount)->first()
                            ->idClient;
            $list_notify = Request_info::select()
                            ->where('idClient', '=', $idClient)
                            ->where('status', '!=', '0')
                            ->where('notify_status', '=', '0')
                            ->update(['notify_status' => '1']);
            if($list_notify > 0)
            {
                return json_encode('ok');
            }
            return json_encode('fail');
        }
        else
        {
            $idEmployee = Employee::select()
                            ->where('idAccount', '=', $idAccount)
                            ->first()
                            ->idEmployee;
            $list_notify = RequestE_E::select()
                            ->where('idEmployee1', '=', $idEmployee)
                            ->where('status', '!=', '0')
                            ->where('notify_status', '=', '0')
                            ->update(['notify_status' => '1']);
            if($list_notify > 0)
            {
                return json_encode('ok');
            }
            return json_encode('fail');
        }
    }
}
