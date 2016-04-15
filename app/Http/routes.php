<?php
/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/




/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
            if(!Auth::check()) return redirect('login');
        return view('homepage');
    });
    Route::resource('personal-information', 'Personal_Information_Controller');
    Route::group(['namespace'=>'Admin','prefix'=>'admin'],function(){
    	Route::resource('personal-information', 'Personal_Information_Controller');
    	Route::get('register','Register_Controller@getRegister');
        Route::post('register','Register_Controller@postRegister');
        Route::get('project','ProjectController@viewProject');
        Route::get('create-project','ProjectController@getcreateProject');
        Route::post('create-project','ProjectController@postcreateProject');
        Route::get('get-listPM','AjaxController@getlistPM');
        Route::get('get-listProject','AjaxController@getlistProject');
        Route::get('get-top','AjaxController@getTop');
        Route::get('project_detail/{id}','ProjectController@project_detail');
        Route::get('project/edit/{id}','ProjectController@getEditProject');
        Route::post('project/edit/{id}','ProjectController@postEditProject');
        Route::get('history_system','HistoryController@viewHistorySystem');
        Route::get('history_feedback','HistoryController@viewHistoryFeedback');
        Route::get('feedback_old/{time}/{id}','FeedbackController@getviewoldFeedback');
        Route::get('stastics','StasticController@viewStastics');
        //request
        Route::get('request-notify', 'RequestController@getRequest');
        Route::post('request-notify/{id}', 'RequestController@postRequest');

    });

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

        //Change password
        Route::post('change-password','PassController@postChangepass');
        Route::post('check/check-pass','PassController@checkPass');
        //Send request
        Route::post('send-request/{id}','RequestController@postSendRequest');
        Route::get('test',function(){
            $feedbacks = App\Feedback::all();
            $list = array();
            foreach ($feedbacks as $key => $k) {
                $ymd = DateTime::createFromFormat('Y-m-d H:i:s',$k->F_DateCreate)->format('m/Y');
                //$newformat = date('m/y',$date);
                return $ymd;
                //array_push($list, $date);
            }
            return $list;
        });
});
