<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет - Online School</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 min-h-screen font-sans">
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-3xl font-black text-indigo-600 tracking-tighter">SCHOOL.</a>
                    <a href="{{ route('student.dashboard') }}" class="text-sm font-bold text-gray-900 border-b-2 border-indigo-600 pb-1">Моё обучение</a>
                </div>
                <div class="flex items-center space-x-6">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Студент</p>
                        <p class="text-sm font-bold text-gray-900">{{ Auth::user()->email }}</p>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-rose-50 text-rose-600 px-5 py-2 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-rose-600 hover:text-white transition-all duration-300">
                            Выйти
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-10 p-5 bg-emerald-50 border-2 border-emerald-100 text-emerald-700 rounded-2xl shadow-sm flex items-center space-x-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span class="font-bold">{{ session('success') }}</span>
            </div>
        @endif

        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 space-y-4 md:space-y-0">
            <div>
                <h1 class="text-5xl font-black text-gray-900 tracking-tight">Каталог курсов</h1>
                <p class="text-gray-500 mt-2 font-medium text-lg">Выберите направление для развития своих навыков</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($courses as $course)
                <div class="group bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col h-full">
                    <div class="relative h-56 overflow-hidden">
                        <img src="{{ $course->image }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute top-4 left-4">
                            <span class="bg-white/90 backdrop-blur-md px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest text-indigo-600 shadow-sm">
                                {{ $course->hours }}ч. обучения
                            </span>
                        </div>
                    </div>
                    
                    <div class="p-8 flex flex-col flex-grow">
                        <h2 class="text-2xl font-black text-gray-900 mb-3 leading-tight">{{ $course->name }}</h2>
                        <p class="text-gray-500 text-sm leading-relaxed mb-8 line-clamp-3 font-medium">{{ $course->description }}</p>
                        
                        <div class="mt-auto">
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-gray-100 mb-6">
                                <div>
                                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-0.5">Стоимость</p>
                                    <p class="text-xl font-black text-indigo-600">{{ $course->price }} ₽</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-0.5">Старт</p>
                                    <p class="text-sm font-bold text-gray-700">{{ $course->start_date }}</p>
                                </div>
                            </div>
                            
                            @if(in_array($course->id, $myEnrollments))
                                <a href="{{ route('student.course', $course->id) }}" class="block w-full bg-gray-900 text-white text-center py-4 rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-black transition-colors shadow-lg">
                                    Продолжить обучение
                                </a>
                            @else
                                <a href="{{ route('student.course', $course->id) }}" class="block w-full bg-indigo-600 text-white text-center py-4 rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100">
                                    Узнать подробнее
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-16">
            {{ $courses->links() }}
        </div>
    </main>
</body>
</html>
