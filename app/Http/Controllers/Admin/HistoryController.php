<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HistoryController extends Controller
{
    public function getHistory(){
    	return view('admin.historytable');
    }
}
