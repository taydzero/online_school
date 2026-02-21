@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Добавить урок в курс: {{ $course->name }}</h1>

<div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
    <form action="{{ route('lessons.store') }}" method="POST">
        @csrf
        <input type="hidden" name="course_id" value="{{ $course->id }}">
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Заголовок</label>
            <input type="text" name="title" class="shadow appearance-none border @error('title') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" maxlength="50" required>
            @error('title') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Текстовое содержание</label>
            <textarea name="content" rows="5" class="shadow appearance-none border @error('content') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
            @error('content') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Видеоссылка SuperTube (необязательно)</label>
            <input type="url" name="video_link" placeholder="https://super-tube.cc/video/v23189" class="shadow appearance-none border @error('video_link') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('video_link') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Длительность (ч)</label>
            <input type="number" name="duration" class="shadow appearance-none border @error('duration') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" max="4" required>
            @error('duration') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Добавить урок</button>
            <a href="{{ route('courses.index') }}" class="text-gray-500 hover:text-gray-700">Отмена</a>
        </div>
    </form>
</div>
@endsection

