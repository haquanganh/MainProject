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
| kernel and includes session state, CSRF protection, and moreChange-password.
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

        Route::get('project-management','Project_Manage_Controller@getProjectManagement');

        //Historytable-admin
        Route::get('history-table','HistoryController@getHistory');
    });
        //change password
        Route::get('change-password','PassController@getChangepass');
        Route::post('change-password','PassController@postChangepass');
        

        //login
        Route::get('login','Auth\AuthController@getLogin');
        Route::post('login','Auth\AuthController@postLogin');
        Route::get('logout',function(){
        	Auth::logout();
        	return redirect('login');
        });

        //search
        Route::get('search','SearchController@getSearch');
        Route::post('search','SearchController@postSearch');    

        Route::get('test','TestController@test3');
});
