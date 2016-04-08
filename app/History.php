<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'History';
    protected $fillable = ['idHistory', 'H_Content','H_DateCreate','idProject','idFeedback','idType','idAdmin'];
    protected $primaryKey = 'idHistory';
    protected $hidden = [];
    public $timestamps = false;
    public function Project(){
    	return $this->belongsTo('App\Project','idProject');
    }
    public function HistoryType(){
    	return $this->belongsTo('App\HistoryType','idType');
    }
    public function Feedback(){
        return $this->belongsTo('App\Feedback','idFeedback');
    }
}
