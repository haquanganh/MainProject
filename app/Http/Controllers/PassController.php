<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ChangePassRequest;
use Auth;
use Validator;
use App\User;
use Hash;
class PassController extends Controller
{
	public function getChangepass(){
	    if(Auth::check())
	    {
	    return view('auth.changepass');
	    } else
	        return redirect('login');
	}

	public function postChangepass(ChangePassRequest $request)
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
			return redirect('change-password')->withErrors($validator);
		} else {

			$user           = 	User::find(Auth::user()->idAccount);
			$old_password	= 	$request->input('old_pass');
			$password       = 	$request->input('new_pass');

			if(Hash::check($old_password, $user->getAuthPassword()) && $old_password == $password)
			{
			    return redirect('change-password')->withErrors(array('button' => 'New password do not same old password!'));
			}
			else 
			if(!Hash::check($old_password, $user->getAuthPassword()))
			{
				return redirect('change-password')->withErrors(array('old_pass' => 'Your old password is incorrect!'));
			}
			else {
				$user->password = Hash::make($password);
				if($user->save())
				 {
					return redirect('/')->with('message','Your password has been changed!');
				 }
			}
		}
		return redirect('change-password')->with('message','Your password could not be changed!');
	}
}
