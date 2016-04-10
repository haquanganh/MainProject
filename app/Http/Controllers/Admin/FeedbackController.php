<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use App\Feedback_History as Feedback_History;
class FeedbackController extends Controller{
	public function getviewoldFeedback($time,$id){
        $histories= Feedback_History::orderBy('H_DateCreate','DESC')->where('idFeedback','=',$id)->get();
        return view('admin.feedback_old', compact('histories','time'));
    }
}




