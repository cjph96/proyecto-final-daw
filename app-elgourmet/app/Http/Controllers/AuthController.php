<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Illuminate\Support\Facades\Hash;
use App\User;
class AuthController extends Controller
{
    //

    public function login(Request $request)
    {
        $email = $request->input('email');
        $pass = $request->input('password');
        $user = User::where('email','=',$email)
            ->first();
        if( isset($user) && Hash::check($pass,$user->password)){
            $token = JWTAuth::fromUser($user);
            return $this->respondWithToken($token);
        }else{
            return response()
                ->json(['error' => 'Unauthorized', $email => $pass], 401);
        }
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 120
        ]);
    }
}
