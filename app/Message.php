<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'Message';
    protected $fillable = ['idMessage', 'content','dateSend','sender', 'M_Status'];
    protected $primaryKey = 'idMessage';
    protected $hidden = [];
    public $timestamps = false;
}
