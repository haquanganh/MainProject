<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectStatus extends Model
{
    protected $table = 'ProjectStatus';
    protected $fillable = ['idPStatus','P_Status'];
    protected $primaryKey = 'idPstatus';
    protected $hidden = [];
    public $timestamps = false;
    public function Project(){
    	return $this->hasMany('App\Project','idPStatus');
    }
}
