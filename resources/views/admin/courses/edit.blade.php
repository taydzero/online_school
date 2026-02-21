@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Редактировать курс: {{ $course->name }}</h1>

<div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
    <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Название</label>
            <input type="text" name="name" value="{{ old('name', $course->name) }}" class="shadow appearance-none border @error('name') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" maxlength="30" required>
            @error('name') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Описание</label>
            <textarea name="description" class="shadow appearance-none border @error('description') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" maxlength="100">{{ old('description', $course->description) }}</textarea>
            @error('description') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block text-gray-700 text-sm font-bold mb-2">Продолжительность (ч)</label>
                <input type="number" name="hours" value="{{ old('hours', $course->hours) }}" class="shadow appearance-none border @error('hours') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" max="10" required>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block text-gray-700 text-sm font-bold mb-2">Цена</label>
                <input type="text" name="price" value="{{ old('price', $course->price) }}" class="shadow appearance-none border @error('price') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block text-gray-700 text-sm font-bold mb-2">Дата начала</label>
                <input type="date" name="start_date" value="{{ old('start_date', $course->start_date) }}" class="shadow appearance-none border @error('start_date') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block text-gray-700 text-sm font-bold mb-2">Дата окончания</label>
                <input type="date" name="end_date" value="{{ old('end_date', $course->end_date) }}" class="shadow appearance-none border @error('end_date') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Обложка (оставьте пустым, если не хотите менять)</label>
            <div class="flex items-center space-x-4">
                <img src="{{ $course->image }}" class="w-16 h-16 object-cover rounded">
                <input type="file" name="image" class="shadow appearance-none border @error('image') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" accept="image/jpeg,image/jpg">
            </div>
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Обновить</button>
            <a href="{{ route('courses.index') }}" class="text-gray-500 hover:text-gray-700">Отмена</a>
        </div>
    </form>
</div>
@endsection

