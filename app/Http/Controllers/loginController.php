<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\facades\Auth;
use app\User;

class loginController extends Controller
{
    public function user_login(Request $request){
    	$this->validate($request,[
    	'email'=>'bail|required|email',
    	'password'=>'bail|required|min:6',
    	]);

    	if(Auth::attempt(['email'=>$request->email, 'password'=> $request->password])){
            $user = Auth::user();
            if($user->userType !='User' && $user->userType !='Admin'){
                Auth::logout();
                return response()->json([
                'msg'=>'Incorrect login details',
                ], 401);
            }
            return response()->json([
    			'msg'=>'You are logged in',
                'user'=>$user
    		]);
    	}else{
    		return response()->json([
    			'msg'=>'Incorrect login details',
    		], 401);
    	}
    }
}
