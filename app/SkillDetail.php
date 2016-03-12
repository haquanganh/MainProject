<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SkillDetail extends Model
{
    protected $table = 'SkillDetail';
    protected $fillable = ['idEmployee','idSkill','S_Rate'];
    protected $hidden = [];
    public $timestamps = false;
}
