<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::controller(UserController::class)->group(function () {
    Route::get('/get/all-users', 'getAll');
    Route::get('/user/{id}', 'get');
    Route::post('/user/create', 'create');
    Route::put('/user/update', 'update');
    Route::delete('/user/{id}', 'delete');
});
