<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function dashboard()
    {
        $courses = Course::paginate(5);
        $myEnrollments = Enrollment::where('user_id', Auth::id())->pluck('course_id')->toArray();
        
        return view('student.dashboard', compact('courses', 'myEnrollments'));
    }

    public function showCourse(Course $course)
    {
        $course->load('lessons');
        $isEnrolled = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->exists();

        return view('student.course_show', compact('course', 'isEnrolled'));
    }

    public function enroll(Course $course)
    {
        $now = now()->toDateString();
        if ($now < $course->start_date || $now > $course->end_date) {
            return back()->withErrors(['error' => 'Запись на курс сейчас недоступна.']);
        }

        Enrollment::firstOrCreate([
            'user_id' => Auth::id(),
            'course_id' => $course->id,
        ], [
            'payment_status' => 'paid',
            'is_completed' => false
        ]);

        return redirect()->route('student.course', $course->id)->with('success', 'Вы успешно записаны на курс!');
    }

    public function cancelEnroll(Enrollment $enrollment)
    {
        if ($enrollment->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        if ($enrollment->is_completed && !Auth::user()->isAdmin()) {
            return back()->withErrors(['error' => 'Нельзя отменить запись на завершенный курс.']);
        }

        $enrollment->delete();

        if (Auth::user()->isAdmin()) {
            return back()->with('success', 'Студент успешно снят с курса.');
        }

        return redirect()->route('student.dashboard')->with('success', 'Запись на курс отменена.');
    }
}
