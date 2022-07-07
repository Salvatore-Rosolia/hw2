<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Comment extends Model {



    protected $table ='comments';

    protected $fillable = [
        'user',
        'post',
        'time',
        'text'
      ];


public $timestamps = false;



}

?>