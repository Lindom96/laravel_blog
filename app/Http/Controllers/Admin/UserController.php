<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Object_;
use App\Model\User;
use Symfony\Component\Console\Output\Output;

class UserController extends Controller
{

    public function login(Request $request)
    {

        $newUser = array([
            'username' => $request->username,
            'password' => $request->password,
        ]);
        // var_dump($newUser['username']);
        $userId = User::checkUser($newUser[0]['username']);
        if (!empty($userId)) {
            $user = array([
                'id' => $userId
            ]);
            return $user[0];
        }
        $res = User::register($newUser);
        return $res;
    }
    
}
