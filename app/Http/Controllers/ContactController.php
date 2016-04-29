<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use DB;
use Carbon;
use App\User;
use Auth;
use App\Http\Requests\Message_Request;
use DateTime;
use App\Message;
class ContactController extends Controller { 

	public function postMessage(Request $request) {
		$validate = Validator::make($request->all(),array('message'	=>	'required|min:4') );

		if($validate->fails()){
			return redirect()->back()->withErrors($validate);
		} else {
			$post = $request->all();
			$time = Carbon\Carbon::now();
			$idAccount = Auth::user()->idAccount;
			$idrole = Auth::user()->idRole;
			$read = 0;
			$name = '';
			if($idrole == 4) {
				$name = DB::table('Clients')->select()->where('idAccount','=',$idAccount)->first()->ClientName;
			}
			else {
				$name = DB::table('Employee')->select()->where('idAccount','=', $idAccount)->first()->E_Name;
                
			}
			$data = array(
				'idAccount'	=> $idAccount,
				'content'	=> $post['message'],
				'dateSend'	=> $time,
				'sender'	=> $name,
				'M_Status'	=> $read
				);

			$send = DB::table('Message')->insert($data);
			if ($send > 0) {
				return redirect()->back()->with('mess1','Your message has sent successfully! Wait for response from admin!');
			}
			else {
				return redirect()->back()->with('mess2','Your message cannot send to admin. Please try again!');
			}
		}		
	}


	public function viewMessage() {
		$list_message = DB::table('Message')->select('*')->orderby('M_Status')->get();
		return view('admin.message', compact('list_message'));
	}

	public function deleteMessage(Request $request) {
		$idmsg = $request->input('idmsg');
		$delete = DB::table('Message')
    			->where('idMessage', '=', $idmsg)->delete();
    	if ($delete > 0) 
		{
			return redirect()->back()->with('messages','Successful!');
		}
		else {
			return redirect()->back()->with('messages','Failed, please try again!');
		}
	}

	public function readMessage(Request $request){
		$idMessage = $request->input('idMessage');
		$data = array(
				'M_Status' => 1
			);
		$update = Message::where('idMessage', '=', $idMessage)->update($data);
		if($update > 0)
		{
			return json_encode('ok');
		}
		return json_encode('fail');
	}

	

}
