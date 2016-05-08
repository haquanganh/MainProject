<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
class StasticController extends Controller{
	public function viewStastics(){
		return view('admin.stastics');
	}
}