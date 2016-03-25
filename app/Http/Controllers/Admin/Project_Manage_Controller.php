<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Project_Manage_Controller extends Controller
{
     public function getProjectManagement()
    {
    	return view('admin.projectmanagement');
    }
}
