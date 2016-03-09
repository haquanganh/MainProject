<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectStatus extends Model
{
    protected $table = 'ProjectStatus';
    protected $fillable = ['idPStatus','P_Status'];
    protected $hidden = [];
    public function Project(){
    	return $this->hasMany('App\Project','idPStatus');
    }
}
