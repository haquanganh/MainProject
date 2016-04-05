<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestE_E extends Model
{
    protected $table = 'RequestE_E';
    protected $fillable = ['idEmployee1','idEmployee2','R_Status'];
    protected $hidden = [];
}
