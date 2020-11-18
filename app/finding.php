<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class finding extends Model
{
    protected $table = 'finding';
   protected $fillable = ['id', 'title', 'deliverable', 'deli_data', 'area_id', 'prog_id', 'tab_num'];


   

}
