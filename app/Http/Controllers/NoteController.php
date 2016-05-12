<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use DB;
use Carbon;
use App\User;
use Auth;
use App\Note;
use DateTime;
class NoteController extends Controller
{

	public function viewNote(){
		$idAccount = Auth::user()->idAccount;
		$list_idNote = DB::table('Note')->select('*')->where('idAccount','=',$idAccount)->get();
		return view('note.view', compact('list_idNote'));
	}

	public function viewadminNote() {
		$idAccount = Auth::user()->idAccount;
		$list_idNote = DB::table('Note')->select('*')->where('idAccount','=',$idAccount)->get();
		return view('admin.note', compact('list_idNote'));
	}

	public function postCreateNote(Request $request) {
		$validator = Validator::make($request->all(), array('titleNote' => 'required|min:4','contentNote' => 'required|min:4') );

		if($validator->fails()) {
			return redirect()->back()->withErrors($validator);
		}
		else {
			$post = $request->all();
			$mytime = Carbon\Carbon::now();
			$idAccount = Auth::user()->idAccount;

			$data = array(
					'N_Title' 		=> $post['titleNote'],
					'N_Content'		=> $post['contentNote'],
					'N_DateCreate'  => $mytime,
					'N_DateUpdate'	=> $mytime,
					'idAccount'	=> $idAccount
				);

			$insert = DB::table('Note')->insert($data);
			if ($insert > 0)
			{
				return redirect()->back()->with('msg1','Create note successfully!');
			}
			else {
				return redirect()->back()->with('msg2','Failed, please try again!');
			}
		}
	}

	public function postEditNote(Request $request) {

		$validator = Validator::make($request->all(),
			array(
				'edit_title' => 'required|min:4',
				'edit_content' => 'required|min:4'
				)
		);
		//$idNote = $request->input('idNote');

		if($validator->fails()) {
			return redirect()->back()->withErrors($validator);
		} else {
			$post = $request->all();
			$idNote = $request->input('idno');
			$timeupdate = Carbon\Carbon::now();

			$data = array(
				'N_Title'		=> $post['edit_title'],
				'N_Content'		=> $post['edit_content'],
				'N_DateUpdate'	=> $timeupdate,
				);
			$update = DB::table('Note')
					->where('idNote', '=', $idNote)
					->update($data);
			if ($update > 0)
			{
				return redirect()->back()->with('msg3','Successful!');
			}
			else {
				return redirect()->back()->with('msg4','Failed, please try again!');
			}
		}
	}

	public function postDeleteNote(Request $request) {
		$idNote = $request->input('idno');
		$delete = DB::table('Note')
    			->where('idNote', '=', $idNote)->delete();
    	if ($delete > 0)
		{
			return redirect()->back()->with('messages','Successful!');
		}
		else {
			return redirect()->back()->with('messages','Failed, please try again!');
		}
	}
}
