<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryType extends Model
{
    protected $table = 'History_Type';
    protected $fillable = ['idHistoryType', 'HT_Name'];
    protected $primaryKey = 'idHistoryType';
    protected $hidden = [];
    public $timestamps = false;
    public function History(){
        return $this->hasMany('App\History');
    }
}
