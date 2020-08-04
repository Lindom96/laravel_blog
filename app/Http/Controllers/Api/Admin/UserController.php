<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Object_;
use App\Model\User;
use Symfony\Component\Console\Output\Output;

class UserController extends Controller
{

    public function login(Request $request)
    {
        if (isset($request)) {
            return '没有数据';
        }
        $res = User::register($request);
        return $res;
    }
}
