<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function addStudent(Request $request)
    {
        try {
            $Student        = new Student;
            $name           = $request->input('name');
            $email          = $request->input('email');
            $phone          = $request->input('phone');
            $picture_path   = $request->file('picture')->store('images','public');
            $course_id      = $request->input('course_id');
            $course         = Course::find($course_id);

            if (!$course) {
                throw new \Exception("Course not found.");
            }

            $Student->name         = $name;
            $Student->email        = $email;
            $Student->picture      = $picture_path;
            $Student->phone        = $phone;
            $Student->course_id    = $course_id;

            $Student->Course()->associate($course_id);

            $Student->save();

            return response()->json([
                'message' => $request->all(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

 
    public function getStudent(Request $request, $id)
    {
        try {
            $student = Student::find($id);

            if (!$student) {
                throw new \Exception("Student not found.");
            }

            $picture_url = Storage::url($student->picture); // Get the URL of the stored image

            return response()->json([
                'id' => $student->id,
                'name' => $student->name,
                'email' => $student->email,
                'phone' => $student->phone,
                'picture' => $picture_url, // Return the URL of the stored image in the response
                'course_id' => $student->course_id,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function getAllStudent(Request $request)
    {
        try {
            $students = Student::all();
            $formattedStudents = [];
    
            foreach ($students as $student) {
                $picture_url = Storage::url($student->picture);
    
                $formattedStudents[] = [
                    'id' => $student->id,
                    'name' => $student->name,
                    'email' => $student->email,
                    'phone' => $student->phone,
                    'picture' => $picture_url,
                    'course_id' => $student->course_id,
                    'created_at' => $student->created_at,
                    'updated_at' => $student->updated_at,
                ];
            }
    
            return response()->json([
                'message' => $formattedStudents,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    

    public function updateStudent(Request $request, $id)
    {
        try {
            $student = Student::find($id);

            if (!$student) {
                throw new \Exception("Student not found.");
            }

            $input = $request->except('picture', '_method');
            $student->update($input);

            if ($request->hasFile('picture')) {
                Storage::delete('public/' . $student->picture);
                $picture_path = $request->file('picture')->store('images', 'public');
                $student->update(['picture' => $picture_path]);
            }

            return response()->json([
                'message' => 'success',
                'data' => $student,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

public function deleteStudent(Request $request, $id)
{
    try {
        $student = Student::find($id);

        if (!$student) {
            throw new \Exception("Student not found.");
        }

        // Delete the picture file from the storage
        Storage::delete('public/' . $student->picture);

        // Delete the student record from the database
        $student->delete();

        return response()->json([
            'message' => 'success',
        ]);
    }  catch (\Exception $e) {
        return response()->json([
            'message' => $e->getMessage(),
        ], 500);
    }
}
    public function updateStudentPicture(Request $request, $id)
{
    try {
        $student = Student::find($id);

        if (!$student) {
            throw new \Exception("Student not found.");
        }

        if ($request->hasFile('picture')) {
            Storage::delete('/public' . $student->picture);
            $picture_path = $request->file('picture')->store('images', 'public');
            $student->update(['picture' => $picture_path]);
        }

        $picture_url = Storage::url($student->picture);

        return response()->json([
            'message' => 'success',
            'picture' => $picture_url,
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'message' => $e->getMessage(),
        ], 500);
    }
}

}