<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'Feedback';
    protected $fillable = ['idFeedback', 'F_Content','F_Rate','F_DateCreate','F_DateUpdate','F_Mark','idClient','idEmployee'];
    protected $primaryKey = 'idFeedback';
    protected $hidden = [];
    public $timestamps = false;
    public function Employee(){
    	return $this->belongsTo('App\Employee','idEmployee');
    }
    public function Feedback(){
    	return $this->hasMany('App\Feedback');
    }
}
