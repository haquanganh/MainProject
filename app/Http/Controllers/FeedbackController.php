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
					->first()
					->idClient;
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
					'idClient'		=> $idClient,
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
				'edit-feedback_title' => 'required',
				'edit-feedback_content' => 'required',
				'rating' => 'required',
				'edit-text-backup' => 'required'
				)
		);

		$mytime = Carbon\Carbon::now();
		$idFeedback = $request->input('getIdfeedback');
		$idAccount = Auth::user()->idAccount;
		$idClient = DB::table('Clients')
					->select('idClient')
					->where('idAccount', '=', $idAccount)
					->first()
					->idClient;
		$idEmployee = $request->input('idEmployee');
		$F_Title = $request->input('F_Title');
		$F_Rate = $request->input('F_Rate');
		$getIdEmployee = $idEmployee;
		if($validator->fails())
		{
			return redirect()->back()->withErrors($validator);
		} else {
			$data_backup = array(
				'F_Title' => $F_Title,
				'F_Content' => $post['edit-text-backup'],
				'F_Rate' => $F_Rate,
				'F_DateCreate' => $mytime,
				'F_Mark' 	   => '0',
				'idClient'		=> $idClient,
				'idEmployee'	=> $idEmployee,
				'F_OldVersion' => $idFeedback,
				);
			$insert = DB::table('Feedback')->insert($data_backup);

			$data = array(
				'F_Title' => $post['edit-feedback_title'],
				'F_Content' => $post['edit-feedback_content'],
				'F_Rate' => $post['rating'],
				'F_Mark' => '2',
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
    	if($delete > 0)
    	{
    		return redirect()->back()->with('messages','Delete Successful!');
    	}
    	else {
				return redirect()->back()->with('messages','Failed, please try again!');
			}
    }
}
