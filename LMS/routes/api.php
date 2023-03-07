<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
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





    Route::post('/login', [AuthController::class, 'login'])->name('logn');
   






Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    
      //super user
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    Route::get('/users', [AuthController::class, 'getAllUsers']);
    Route::get('/users/{id}', [AuthController::class, 'getById']);
    Route::delete('/users/{id}', [AuthController::class, 'deleteUser']);
    Route::put('/users/{id}', [AuthController::class, 'editUser']);

         // course
    Route::Get('/course',[CourseController::class,'getAllCourses']);
    Route::Get('/course/{id}',[CourseController::class,'getCourse']);
    Route::Post('/course',[CourseController::class,'addCourse']);
    Route::Put('/course/{id}',[CourseController::class,'editCourse']);
    Route::Delete('/course/{id}',[CourseController::class,'deleteCourse']);

       // student
   Route::Post('/student',[StudentController::class,'addStudent']);
   Route::Patch('/student/{id}',[StudentController::class,'updateStudent']);
   Route::Delete('/student/{id}',[StudentController::class,'deleteStudent']);
   Route::Get('/student',[StudentController::class,'getAllStudent']);
   Route::Get('/student/{id}',[StudentController::class,'getStudent']);

     // section
   Route::Get('/section',[SectionController::class,'getAllSection']);
   Route::Get('/section/{id}',[SectionController::class,'getSection']);
   Route::Post('/section',[SectionController::class,'addSection']);
   Route::Put('/section/{id}',[SectionController::class,'editSection']);                 
   Route::Delete('/section/{id}',[SectionController::class,'deleteSection']); 

     // attendance
   Route::Post('/attendance',[AttendanceController::class,'addAttendance']);
   Route::Patch('/attendance/{id}',[AttendanceController::class,'updateAttendance']);
   Route::Delete('/attendance/{id}',[AttendanceController::class,'deleteAttendance']);
   Route::Get('/attendance',[AttendanceController::class,'getAllAttendance']);
   Route::Get('/attendance/{id}',[AttendanceController::class,'getAttendance']);
   Route::Get('/attendance/section/{id}',[AttendanceController::class,'getAttendanceBySectionId']);
   Route::Get('/attendance/student/{id}',[AttendanceController::class,'getAttendanceByStudentId']);

});