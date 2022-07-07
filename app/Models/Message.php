<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {

    protected $table = 'messages';

    protected $fillable = [
        'id',
        'idchat',
        'iduser',
        'time',
        'text'
      ];

public $timestamps = false;

}




?>
