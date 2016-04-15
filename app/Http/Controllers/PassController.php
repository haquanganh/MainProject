<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Validator;
use App\User;
use Hash;
use Response;
class PassController extends Controller
{
    public function postChangepass(Request $request)
	{
		$validator = Validator::make($request->all(),
			array(
				'old_pass' => 'required',
				'new_pass' => 'required|min:6',
				'renew_pass' => 'required|same:new_pass'
				)
		);
		if($validator->fails())
		{
			return redirect()->back()->withErrors($validator);
		} else {

			$user           = User::find(Auth::user()->idAccount);
			$old_password	= $request->input('old_pass');
			$password       = $request->input('new_pass');

			if(!Hash::check($old_password, $user->getAuthPassword()))
			{
				return redirect()->back()->with('message1','Your current password is incorrect, please try again!');
			}
			else{
				$user->password = Hash::make($password);
				if($user->save())
					{
						return redirect()->back()->with('message2','Your password has been changed!');
					}
			}
		}
		return redirect('/')->with('message2','Your password could not be changed!');
	}

	public function checkPass(	Request $request)
	{
		$user = User::find(Auth::user()->idAccount);
		$old_password	= $request->input('old_pass');
		if(Hash::check($old_password, $user->getAuthPassword()))
			return 'true';
		return 'false';
	}
}
