<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::all();
        
        // Если выбран фильтр по курсу, показываем только записи на этот курс
        if ($request->has('course_id') && $request->course_id != '') {
            $students = Enrollment::with(['user', 'course'])
                ->where('course_id', $request->course_id)
                ->paginate(10);
            
            $isFiltered = true;
        } else {
            // Если фильтра нет, показываем всех пользователей с ролью student
            // и подгружаем их записи на курсы
            $students = User::where('role', 'student')
                ->with(['enrollments.course'])
                ->paginate(10);
            
            $isFiltered = false;
        }

        return view('admin.students.index', compact('students', 'courses', 'isFiltered'));
    }
}
