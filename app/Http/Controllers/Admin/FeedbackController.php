<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use App\Feedback as Feedback;
class FeedbackController extends Controller{
	public function getviewoldFeedback($time,$id){
        $all_feedback_old = Feedback::where('F_OldVersion','=',$id)->orderBy('F_DateCreate','ASC')->get();
        $Feedback_olds = array();
        for($i = count($all_feedback_old) - $time -1  ; $i >= 0 ; $i--){
            array_push($Feedback_olds, $all_feedback_old[$i]);
        }
        array_push($Feedback_olds, Feedback::find($id));
        return view('admin.feedback_old', compact('Feedback_olds','id'));
    }
}




