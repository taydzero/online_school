@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Список курсов</h1>
    <a href="{{ route('courses.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300">Создать курс</a>
</div>

<div class="bg-white shadow-lg rounded-lg overflow-hidden my-6">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-100 border-b">
            <tr>
                <th class="py-4 px-6 font-bold text-gray-700 uppercase text-sm">Обложка</th>
                <th class="py-4 px-6 font-bold text-gray-700 uppercase text-sm">Название</th>
                <th class="py-4 px-6 font-bold text-gray-700 uppercase text-sm text-center">Часы</th>
                <th class="py-4 px-6 font-bold text-gray-700 uppercase text-sm text-center">Цена</th>
                <th class="py-4 px-6 font-bold text-gray-700 uppercase text-sm text-center">Даты</th>
                <th class="py-4 px-6 font-bold text-gray-700 uppercase text-sm text-center">Действия</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($courses as $course)
            <tr class="hover:bg-gray-50 transition duration-150">
                <td class="py-4 px-6">
                    <img src="{{ $course->image }}" class="w-16 h-16 object-cover rounded-md shadow-sm">
                </td>
                <td class="py-4 px-6">
                    <a href="{{ route('courses.show', $course->id) }}" class="font-semibold text-blue-600 hover:text-blue-800 underline decoration-dotted">
                        {{ $course->name }}
                    </a>
                </td>
                <td class="py-4 px-6 text-center text-gray-600">
                    {{ $course->hours }}ч
                </td>
                <td class="py-4 px-6 text-center text-gray-600">
                    {{ $course->price }}
                </td>
                <td class="py-4 px-6 text-center text-gray-500 text-xs">
                    {{ $course->start_date }}<br>—<br>{{ $course->end_date }}
                </td>
                <td class="py-4 px-6 text-center">
                    <div class="flex items-center justify-center space-x-3">
                        <a href="{{ route('courses.edit', $course->id) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">Редакт.</a>
                        <a href="{{ route('lessons.create', ['course_id' => $course->id]) }}" class="text-emerald-600 hover:text-emerald-900 font-medium">+ Урок</a>
                        <form action="{{ route('courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Удалить курс?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-rose-600 hover:text-rose-900 font-medium">Удалить</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $courses->links() }}
</div>
@endsection
