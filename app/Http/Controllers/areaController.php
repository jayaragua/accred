<?php

namespace App\Http\Controllers;
use App\area;
use Illuminate\Http\Request;

class areaController extends Controller
{
    public function addArea(Request $request){
    	//validate request
    	$this->validate($request,[
    		'areaName'=>'required'
    	]);
    	return area::create([
    		'areaName'=> $request->areaName
    	]);
    }



    public function editArea(Request $request){
    	//validate request
    	$this->validate($request,[
    		'areaName'=>'required',
    		'id'=>'required',
    	]);
    	return area::where('id', $request->id)->update([
    		'areaName'=> $request->areaName
    	]);
    		
    }


    public function deleteArea(Request $request){
    		$this->validate($request,[
    		'id'=>'required',
    	]);

    		return area::where('id', $request->id)->delete();


    }
    





    public function getArea(){
    	return area::orderBy('id', 'desc')->get();
    }
}
