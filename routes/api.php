<?php

use Illuminate\Http\Request;
// header('Access-Control-Allow-Origin:http://localhost:8080');
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['cros']], function () {
    Route::get('/token', function (Request $request) {
        $result = [
            'App' => '回家吃饭',
            'Version' => '1.0.1'
        ];
        return $result;
    });
    Route::post('/login', 'Api\LoginController@login');
});


/**
 * token
 */
// include __DIR__ . '/admin/api.php';
