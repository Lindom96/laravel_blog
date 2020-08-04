<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class authJWT
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        \Config::set('jwt.user', "App\Models\Author");
        \Config::set('auth.providers.users.model', \App\Models\Author::class);
        try {
            if (!$user = JWTAuth::toUser(JWTAuth::getToken())) {
                return response()->json([
                    'errcode' => 400004,
                    'errmsg' => '无此用户'
                ], 404);
            }
        } catch (TokenExpiredException $e) {

            return response()->json([
                'errcode' => 400001,
                'errmsg' => 'token 过期'
            ]);
        } catch (TokenInvalidException $e) {

            return response()->json([
                'errcode' => 400003,
                'errmsg' => 'token 失效'
            ], 404);
        } catch (JWTException $exception) {
            return response()->json([
                'errcode' => 400002,
                'errmsg' => 'token 参数错误',
                'res' => $request
            ], 500);
        }
        return $next($request);
    }
}
