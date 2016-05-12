<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Reset_Password;
use App\User;
use Mail;
use Carbon\Carbon;
use Hash;
class ResetPasswordController extends Controller
{
    public function getEmail(){
    	return view('auth.email_forgot_password');
    }

    public function postEmail(Request $request){
    	$email = $request->input('email');
    	$mytime = Carbon::now();
    	$check = User::where('email', '=', $email)->first();
    	if($check != null)
    	{
    		$check_reset = Reset_Password::where('email', '=', $email)->first();
    		if($check_reset == null)
    		{
	    		$token = str_random(60);
	    		$reset = new Reset_Password();
	    		$reset->email = $email;
	    		$reset->token = $token;
	    		$reset->created_at = $mytime;
	    		if($reset->save())
	    		{
	    			$data = [
	                    'token' => $reset->token,
	                    'email' => $email
	                ];
	                Mail::send('auth.email', $data, function ($message) use ($email) {
	                    $message->from('testlaravel94@gmail.com', 'System BIMS');
	                    $message->to($email, $email);
	                    $message->subject('[BIMS]Reset Password Request!');
	                });
	    			return redirect()->back()->with('status', 'Your request has been sent successfully, please check your email!')->with('old_email', $email);
	    		}
	    		return redirect()->back()->with('error', 'Something went wrong, please try agian!')->with('old_email', $email);
	    		
    		} else 
    		{
    			$token = str_random(60);
    			$reset = Reset_Password::find($email);
    			$reset->token = $token;
    			if($reset->save())
    			{
    				$data = [
	                    'token' => $reset->token,
	                    'email' => $email
	                ];
	                Mail::send('auth.email', $data, function ($message) use ($email) {
	                    $message->from('testlaravel94@gmail.com', 'System BIMS');
	                    $message->to($email, $email);
	                    $message->subject('[BIMS]Reset Password Request!');
	                });
	    			return redirect()->back()->with('status', 'Your request has been sent successfully, please check your email!')->with('old_email', $email);
    			}
    			return redirect()->back()->with('error', 'Something went wrong, please try agian!')->with('old_email', $email);
    		}
    	}
    	return redirect()->back()->with('email', 'Your email address not found, please try again!')->with('old_email', $email);
    }

    public function getReset($token, $email){
    	return view('auth.reset_password', compact('token', 'email'));
    }

    public function postReset(Request $request, $token, $email){
    	$password = $request->input('password');
    	$data = array (
    		'password' => Hash::make($password)
    	);
    	$new_password = User::where('email', '=', $email)->update($data);
    	if($new_password > 0)
    	{
    		return redirect()->back()->with('message', 'Successfully Your password has been changed!');
    	}
    	return redirect()->back()->with('message', 'Something went wrong, please try agian!');
    }
}
