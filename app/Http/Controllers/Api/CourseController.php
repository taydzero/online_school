<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::paginate(5);

        return response()->json([
            'data' => collect($courses->items())->map(function($course) {
                return [
                    'id' => $course->id,
                    'name' => $course->name,
                    'description' => $course->description,
                    'hours' => $course->hours,
                    'img' => url($course->image),
                    'start_date' => $course->start_date->format('d-m-Y'),
                    'end_date' => $course->end_date->format('d-m-Y'),
                    'price' => number_format($course->price, 2, '.', ''),
                ];
            }),
            'pagination' => [
                'total' => $courses->lastPage(),
                'current' => $courses->currentPage(),
                'per_page' => $courses->perPage(),
            ]
        ]);
    }

    public function show($id)
    {
        $course = Course::with('lessons')->find($id);

        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }

        return response()->json([
            'data' => $course->lessons->map(function($lesson) {
                return [
                    'id' => $lesson->id,
                    'name' => $lesson->title,
                    'description' => $lesson->content,
                    'video_link' => $lesson->video_link,
                    'hours' => $lesson->duration,
                ];
            })
        ]);
    }
}
