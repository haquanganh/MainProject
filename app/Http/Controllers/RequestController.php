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
                $data = ['hoten' => $Client->ClientName];
                Mail::send('emails.email', $data, function ($message) {
                    $message->from('testlaravel94@gmail.com', 'System BIMS');
                    $message->to('bims.enclavesystem@gmail.com', 'Admin BIMS');
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
                $data = ['hoten' => $Employee1->E_EngName];
                Mail::send('emails.email', $data, function ($message) {
                    $message->from('testlaravel94@gmail.com', 'System BIMS');
                    $message->to('bims.enclavesystem@gmail.com', 'Admin BIMS');
                    $message->subject('[BIMS]New request from Employee!');
                });
                return redirect()->back()->with('messages','The request has sent!');
            }
            return redirect()->back()->with('messages','Something went wrong, please try again!');
        }
    }
}
