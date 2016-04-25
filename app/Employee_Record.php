<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee_Record extends Model
{
    protected $table = 'Employee_Record';
    protected $fillable = ['idERecord', 'Content','DateStart','DateEnd','idEmployee'];
    protected $hidden = [];
    protected $primaryKey = 'idERecord';
    public $timestamps = false;
    public function Employee(){
    	return $this->belongsTo('App\Employee','idEmployee');
    }
}
