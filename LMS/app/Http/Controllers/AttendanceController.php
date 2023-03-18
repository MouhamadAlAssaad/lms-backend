<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Section;
use App\Models\Student;
class AttendanceController extends Controller

{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
      public function addAttendance(Request $request){
        try{
        $Attendance      = new Attendance;
        $date = $request ->input('date');
        $Attendance          ->date = $date;


        $case = $request ->input('case');
        $Attendance          ->case = $case;

        $section_id      = $request->input('section_id');
        $section         = Section::find($section_id);
        $Attendance      ->section_id= $section_id;
        $Attendance      ->Section()->associate($section_id);

        $student_id      = $request->input('student_id');
        $student         = Student::find($student_id);
        $Attendance      ->student_id= $student_id;
        $Attendance      ->Student()->associate($student_id);

         $Attendance     ->save();
         return response()->json([
            'message' => "attendance saved successfully"
         ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    public function getAllAttendance()
    {
        try{
        $attendance = Attendance::all();
    
        return response()->json([
            // 'message' => 'All attendance retrieved successfully!',
            'message' => $attendance,
        ]);
    } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

      //  Get an attendance by student id
    public function getAttendanceByStudentId(Request $req, $student_id)
    {
        $attendance = attendance::where("student_id", $student_id)->get();
        // Check if the attendance not exists
        if (!$attendance) {
            return response()->json([
                'message' => 'attendance not found!',
            ]);
        }

        return response()->json([
            "message" => $attendance
        ]);
    }
    public function deleteAttendance(Request $request , $id){
        try{
    $attendance    = Attendance::find($id);
    $attendance->delete();

    return response()->json([
        'message' => 'success',
    ]);
} catch (\Exception $e) {
        return response()->json([
            'message' => $e->getMessage(),
        ], 500);
    }
}
}