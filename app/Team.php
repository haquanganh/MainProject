<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = 'Team';
    protected $fillable = ['idTeam', 'TeamName','idPManager','T_Note'];
    protected $hidden = [];
    public $primaryKey = 'idTeam';
    public function Employee(){
    	return $this->belongsToMany('App\Employee','TeamMember','idTeam','idMember');
    }
    public $timestamps = false;
}
