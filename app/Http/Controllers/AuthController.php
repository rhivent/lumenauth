<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function test()
	{
		return view('test');
	}
    public function register(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));
		$apitoken = Hash::make($request->input('email'));
		
		$register = User::create([
			'name' => $name,
			'email' => $email,
			'password' => $password,
			'api_token' => $apitoken
		
		]);
		
		if($register){
			return response()->json([
				'success' => true,
				'message' => 'Register Successfull!',
				'data' => $register
			],201);
		}else{
			return response()->json([
				'success' => false,
				'message' => 'Register Failed!',
				'data' => ''
			],400);
		} 
		
		
    }
	
	public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
		
		$user = User::where('email',$email)->first();
		
		if(Hash::check($password,$user->password)){
			$apiToken = base64_encode(str_random(40));
			
			$user->update([
				'api_token' => $apiToken
			]);
			
			return response()->json([
				'success' => true,
				'message' => 'Login Successfull!',
				'data' => [
					'user' => $user,
					'api_token' => $apiToken
				]
			],201);
			return $router->app->version();
		}else{
			return response()->json([
				'success' => false,
				'message' => 'Login Failed!',
				'data' =>''
			],400);
			
		}
    }
}
