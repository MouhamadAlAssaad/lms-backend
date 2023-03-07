<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
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

            return response()->json([
                'message' => $student,
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
            $student = Student::all();

            return response()->json([
                'message' => $student,
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
                Storage::delete('/public' . $student->picture);
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
}