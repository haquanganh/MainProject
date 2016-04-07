<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FeedbackHistoryController extends Controller
{
    public function getFeedbackHistory(){
    	return view('admin.feedback_history');
    }
}
