<?php
Route::any('adminer', '\Miroc\LaravelAdminer\AdminerController@index');
Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
            if(!Auth::check()) return redirect('login');
        return view('homepage');
    });
    Route::group(['namespace'=>'Admin','prefix'=>'admin','middleware' => ['auth','admin']],function(){
    	Route::resource('personal-information', 'Personal_Information_Controller');
        Route::get('personal-information/client/{id}','Personal_Information_Controller@viewClient');
        Route::get('personal-information/client_company/{id}','Personal_Information_Controller@viewClientCompany');
        Route::get('personal-information/client/edit/{id}','Personal_Information_Controller@getEditClient');
        Route::post('personal-information/client/edit/{id}','Personal_Information_Controller@postEditClient');
        Route::get('personal-information/clientcompany/edit/{id}','Personal_Information_Controller@getEditClientCompany');
        Route::post('personal-information/clientcompany/edit/{id}','Personal_Information_Controller@postEditClientCompany');
    	Route::get('register','Register_Controller@getRegister');
        Route::post('register','Register_Controller@postRegister');
        Route::get('project','ProjectController@viewProject');
        Route::get('create-project','ProjectController@getcreateProject');
        Route::post('create-project','ProjectController@postcreateProject');
        Route::get('get-listPM','AjaxController@getlistPM');
        Route::get('get-listProject','AjaxController@getlistProject');
        // Route::get('pagination/employees','AjaxController@getPagination');
        // Route::get('pagination/employees/search/results','AjaxController@getPaginationSearchResults');
        // Route::get('pagination/search','AjaxController@getPaginationSearch');
        Route::get('get-top','AjaxController@getTop');
        Route::get('chart','AjaxController@getChart');
        Route::get('project_detail/{id}','ProjectController@project_detail');
        Route::get('project/edit/{id}','ProjectController@getEditProject');
        Route::post('project/edit/{id}','ProjectController@postEditProject');
        Route::get('history_system','HistoryController@viewHistorySystem');
        Route::get('history_feedback','HistoryController@viewHistoryFeedback');
        Route::get('feedback_old/{time}/{id}','FeedbackController@getviewoldFeedback');
        Route::get('stastics','StasticController@viewStastics');
        //request
        Route::get('request-notify', 'RequestController@getRequest');
        Route::post('request-notify-C_E/{id}', 'RequestController@postRequestC_E');
        Route::post('request-notify-E_E/{id}', 'RequestController@postRequestE_E');
        //additional management
        Route::get('add-skill', 'AdditionalManagementController@getAddSkill');
        Route::post('add-skill', 'AdditionalManagementController@postAddSkill');
        Route::post('edit-skill', 'AdditionalManagementController@postEditSkill');
        Route::get('add-english-record', 'AdditionalManagementController@getAddEnglishRecord');
        Route::post('add-english-record', 'AdditionalManagementController@postAddEnglishRecord');
        Route::post('get-english-record', 'AdditionalManagementController@postGetEnglishRecord');

    });
        Route::resource('personal-information', 'Personal_Information_Controller');
        Route::get('login','Auth\AuthController@getLogin');
        Route::post('login','Auth\AuthController@postLogin');
        Route::get('logout',function(){
        	Auth::logout();
        	return redirect('login');
        });
        Route::get('project','ProjectController@viewProject');
        Route::get('create-project','ProjectController@getcreateProject');
        Route::get('project_detail/{id}','ProjectController@project_detail');
        Route::post('create-project','ProjectController@postcreateProject');
        Route::get('get-employee','AjaxController@getemployee');
        Route::get('get-listProject','AjaxController@getlistProject');
        Route::get('project/edit/{id}','ProjectController@getEditProject');
        Route::post('project/edit/{id}','ProjectController@postEditProject');
        Route::get('project_history','HistoryController@viewProjectHistory');
        Route::get('team-management','TeamManagementController@viewTeam');
         //client feedback
        Route::post('client-feedback','FeedbackController@postFeedback');
        Route::post('client-edit-feedback','FeedbackController@postEditFeedback');
        Route::post('client-delete-feedback','FeedbackController@postDeleteFeedback');

        //employee information
        Route::get('employee-information','EmployeeController@getEmployee');
        Route::post('employee-information','EmployeeController@postEmployee');
        Route::get('access-request/{id}', 'EmployeeController@getInfor');
        //Send request
        Route::post('send-request/{id}','RequestController@postSendRequest');
        //Change password
        Route::post('change-password','PassController@postChangepass');
        Route::post('check/check-pass','PassController@checkPass');

        Route::get('chart','AjaxController@getChart');
        //note
        Route::get('note', 'NoteController@viewNote');
        Route::post('create-note', 'NoteController@postCreateNote');
        Route::post('edit-note', 'NoteController@postEditNote');
        Route::post('delete-note', 'NoteController@postDeleteNote');

        //admin_note
        Route::get('/admin/note','NoteController@viewadminNote');
        Route::post('create-note', 'NoteController@postCreateNote');
        Route::post('edit-note', 'NoteController@postEditNote');
        Route::post('delete-note', 'NoteController@postDeleteNote');

        //contact
        Route::post('/send-message', 'ContactController@postMessage');

        //message
        Route::get('/admin/message', 'ContactController@viewMessage');
        Route::post('delete-msg', 'ContactController@deleteMessage');
        Route::post('read-msg', 'ContactController@readMessage');

        //send mail reset password
        Route::get('/reset-request', 'ResetPasswordController@getEmail');
        Route::post('/reset-request', 'ResetPasswordController@postEmail');
        Route::get('/reset-password/{token}/{email}', 'ResetPasswordController@getReset');
        Route::post('/reset-password/{token}/{email}', 'ResetPasswordController@postReset');

        Route::get('test',function(){
            // $feedbacks = App\Feedback::all();
            // $list = array();
            // foreach ($feedbacks as $key => $k) {
            //     $ymd = DateTime::createFromFormat('Y-m-d H:i:s',$k->F_DateCreate)->format('m/Y');
            //     //$newformat = date('m/y',$date);
            //     return $ymd;
            //     //array_push($list, $date);
            // }
            // return $list;
            // $tz = new DateTimeZone('Asia/Bangkok');
            // $now = new DateTime('now',$tz);
            // // return $now->format('Y-m-d H:i:s');
            // $mytime = Carbon\Carbon::now();
            // $mytime->setTimezone('Asia/Bangkok');
            // return $mytime;
            // $now = new DateTime();
            // return $now->format('Y-m-d H:i:s');
            // $feedbacks = App\Feedback::all()->toJson();
            // return $feedbacks;
            // $project = App\Project::find(23);
            // // return $project->Employee;
            // $idProject = 73;
            // $idEmployee = 1100000002;
            // $idERecord =(array) DB::select("select idERecord from Employee_Record where substring(Content,instr(Content,'.')+1,length(Content)) = ".$idProject." and idEmployee = ".$idEmployee." order by DateStart DESC")[1];
            // $employees = App\Employee_Record::find($idERecord);
            // return $employees;
            $list_employee = App\Employee::where('E_Name','LIKE','%j%')->paginate(10);
            $e = App\Employee_Record::all();
            $e->setAttribute('OK','OK');
            return $e;
        });
});
