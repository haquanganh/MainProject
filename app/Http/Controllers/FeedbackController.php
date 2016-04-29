<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use DB;
use Carbon\Carbon;
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

		$lastFb = Feedback::orderBy('F_DateCreate', 'desc')->first();
		$mytime = Carbon::now();
		if(strtotime($mytime) - strtotime($lastFb->F_DateCreate) >= 604800)
		{
			$idAccount = Auth::user()->idAccount;
			$idClient = DB::table('Clients')->select('idClient')->where('idAccount', '=', $idAccount)->first()->idClient;
			$idEmployee = $request->input('idEmployee');
			$rating = $request->input('rating');
			if($validator->fails())
			{
				return redirect()->back()->withErrors($validator);
			} else {
				$insert = new Feedback;
				$insert->F_Title = $post['feedback_title'];
				$insert->F_Content = $post['feedback_content'];
				$insert->F_Rate = $rating;
				$insert->F_DateCreate = $mytime;
				$insert->idClient = $idClient;
				$insert->idProject =(int) $request->input('idProject');
				$insert->idEmployee = $idEmployee;
				$insert->save();
				if (!$insert)
				{
					return redirect()->back()->with('messages','Failed, please try again!');
					
				}
				else {
					return redirect()->back()->with('messages','Successful, thank for your feedback!');
				}
			}
		}
		return redirect()->back()->with('messages','You just can give the feedback within 7 days!');

    }

    public function postEditFeedback(Request $request){
    	$post = $request->all();
    	$validator = Validator::make($request->all(),
			array(
				'edit_feedback_title' => 'required',
				'edit_feedback_content' => 'required',
				'rating' => 'required',
				'edit-text-backup' => 'required'
				)
		);

		$mytime = Carbon::now();
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
			$f = Feedback::find($idFeedback);
			$f->F_Title = $post['edit_feedback_title'];
			$f->F_Content = $post['edit_feedback_content'];
			$f->F_Rate = $post['rating'];
			$f->save();
			if($f->save())
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
    	$f = Feedback::find($idFeedback);
    	$f->delete();
    	return redirect()->back()->with('messages','Delete Successful!');
    }
}
