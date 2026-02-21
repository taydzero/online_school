<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online School</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-center p-4">
    <div class="bg-white p-8 md:p-12 rounded-3xl shadow-2xl text-center max-w-4xl w-full border border-gray-100">
        <h1 class="text-6xl font-black text-indigo-700 mb-8 tracking-tight">Портал онлайн-обучения</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
            <!-- Блок пользователя -->
            <div class="bg-indigo-50 p-8 rounded-2xl border-2 border-indigo-100 flex flex-col items-center justify-center shadow-inner">
                <div class="w-20 h-20 bg-indigo-600 rounded-2xl rotate-3 flex items-center justify-center mb-6 shadow-xl">
                    <svg class="w-10 h-10 text-white -rotate-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                </div>
                
                @auth
                    <h2 class="text-3xl font-black text-indigo-900 mb-2">Привет!</h2>
                    <p class="text-indigo-700/70 mb-8 text-sm font-medium">{{ Auth::user()->email }}</p>
                    
                    <div class="flex flex-col space-y-4 w-full">
                        <a href="{{ route('student.dashboard') }}" class="bg-indigo-600 text-white font-black py-4 rounded-xl hover:bg-indigo-700 transition duration-300 shadow-lg shadow-indigo-200">
                            К моим курсам
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="w-full text-indigo-400 font-bold py-2 hover:text-rose-500 transition-colors text-sm">
                                Выйти
                            </button>
                        </form>
                    </div>
                @else
                    <h2 class="text-3xl font-black text-indigo-900 mb-4">Для студентов</h2>
                    <p class="text-indigo-700/70 mb-8 text-sm">Войдите или зарегистрируйтесь, чтобы начать обучение.</p>
                    <div class="flex flex-col space-y-4 w-full">
                        <a href="{{ route('login') }}" class="bg-indigo-600 text-white font-black py-4 rounded-xl hover:bg-indigo-700 transition duration-300 shadow-lg shadow-indigo-200">
                            Войти в систему
                        </a>
                        <a href="{{ route('register') }}" class="text-indigo-600 font-bold py-2 hover:underline">
                            Создать аккаунт
                        </a>
                    </div>
                @endauth
            </div>

            <!-- Блок описания -->
            <div class="flex flex-col justify-center text-left space-y-6">
                <div>
                    <h3 class="text-2xl font-black text-gray-800 mb-2">Добро пожаловать!</h3>
                    <p class="text-gray-500 leading-relaxed font-medium">Это полнофункциональный портал онлайн-образования. Здесь вы найдете лучшие курсы для вашего развития.</p>
                </div>
                
                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100">
                    <h4 class="font-bold text-gray-700 mb-3 text-sm">Наши возможности:</h4>
                    <ul class="text-xs text-gray-500 space-y-3">
                        <li class="flex items-center space-x-2">
                            <span class="w-1.5 h-1.5 bg-indigo-500 rounded-full"></span>
                            <span>Личный кабинет с вашим прогрессом</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <span class="w-1.5 h-1.5 bg-indigo-500 rounded-full"></span>
                            <span>Доступ к материалам после записи</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <span class="w-1.5 h-1.5 bg-indigo-500 rounded-full"></span>
                            <span>Простой и удобный интерфейс</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Нижняя кнопка админки -->
        <div class="pt-8 border-t border-gray-100 flex flex-col items-center">
            @can('admin')
                <a href="{{ route('admin.dashboard') }}" class="group flex items-center space-x-3 bg-slate-900 hover:bg-black text-white px-10 py-4 rounded-2xl transition duration-300 shadow-xl hover:shadow-2xl transform hover:-translate-y-1">
                    <span class="font-black uppercase tracking-widest text-xs">Админ-панель</span>
                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            @else
                @guest
                    <a href="{{ route('login') }}" class="text-gray-300 hover:text-indigo-400 transition-colors text-xs font-bold uppercase tracking-widest">Вход для администрации</a>
                @endguest
            @endcan
        </div>
    </div>
</body>
</html>
