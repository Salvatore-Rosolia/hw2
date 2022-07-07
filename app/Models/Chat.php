<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model {

    protected $table = 'chats';

    protected $fillable = [
        'id',
        'user1',
        'user2'
    ];

public $timestamps = false;

}



?>
