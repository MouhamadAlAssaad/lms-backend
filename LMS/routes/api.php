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
   



    Route::post('/register', [AuthController::class, 'register']);



Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    
      //super user
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('api');
    Route::get('/user-profile', [AuthController::class, 'userProfile'])->middleware('api');
    Route::get('/users', [AuthController::class, 'getAllUsers'])->middleware('api');
    Route::get('/users/{id}', [AuthController::class, 'getById'])->middleware('api');
    Route::delete('/users/{id}', [AuthController::class, 'deleteUser'])->middleware('api');
    Route::put('/users/{id}', [AuthController::class, 'editUser'])->middleware('api');
    
    

       // student
   Route::Post('/student',[StudentController::class,'addStudent'])->middleware('api');
   Route::Patch('/student/{id}',[StudentController::class,'updateStudent'])->middleware('api');
   Route::Delete('/student/{id}',[StudentController::class,'deleteStudent'])->middleware('api');
   Route::Get('/student',[StudentController::class,'getAllStudent'])->middleware('api');
   Route::Get('/student/{id}',[StudentController::class,'getStudent'])->middleware('api');
   Route::put('/student/{id}/picture', [StudentController::class, 'updateStudentPicture'])->middleware('api');


     // section
   Route::Get('/section',[SectionController::class,'getAllSection'])->middleware('api');
   Route::Get('/section/{id}',[SectionController::class,'getSection'])->middleware('api');
   Route::Post('/section',[SectionController::class,'addSection'])->middleware('api');
   Route::Put('/section/{id}',[SectionController::class,'editSection'])->middleware('api');                 
   Route::Delete('/section/{id}',[SectionController::class,'deleteSection'])->middleware('api'); 

     // attendance
   Route::Post('/attendance',[AttendanceController::class,'addAttendance'])->middleware('api');
   Route::Patch('/attendance/{id}',[AttendanceController::class,'updateAttendance'])->middleware('api');
   Route::Delete('/attendance/{id}',[AttendanceController::class,'deleteAttendance'])->middleware('api');
   Route::Get('/attendance',[AttendanceController::class,'getAllAttendance'])->middleware('api');
   Route::Get('/attendance/{id}',[AttendanceController::class,'getAttendance'])->middleware('api');
   Route::Get('/attendance/section/{id}',[AttendanceController::class,'getAttendanceBySectionId'])->middleware('api');
   Route::Get('/attendance/student/{id}',[AttendanceController::class,'getAttendanceByStudentId'])->middleware('api');

         // course
         Route::Get('/course',[CourseController::class,'getAllCourses'])->middleware('api');
         Route::Get('/course/{id}',[CourseController::class,'getCourse'])->middleware('api');
         Route::Post('/course',[CourseController::class,'addCourse'])->middleware('api');
         Route::Put('/course/{id}',[CourseController::class,'editCourse'])->middleware('api');
         Route::Delete('/course/{id}',[CourseController::class,'deleteCourse'])->middleware('api');
        });