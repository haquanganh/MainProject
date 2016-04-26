<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestE_E extends Model
{
    protected $table = 'RequestE_E';
    protected $fillable = ['idRequestE_E', 'idEmployee1','idEmployee2','dateCreate', 'responseTime', 'status'];
    protected $hidden = [];
    public $timestamps = false;

    // public function Employee()
    // {
    //     return $this->belongsTo('App\Employee', 'idEmployee2');
    // }
}
