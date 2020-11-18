<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\facades\Auth;
use App\User;

class userController extends Controller
{
    

    public function index(Request $request){
        if(!Auth::check() && $request->path() != 'login'){
            return redirect('/login');
        }
         if(!Auth::check() && $request->path() == 'login'){
            return view('welcome');
        }
       // login already
        $user = Auth::User();
        if($user->userType !='User' && $user->userType !='Admin'){
            return redirect('/login');
        }
        
        if($request->path() == 'login'){
            return redirect('/');
        }
        // // return view('welcome');
        return view('welcome');
        // return $request->path();

    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }




    public function getUser(){
    	return user::orderBy('id', 'desc')->get();
    }

    public function addUser(Request $request){
    	//validate request
    	$this->validate($request,[
    		'name'=>'required',
    		'email'=>'bail|required|email|unique:users',
    		'password'=>'required|min:6',
    		'userType'=>'required',
    		]);
    	$passwords = bcrypt($request->password);
    	$user=User::create([
    		'name'=> $request->name,
    		'email'=> $request->email,
    		'password'=> $passwords,
    		'userType'=> $request->userType,

    	]);
    	return $user;
    }

    public function editUser(Request $request){
    	//validate request
    	$this->validate($request,[
    		'name'=>'required',
    		'email'=>"bail|required|email|unique:users,email,$request->id",
    		'password'=>'min:6',
    		'userType'=>'required',
    	]);

    	$data= [
    		'name'=> $request->name,
    		'email'=> $request->email,
    		'userType'=> $request->userType,
    	];

    	if($request->password){
    		$passwords = bcrypt($request->password);
    		$data['password']= $passwords;
    	}
    	
    	$user=User::where('id', $request->id)->update($data);
    	return $user;
    }

    public function deleteUser(Request $request){
    	$this->validate($request,[
    		'id'=>'required',
    	]);

    	return User::where('id', $request->id)->delete();

    }




}
