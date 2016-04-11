<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use App\Feedback_History as Feedback_History;
class FeedbackController extends Controller{
	public function getviewoldFeedback($time,$id){
        $feedback_olds = Feedback_History::orderBy('H_DateCreate','ASC')->where('idFeedback','=',$id)->get();
        $histories = array();
        for($i = count($feedback_olds) - $time -1  ; $i >= 0 ; $i--){
            array_push($histories, $feedback_olds[$i]);
        }
        return view('admin.feedback_old', compact('histories'));
    }
}