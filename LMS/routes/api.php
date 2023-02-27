<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::Post('/admins',[AdminController::class,'addAdmin']);
Route::Get('/admins',[AdminController::class,'getAllAdmin']);
Route::Get('/admins/{id}',[AdminController::class,'getAdmin']);
Route::Patch('/admins/{id}',[AdminController::class,'editAdmin']);
Route::delete('/admins/{id}',[AdminController::class,'editAdmin']);