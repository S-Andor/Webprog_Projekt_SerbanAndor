<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

Route::get('/users',[App\Http\Controllers\UsersController::class,'index']);
Route::post('/login',[App\Http\Controllers\UsersController::class,'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
