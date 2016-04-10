<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;
use Auth;
class Feedback extends Model
{
    protected $table = 'Feedback';
    protected $fillable = ['idFeedback', 'F_Content','F_Rate','F_DateCreate','F_DateUpdate','idClient','idEmployee','idProject'];
    protected $primaryKey = 'idFeedback';
    protected $hidden = [];
    public $timestamps = false;
    public static function boot(){
        parent::boot();
        static::updated(function ($feedback){
            $h = new Feedback_History;
            $h->H_Content = 'Did edit feedback ';
            $h->H_Mark = 2;
            $h->idFeedback = $feedback->idFeedback;
            $h->H_newTitle = $feedback->F_Title;
            $h->H_newRate = $feedback->F_Rate;
            $h->H_newContent = $feedback->F_Content;
            $h->H_DateCreate = new DateTime();
            $h->H_idProject = $feedback->idProject;
            $h->H_idClient = $feedback->idClient;
            $h->H_idEmployee = $feedback->idEmployee;
            $h->save();
        });
        static::created(function ($feedback){
            $h = new Feedback_History;
            $h->H_Content = 'Did create new feedback ';
            $h->H_Mark = 1;
            $h->idFeedback = $feedback->idFeedback;
            $h->H_newTitle = $feedback->F_Title;
            $h->H_newRate = $feedback->F_Rate;
            $h->H_newContent = $feedback->F_Content;
            $h->H_DateCreate = new DateTime();
            $h->H_idProject = $feedback->idProject;
            $h->H_idClient = $feedback->idClient;
            $h->H_idEmployee = $feedback->idEmployee;
            $h->save();
        });
        static::deleted(function ($feedback){
            $h = new Feedback_History;
            $h->H_Content = 'Did delete new feedback ';
            $h->H_Mark = 0;
            $h->idFeedback = $feedback->idFeedback;
            $h->H_newTitle = $feedback->F_Title;
            $h->H_newRate = $feedback->F_Rate;
            $h->H_newContent = $feedback->F_Content;
            $h->H_DateCreate = new DateTime();
            $h->H_idProject = $feedback->idProject;
            $h->H_idClient = $feedback->idClient;
            $h->H_idEmployee = $feedback->idEmployee;
            $h->save();
        });
    }
    public function Employee(){
    	return $this->belongsTo('App\Employee','idEmployee');
    }
    public function FeedbackHistory(){
    	return $this->hasMany('App\Feedback_History');
    }
}
