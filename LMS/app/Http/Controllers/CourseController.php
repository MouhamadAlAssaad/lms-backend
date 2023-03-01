<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Validator;


class CourseController extends Controller
{
    //getAllCourses

    public function getAllCourses()
    {
        try{
        $courses = Course::all();
    
        return response()->json([
            'message' => 'All courses retrieved successfully!',
            'courses' => $courses,
        ]);
    } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    

    // addCourse
    
    public function addCourse(Request $request)
    {
        try{
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }
    
        $course = new Course();
        $course->name = $request->input('name');
        $course->description = $request->input('description');
        $course->save();
    
        return response()->json([
            'message' => 'course created successfully!',
        ]);
    } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    // getCoursebyid

    public function getCourse(Request $request, $id)
    {
        // Validate the ID parameter
        try{
        $validator = Validator::make(['id' => $id], [
            'id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400);
        }
    
        // Get the course with the specified ID and its associated sections
        $course = Course::with('Section')->find($id);
    
        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }
    
        return response()->json([
            'message' => $course,
        ]);
    } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    // editCourse

public function editCourse(Request $request, $id){
    try{
    $course = Course::find($id);
    if (!$course) {
        return response()->json(['message' => 'Course not found'], 404);
    }

    $name = $request->input('name');
    $description = $request->input('description');

    // Validate the request data
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'description' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['message' => $validator->errors()], 400);
    }

    // Update the course properties
    $course->name = $name;
    $course->description = $description;
    $course->save();

    return response()->json([
        'message' => 'Course updated successfully!',
        'course' => $course,
    ]);
} catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
}

// deleteCourse

public function deleteCourse(Request $request, $id)
{
    try{
    $validator = Validator::make(['id' => $id], [
        'id' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['message' => $validator->errors()], 400);
    }
    $course = Course::find($id);

    if (!$course) {
        return response()->json(['message' => 'Course not found'], 404);
    }

    $course->delete();

    return response()->json([
        'message' => 'Course deleted successfully!',
    ]);
} catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
}


}
