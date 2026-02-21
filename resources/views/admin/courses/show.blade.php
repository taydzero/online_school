@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Курс: {{ $course->name }}</h1>
    <a href="{{ route('courses.index') }}" class="text-gray-500 hover:text-gray-700">Назад к списку</a>
</div>

<div class="bg-white shadow-md rounded p-6 mb-6">
    <div class="flex space-x-6">
        <img src="{{ $course->image }}" class="w-48 h-48 object-cover rounded shadow">
        <div>
            <p class="text-gray-600 mb-2"><strong>Описание:</strong> {{ $course->description ?? 'Нет описания' }}</p>
            <p class="text-gray-600 mb-2"><strong>Продолжительность:</strong> {{ $course->hours }} часов</p>
            <p class="text-gray-600 mb-2"><strong>Цена:</strong> {{ $course->price }}</p>
            <p class="text-gray-600 mb-2"><strong>Период:</strong> {{ $course->start_date }} - {{ $course->end_date }}</p>
        </div>
    </div>
</div>

<h2 class="text-xl font-bold mb-4">Уроки курса</h2>
<div class="bg-white shadow-md rounded overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Заголовок</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Длительность</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Действия</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($course->lessons as $lesson)
            <tr>
                <td class="px-6 py-4">{{ $lesson->title }}</td>
                <td class="px-6 py-4">{{ $lesson->duration }}ч</td>
                <td class="px-6 py-4 text-right">
                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('lessons.edit', $lesson->id) }}" class="text-blue-500 hover:text-blue-700">Редакт.</a>
                        <form action="{{ route('lessons.destroy', $lesson->id) }}" method="POST" onsubmit="return confirm('Удалить урок?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">Удалить</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="px-6 py-4 text-center text-gray-500">Уроков пока нет</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

