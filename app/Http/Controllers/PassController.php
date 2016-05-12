<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Validator;
use App\User;
use Hash;
class PassController extends Controller
{
	public function postChangepass(Request $request){
		$old_pass = $request->input('old_pass');
		$new_pass = $request->input('new_pass');
		$renew_pass = $request->input('renew_pass');
		$user = User::find(Auth::user()->idAccount);
		if(!Hash::check($old_pass, $user->getAuthPassword()))
		{
				return json_encode('incorrect');
		}
		else{
			$user->password = Hash::make($new_pass);
			if($user->save())
				{
					return json_encode('success');
				}
		}
		return json_encode('something_wrong');
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
