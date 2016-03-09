<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectEmployee extends Model
{
    protected $table = 'ProjectEmployee';
    protected $fillable = ['idProject','idEmployee'];
    protected $hidden = [];
}
