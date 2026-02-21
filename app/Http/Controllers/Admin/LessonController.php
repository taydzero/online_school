<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function create(Request $request)
    {
        $course_id = $request->course_id;
        $course = Course::findOrFail($course_id);
        return view('admin.lessons.create', compact('course'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|max:50',
            'content' => 'required',
            'video_link' => 'nullable|url',
            'duration' => 'required|integer|max:4',
        ]);

        $course = Course::findOrFail($request->course_id);

        if ($course->lessons()->count() >= 5) {
            return back()->withErrors(['course_id' => 'A course cannot have more than 5 lessons.']);
        }

        Lesson::create($request->all());

        return redirect()->route('courses.index')->with('success', 'Lesson added successfully.');
    }

    public function edit(Lesson $lesson)
    {
        return view('admin.lessons.edit', compact('lesson'));
    }

    public function update(Request $request, Lesson $lesson)
    {
        $request->validate([
            'title' => 'required|max:50',
            'content' => 'required',
            'video_link' => 'nullable|url',
            'duration' => 'required|integer|max:4',
        ]);

        $lesson->update($request->all());

        return redirect()->route('courses.index')->with('success', 'Lesson updated successfully.');
    }

    public function destroy(Lesson $lesson)
    {
        $course = $lesson->course;
        
        if ($course->enrollments()->count() > 0) {
            return back()->withErrors(['delete' => 'Cannot delete lesson while students are enrolled in the course.']);
        }

        $lesson->delete();

        return redirect()->route('courses.index')->with('success', 'Lesson deleted successfully.');
    }
}
