<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    public function buy($course_id)
    {
        $course = Course::find($course_id);

        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }

        $now = now()->toDateString();
        if ($now < $course->start_date || $now > $course->end_date) {
            return response()->json(['message' => 'Course is not available for enrollment'], 400);
        }

        $existing = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $course_id)
            ->first();

        if ($existing) {
            return response()->json(['message' => 'Already enrolled'], 400);
        }

        Enrollment::create([
            'user_id' => Auth::id(),
            'course_id' => $course_id,
            'payment_status' => 'success',
            'is_completed' => false,
        ]);

        return response()->json([
            'pay_url' => 'http://localhost/success' 
        ], 200);
    }

    public function index()
    {
        $enrollments = Enrollment::where('user_id', Auth::id())
            ->with('course')
            ->get();

        return response()->json([
            'data' => $enrollments->map(function($enrollment) {
                return [
                    'id' => $enrollment->id,
                    'payment_status' => $enrollment->payment_status === 'success' ? 'success(оплачен)' : 'pending(ожидает оплаты)',
                    'course' => [
                        'id' => $enrollment->course->id,
                        'name' => $enrollment->course->name,
                        'description' => $enrollment->course->description,
                        'hours' => $enrollment->course->hours,
                        'img' => $enrollment->course->image,
                        'start_date' => $enrollment->course->start_date,
                        'end_date' => $enrollment->course->end_date,
                        'price' => $enrollment->course->price,
                    ],
                    'is_completed' => $enrollment->is_completed || now()->toDateString() > $enrollment->course->end_date
                ];
            })
        ]);
    }

    public function cancel($id)
    {
        $enrollment = Enrollment::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$enrollment) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        if ($enrollment->payment_status === 'success' && $enrollment->is_completed) {
            return response()->json([
                'status' => 'was payed'
            ], 418);
        }

        $enrollment->delete();

        return response()->json([
            'status' => 'success'
        ], 200);
    }
}
