<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Section;
use App\Models\Student;
class AttendanceController extends Controller

{
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
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

          public function getAttendance(Request $request , $id){
            try{
        $attendance    = Attendance::find($id);

        return response()->json([
            'message' => $attendance,
        ]);
    } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

             public function getAllAttendance(Request $request){
            try{
        $attendance    = Attendance::get();

        return response()->json([
            'message' => $attendance,
        ]);
    } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

        public function updateAttendance(Request $request , $id){
                try{
        $attendance    = Attendance::find($id);   
        $input         = $request->except('_method');
        $attendance    ->update($input);
        
        return response()->json([
            'message' => 'success',
            'message' => $attendance,
        ]);
    } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
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
