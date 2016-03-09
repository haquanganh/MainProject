<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $table = 'Employee_Record';
    protected $fillable = ['idTeam','idMember'];
    protected $hidden = [];
}
