<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'History';
    protected $fillable = ['idHistory', 'H_Content','H_DateCreate','idAccount'];
    protected $primaryKey = 'idHistory';
    protected $hidden = [];
    public $timestamps = false;
}
