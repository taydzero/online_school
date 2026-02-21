@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-black text-gray-900 uppercase tracking-tight">Список студентов</h1>
</div>

<div class="mb-8 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
    <form action="{{ route('admin.students') }}" method="GET" class="flex flex-wrap items-end gap-4">
        <div class="flex-grow max-w-xs">
            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Фильтр по курсу</label>
            <select name="course_id" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm font-bold text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all">
                <option value="">Все студенты</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-black py-3 px-8 rounded-xl text-xs uppercase tracking-widest transition-all shadow-lg shadow-indigo-100">
            Фильтровать
        </button>
        <a href="{{ route('admin.students') }}" class="py-3 px-4 text-xs font-black text-gray-400 uppercase tracking-widest hover:text-gray-600 transition-colors">
            Сбросить
        </a>
    </form>
</div>

<div class="bg-white shadow-xl shadow-gray-200/50 rounded-3xl overflow-hidden border border-gray-100">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-50 border-b border-gray-100">
                <th class="py-5 px-6 text-xs font-black text-gray-400 uppercase tracking-widest">Имя</th>
                <th class="py-5 px-6 text-xs font-black text-gray-400 uppercase tracking-widest">Email</th>
                <th class="py-5 px-6 text-xs font-black text-gray-400 uppercase tracking-widest">Курс(ы)</th>
                <th class="py-5 px-6 text-xs font-black text-gray-400 uppercase tracking-widest text-center">Дата записи</th>
                <th class="py-5 px-6 text-xs font-black text-gray-400 uppercase tracking-widest text-center">Действия</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50 text-sm font-medium text-gray-600">
            @foreach($students as $item)
            @php
                $user = $isFiltered ? $item->user : $item;
                $enrollments_to_show = $isFiltered ? [$item] : $item->enrollments;
            @endphp
            <tr class="hover:bg-indigo-50/30 transition-colors">
                <td class="py-5 px-6 whitespace-nowrap font-bold text-gray-900">
                    {{ $user->name }}
                </td>
                <td class="py-5 px-6">
                    {{ $user->email }}
                </td>
                <td class="py-5 px-6">
                    @if(count($enrollments_to_show) > 0)
                        <div class="flex flex-wrap gap-1.5">
                            @foreach($enrollments_to_show as $e)
                                <div class="flex items-center bg-indigo-100 text-indigo-700 px-3 py-1 rounded-lg text-[11px] font-black uppercase tracking-tight">
                                    <span>{{ $e->course->name }}</span>
                                    <form action="{{ route('student.cancel', $e->id) }}" method="POST" class="ml-2 border-l border-indigo-200 pl-2" onsubmit="return confirm('Снять студента с этого курса?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-rose-500 hover:text-rose-700">✕</button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <span class="text-gray-300 italic">Нет записей</span>
                    @endif
                </td>
                <td class="py-5 px-6 text-center font-mono text-gray-400 text-xs">
                    {{ $user->created_at->format('d-m-Y') }}
                </td>
                <td class="py-5 px-6 text-center">
                    @if(count($enrollments_to_show) > 0)
                        <span class="bg-emerald-100 text-emerald-700 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest">Активен</span>
                    @else
                        <span class="bg-gray-100 text-gray-400 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest border border-gray-200">Только регистрация</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-8">
    {{ $students->links() }}
</div>
@endsection
