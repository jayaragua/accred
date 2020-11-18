<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class programController extends Controller
{
     public function getProg(){
    	return \DB::table('program')
            ->orderBy('id', 'desc')
            ->get();
    }
}
