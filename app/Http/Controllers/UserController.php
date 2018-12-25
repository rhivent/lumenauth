<?php

namespace App\Http\Controllers;

use App\User;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

	public function show($id)
    {
        $user = User::find($id);
		
		if($user){
			return response()->json([
				'success' => true,
				'messgae' => 'User Found!',
				'data' => $user
			],200);
		}else{
			return response()->json([
				'success' => false,
				'messgae' => 'User Not Found!',
				'data' =>''
			],404);
		}
    }

}
