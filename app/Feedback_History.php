<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback_History extends Model{
	protected $table = 'Feedback_History';
    protected $fillable = ['idFeedbackHistory', 'H_Content','H_DateCreate','H_Title','H_Content','H_Rate','H_idClient','H_idEmployee','H_idProject'];
    protected $primaryKey = 'idFeedback';
    protected $hidden = [];
    public $timestamps = false;
    public function Feedback(){
    	return $this->belongsTo('App\Feedback','idFeedback');
    }

}