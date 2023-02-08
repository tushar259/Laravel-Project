<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\testMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function registration(Request $request){
	     
    	$request->validate([
	        'name' => 'required|max:255',
	        'email' => 'required|email|unique:users,email',
	        'password' => 'required|min:3'
	    ]);

    	$insertUser = new User();
    	$insertUser->name = $request->name;
    	$insertUser->email = $request->email;
    	$insertUser->password = hash('sha256', $request->password);
    	
    	if($insertUser->save()){
    		Mail::to($request->email)->send(new testMail($request->name));
    		return response()->json(['data' => 'Account Created, Check your email confirmation', 'message' => 'success']);
    	}
    }

    public function login(Request $request){
    	session_start();
    	$request->validate([
	        'email' => 'required|email',
	        'password' => 'required'
	    ]);


    	$user = User::where("email",$request->email)->where("password",hash('sha256', $request->password))->first();

    	$token = $user->createToken('userInfoToken')->accessToken;

    	$_SESSION['token'] = $token;

    	return response()->json(['data' => $token, 'message' => 'success']);


		// $userInfo = PersonalAccessToken::where("tokenable_id",$token->tokenable_id)->orderBy('created_at', 'desc')->first();

		// $_SESSION['token'] = $userInfo->token;
		
		// return response()->json(['data' => $userInfo->token, 'message' => 'success']);

    }

    public function getUserInfo(){
    	session_start();
		$user = Auth::guard('api')->user();
		 
		return response()->json(['data' => $user, 'message' => 'success']);
    }

    public function getToken(){
    	session_start();
    	return response()->json(['data' => $_SESSION['token'], 'message' => 'success']);
    }

    public function logoutUser(){
    	session_start();
    	$_SESSION['token'] = "";
    	return response()->json(['data' => "User logout", 'message' => 'success']);
    }
}
