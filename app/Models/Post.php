<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {
    protected $table ='posts';

    protected $fillable = [
        'user',
        'nlikes',
        'ncomments',
        'type',
        'text',
        'ele'
      ];



    public $timestamps = false;


}

?>
