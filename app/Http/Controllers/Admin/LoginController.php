<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Auth;
use App\Model\Author;
use Illuminate\Foundation\Console\Presets\React;

class LoginController extends Controller
{
    /**
     * 登录blog
     */
    public function login(Request $request)
    {
        $newUser = array([
            'username' => $request->name,
            'password' => $request->password,
        ]);
        // if (!$token = $request->token) {
        //     return response()->json(['error' => 'Unauthorized'], 401);
        // }

        // \Config::set('jwt.user' , "App\Models\Admin");
        // \Config::set('auth.providers.users.model', \App\Models\Admin::class);

        $userId = Author::checkUser($newUser[0]['username']);
        if (!empty($userId)) {

            // $payload = JWTFactory::make($newUser);
            // $token = JWTAuth::encode($payload);
            $user = array([
                'id' => $userId,
                'name' => $newUser[0]['username'],
                // 'token' => $token
            ]);
            return $user[0];
        }
        $res = Author::register($newUser);
        return $res;
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' =>  60
        ]);
    }
}
