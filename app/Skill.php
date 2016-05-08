<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table = 'Skill';
    protected $fillable = ['idSkill', 'Skill','S_Rate'];
    protected $hidden = [];
    protected $primaryKey = 'idSkill';
    public function Employee(){
    	return $this->belongsToMany('App\Employee','SkillDetail','idSkill','idEmployee')->withPivot('S_Rate');
    }
    public $timestamps = false;
}
