<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class program extends Model
{
    protected $table = 'program';
   protected $fillable = ['id', 'progName'];
}
