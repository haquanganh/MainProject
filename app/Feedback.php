<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'Feedback';
    protected $fillable = ['idFeedback', 'F_Title', 'F_Content','F_Rate','F_DateCreate','F_DateUpdate','F_Mark','idClient','idEmployee','F_OldVersion'];
    protected $hidden = [];
    public function Employee(){
    	return $this->belongsTo('App\Employee','idEmployee');
    }
}
