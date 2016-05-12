<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Project as Project;
class HistoryController extends Controller
{
    public function viewProjectHistory(){
    	$projects = Project::orderBy('P_DateStart','DESC')->get();
    	return view('project_history',compact('projects'));
    }
}
