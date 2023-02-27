<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SectionController;
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


Route::Get('/course',[CourseController::class,'getAllCourses']);
Route::Post('/course',[CourseController::class,'addCourse']);
Route::Get('/course/{id}',[CourseController::class,'getCourse']);
Route::Put('/course/{id}',[CourseController::class,'editCourse']);
Route::Delete('/course/{id}',[CourseController::class,'deleteCourse']);


Route::Post('/section',[SectionController::class,'addSection']);
Route::Get('/section',[SectionController::class,'getAllSection']);
Route::Get('/section/{id}',[SectionController::class,'getSection']);
Route::Put('/section/{id}',[SectionController::class,'editSection']);                 
Route::Delete('/section/{id}',[SectionController::class,'deleteSection']);   


Route::Post('/admins',[AdminController::class,'addAdmin']);
Route::Get('/admins',[AdminController::class,'getAllAdmin']);
Route::Get('/admins/{id}',[AdminController::class,'getAdmin']);
Route::Patch('/admins/{id}',[AdminController::class,'editAdmin']);
Route::delete('/admins/{id}',[AdminController::class,'deleteAdmin']);

