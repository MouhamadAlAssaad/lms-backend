<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Course;

class SectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }


//getAllSection
    public function getAllSection(Request $request){
        $sections = Section::all();
    
        return response()->json([
            'message' => 'All sections retrieved successfully!',
            'sections' => $sections,
        ]);
    }

// get by id

public function getSection(Request $request, $id)
{
    $section = Section::find($id);
    if (!$section) {
        return response()->json([
            'message' => 'Section not found',
        ], 404);
    }
    
    return response()->json([
        'message' => 'Section retrieved successfully!',
        'section' => $section,
    ]);
}

// postSection
    
    public function addSection(Request $request){
        $section = new Section();
        $name = $request->input('name');
        // $section->description = $request->input('description');
        $content = $request->input('content');
        $capacity = $request->input('capacity');
        $course_id = $request->input('course_id');
        $course = Course::find($course_id);
        $section ->name=$name;
        $section ->content=$content;
        $section->capacity=$capacity;
        $section->course()->associate($course);
        $section->save();
    
        return response()->json([
            'message' => 'Section created successfully!',
        ]);
    }
 

  // edit section
public function editSection(Request $request, $id)
{
    try{
    $section = Section::find($id);
    if (!$section) {
        return response()->json([
            'message' => 'Section not found',
        ], 404);
    }

    $inputs = $request->only(['name', 'content', 'capacity']);
    $section->update($inputs);

    return response()->json([
        'message' => 'section edited successfully!',
        'section' => $section,
    ]);
} catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
}
// delete section

public function deleteSection(Request $request,$id){
try{
    $section = Section::find($id);
    if (!$section) {
        return response()->json([
            'message' => 'Section not found',
        ], 404);
    }
 $section->delete();
 return response()->json([
    'message' => 'section deleted successfully!',
]);
} catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }

}
}