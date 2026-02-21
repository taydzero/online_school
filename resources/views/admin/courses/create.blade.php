@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Создать курс</h1>

<div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Название</label>
            <input type="text" name="name" class="shadow appearance-none border @error('name') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" maxlength="30" value="{{ old('name') }}" required>
            @error('name') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Описание</label>
            <textarea name="description" class="shadow appearance-none border @error('description') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" maxlength="100">{{ old('description') }}</textarea>
            @error('description') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block text-gray-700 text-sm font-bold mb-2">Продолжительность (ч)</label>
                <input type="number" name="hours" class="shadow appearance-none border @error('hours') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" max="10" value="{{ old('hours') }}" required>
                @error('hours') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block text-gray-700 text-sm font-bold mb-2">Цена</label>
                <input type="text" name="price" placeholder="100.00" class="shadow appearance-none border @error('price') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('price') }}" required>
                @error('price') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block text-gray-700 text-sm font-bold mb-2">Дата начала</label>
                <input type="date" name="start_date" class="shadow appearance-none border @error('start_date') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('start_date') }}" required>
                @error('start_date') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block text-gray-700 text-sm font-bold mb-2">Дата окончания</label>
                <input type="date" name="end_date" class="shadow appearance-none border @error('end_date') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('end_date') }}" required>
                @error('end_date') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
            </div>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Обложка (JPG, макс 2МБ)</label>
            <input type="file" name="image" class="shadow appearance-none border @error('image') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" accept="image/jpeg,image/jpg" required>
            @error('image') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Создать</button>
            <a href="{{ route('courses.index') }}" class="text-gray-500 hover:text-gray-700">Отмена</a>
        </div>
    </form>
</div>
@endsection
