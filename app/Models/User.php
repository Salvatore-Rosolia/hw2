<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class User extends Model
{


    protected $table = 'profilo';

    protected $fillable = [
        'username',
        'email',
        'password',
        'nome',
        'cognome',
        'image',
    ];


    protected $hidden = [
        'password',
    ];


public $timestamps = false;



}
