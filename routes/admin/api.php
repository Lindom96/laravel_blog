<?php

Route::group(['prefix' => 'admin','middleware' => ['cros'],'namespace'=>'Api'], function () {
    Route::post('/user', 'Admin\UserController@login');
    Route::get('/token', function () {
        return '123';
    });
});