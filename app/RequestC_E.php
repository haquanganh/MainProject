<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestC_E extends Model
{
    protected $table = 'RequestC_E';
    protected $fillable = ['idClient','idEmployee','R_Status'];
    protected $hidden = [];
}
