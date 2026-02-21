<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::paginate(5);
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:30',
            'description' => 'nullable|max:100',
            'hours' => 'required|integer|max:10',
            'price' => 'required|numeric|min:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'image' => 'required|image|mimes:jpeg,jpg|max:2000',
        ]);

        $image = $request->file('image');
        $filename = 'mpic' . time() . '.' . $image->getClientOriginalExtension();

        $manager = new ImageManager(new Driver());
        $img = $manager->read($image);
        $img->scaleDown(300, 300);

        Storage::disk('public')->put('courses/' . $filename, (string) $img->encodeByExtension($image->getClientOriginalExtension()));

        Course::create([
            'name' => $request->name,
            'description' => $request->description,
            'hours' => $request->hours,
            'price' => $request->price,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'image' => '/storage/courses/' . $filename,
        ]);

        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }

    public function show(Course $course)
    {
        $course->load('lessons');
        return view('admin.courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required|max:30',
            'description' => 'nullable|max:100',
            'hours' => 'required|integer|max:10',
            'price' => 'required|numeric|min:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,jpg|max:2000',
        ]);

        $data = $request->only(['name', 'description', 'hours', 'price', 'start_date', 'end_date']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'mpic' . time() . '.' . $image->getClientOriginalExtension();

            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);
            $img->scaleDown(300, 300);

            Storage::disk('public')->put('courses/' . $filename, (string) $img->encodeByExtension($image->getClientOriginalExtension()));
            $data['image'] = '/storage/courses/' . $filename;
        }

        $course->update($data);

        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }
}
