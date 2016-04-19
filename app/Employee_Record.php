<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee_Record extends Model
{
    protected $table = 'Employee_Record';
    protected $fillable = ['idRecord', 'Content','DateStart','DateEnd','idEmployee'];
    protected $hidden = [];
    protected $primaryKey = 'idRecord';
    public $timestamps = false;
    public function Employee(){
    	return $this->belongsTo('App\Employee','idEmployee');
    }
}
