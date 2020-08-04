<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\User;
use Illuminate\Foundation\Console\Presets\React;

class LoginController extends Controller
{
    /**
     * 登录blog
     */
    public function login(Request $request)
    {
        $newUser = array([
            'username' => $request->username,
            'password' => $request->password,
        ]);
        $userId = User::checkUser($newUser[0]['username']);
        if (!empty($userId)) {
            $user = array([
                'id' => $userId,
                'name' => $newUser[0]['username']
            ]);
            return $user[0];
        }
        $res = User::register($newUser);
        return $res;
    }
}
