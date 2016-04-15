<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;

class HistoryController extends Controller
{
    public function viewHistorySystem(){
    	return view('admin.history_system');
    }
    public function viewHistoryFeedback(){
    	return view('admin.history_feedback');
    }
}
