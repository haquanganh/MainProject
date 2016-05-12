<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reset_Password extends Model
{
    protected $table = 'password_resets';
    protected $fillable = ['email', 'token','created_at'];
    protected $primaryKey = 'email';
    public $timestamps = false;
    protected $hidden = [];
}