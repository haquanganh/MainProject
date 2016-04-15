<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request_info extends Model
{
    protected $table = 'Request';
    protected $fillable = ['idRequest', 'idClient','idEmployee1', 'idEmployee2', 'dateCreate', 'status'];
    protected $hidden = [];
    public $timestamps = false;
}
