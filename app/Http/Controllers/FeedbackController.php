<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use DB;
use Carbon;
use App\User;
use Auth;
use App\Feedback;
class FeedbackController extends Controller
{
    public function postFeedback(Request $request){
    	$post = $request->all();
    	$validator = Validator::make($request->all(),
			array(
				'feedback_title' => 'required',
				'feedback_content' => 'required',
				)
		);
		$mytime = Carbon\Carbon::now();
		$idAccount = Auth::user()->idAccount;
		$idClient = DB::table('Clients')
					->select('idClient')
					->where('idAccount', '=', $idAccount)
					->first();
		$idEmployee = $request->input('idEmployee');
		$rating = $request->input('rating');
		if($validator->fails())
		{
			return redirect()->back()->withErrors($validator);
		} else {
			$data = array(
					'F_Title' 		=> $post['feedback_title'],
					'F_Content'		=> $post['feedback_content'],
					'F_Rate'		=> $rating,
					'F_DateCreate'	=> $mytime,
					'idClient'		=> $idClient->idClient,
					'idEmployee'	=> $idEmployee
				);
			$insert = DB::table('Feedback')->insert($data);
			if ($insert > 0) 
			{
				return redirect()->back()->with('messages','Successful, thank for your feedback!');
			}
			else {
				return redirect()->back()->with('messages','Failed, please try again!');
			}
		}
    }

    public function postEditFeedback(Request $request){
    	$post = $request->all();
    	$validator = Validator::make($request->all(),
			array(
				'edit-text' => 'required'
				)
		);
		$mytime = Carbon\Carbon::now();
		$idFeedback = $request->input('getIdfeedback');
		if($validator->fails())
		{
			return redirect()->back()->withErrors($validator);
		} else {
			$data = array(
				'F_Content' => $post['edit-text'],
				'F_DateUpdate' => $mytime
				);
			$update = DB::table('Feedback')
					->where('idFeedback', '=', $idFeedback)
					->update($data);
			if($update > 0)
			{
				return redirect()->back()->with('messages','Edit Successful!');
			}
			else {
				return redirect()->back()->with('messages','Failed, please try again!');
			}
		}
    }

    public function postDeleteFeedback(Request $request){
    	$idFeedback = $request->input('getIdfeedbacktodel');
    	$data = array(
    			'F_Mark' => '0',
    		);
    	$delete = DB::table('Feedback')
    			->where('idFeedback', '=', $idFeedback)
    			->update($data);	
    	// $delete = DB::table('Feedback')
    	// 		->where('idFeedback', '=', $idFeedback)
    	// 		->delete();
    	if($delete > 0)
    	{
    		return redirect()->back()->with('messages','Delete Successful!');
    	}
    	else {
				return redirect()->back()->with('messages','Failed, please try again!');
			}
    }
}
