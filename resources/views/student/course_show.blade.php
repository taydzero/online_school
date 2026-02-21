<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->name }} - Online School</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 min-h-screen font-sans">
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center h-20">
                <a href="{{ route('student.dashboard') }}" class="text-sm font-black text-indigo-600 flex items-center group">
                    <svg class="w-5 h-5 mr-2 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    НАЗАД К КАТАЛОГУ
                </a>
            </div>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        @if($errors->any())
            <div class="mb-8 p-5 bg-rose-50 border-2 border-rose-100 text-rose-700 rounded-2xl flex items-center space-x-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span class="font-bold">{{ $errors->first() }}</span>
            </div>
        @endif

        @if(session('success'))
            <div class="mb-8 p-5 bg-emerald-50 border-2 border-emerald-100 text-emerald-700 rounded-2xl flex items-center space-x-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span class="font-bold">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-gray-200 border border-gray-100 overflow-hidden mb-16">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <div class="h-80 lg:h-auto relative">
                    <img src="{{ $course->image }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-8">
                        <div class="flex space-x-4">
                            <span class="bg-white/20 backdrop-blur-md px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest text-white border border-white/30">
                                {{ $course->hours }}ч. КУРС
                            </span>
                        </div>
                    </div>
                </div>
                <div class="p-10 lg:p-16 flex flex-col justify-center">
                    <h1 class="text-5xl font-black text-gray-900 mb-6 leading-tight tracking-tight">{{ $course->name }}</h1>
                    <p class="text-gray-500 text-lg mb-10 leading-relaxed font-medium">{{ $course->description }}</p>
                    
                    <div class="grid grid-cols-2 gap-6 mb-10">
                        <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100 text-center">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Старт курса</p>
                            <p class="text-lg font-black text-gray-900">{{ $course->start_date }}</p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100 text-center">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Окончание</p>
                            <p class="text-lg font-black text-gray-900">{{ $course->end_date }}</p>
                        </div>
                    </div>

                    @if($isEnrolled)
                        <div class="space-y-4">
                            <div class="flex items-center justify-center p-5 bg-emerald-50 border-2 border-emerald-100 text-emerald-700 rounded-2xl font-black space-x-3 shadow-sm">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                <span>ВЫ ЗАПИСАНЫ НА ОБУЧЕНИЕ</span>
                            </div>
                            
                            @php
                                $enrollment = Auth::user()->enrollments()->where('course_id', $course->id)->first();
                            @endphp
                            
                            <form action="{{ route('student.cancel', $enrollment->id) }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите отменить запись на курс?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full text-rose-500 font-bold py-2 hover:text-rose-700 transition-colors text-xs uppercase tracking-widest">
                                    Отменить запись на курс
                                </button>
                            </form>
                        </div>
                    @else
                        <form action="{{ route('student.enroll', $course->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-indigo-600 text-white font-black py-5 rounded-2xl hover:bg-indigo-700 transition duration-300 shadow-xl shadow-indigo-200 uppercase tracking-widest text-sm">
                                Начать учиться бесплатно
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <h2 class="text-4xl font-black text-gray-900 mb-10 tracking-tight">Учебный план</h2>
        <div class="space-y-6">
            @forelse($course->lessons as $index => $lesson)
                <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-xl shadow-gray-200/50">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                        <div class="flex items-center space-x-8">
                            <span class="text-5xl font-black text-indigo-100">{{ sprintf('%02d', $index + 1) }}</span>
                            <div>
                                <h3 class="text-2xl font-black text-gray-900 mb-1">{{ $lesson->title }}</h3>
                                <div class="flex items-center text-sm text-gray-400 font-bold uppercase tracking-widest">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $lesson->duration }} часа контента
                                </div>
                            </div>
                        </div>
                        
                        @if($isEnrolled)
                            <div x-data="{ open: false }" class="w-full md:w-auto">
                                <button @click="open = !open" class="w-full md:w-auto bg-gray-900 text-white px-8 py-3 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-black transition-colors flex items-center justify-center">
                                    <span x-show="!open">Изучить урок</span>
                                    <span x-show="open">Закрыть</span>
                                    <svg class="w-4 h-4 ml-2 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </button>
                                
                                <div x-show="open" x-collapse x-cloak class="mt-8 pt-8 border-t border-gray-100">
                                    <div class="prose prose-indigo max-w-none text-gray-600 font-medium leading-relaxed">
                                        {!! nl2br(e($lesson->content)) !!}
                                    </div>
                                    @if($lesson->video_link)
                                        <div class="mt-8">
                                            <a href="{{ $lesson->video_link }}" target="_blank" class="inline-flex items-center text-indigo-600 font-black hover:text-indigo-700 underline decoration-indigo-200 underline-offset-8">
                                                <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"/></svg>
                                                Смотреть видео на SuperTube
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="flex items-center text-gray-300 font-black text-xs uppercase tracking-widest">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                Доступно после записи
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-20 bg-white rounded-3xl border border-dashed border-gray-200">
                    <p class="text-gray-400 font-bold">В этом курсе пока нет уроков</p>
                </div>
            @endforelse
        </div>
    </main>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>[x-cloak] { display: none !important; }</style>
</body>
</html>
