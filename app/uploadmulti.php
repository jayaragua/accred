<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class uploadmulti extends Model
{
   protected $table = 'uploadmulti';
    protected $fillable = ['id', 'title', 'deliverable', 'deli_data', 'area_id', 'prog_id'];
}
