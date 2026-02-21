<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация - Online School</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center p-4">
    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md">
        <h1 class="text-3xl font-bold mb-6 text-center text-indigo-700">Регистрация</h1>
        
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
                <input class="shadow appearance-none border @error('email') border-red-500 @enderror rounded-xl w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500" id="email" name="email" type="email" value="{{ old('email') }}" required>
                @error('email')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Пароль</label>
                <input class="shadow appearance-none border @error('password') border-red-500 @enderror rounded-xl w-full py-3 px-4 text-gray-700 mb-3 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500" id="password" name="password" type="password" required>
                <p class="text-gray-400 text-[10px] mt-1 italic">Мин. 3 символа, должен содержать заглавную, строчную буквы, цифру и спецсимвол (_ # ! %)</p>
                @error('password')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex flex-col space-y-4">
                <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-xl transition duration-300 shadow-lg" type="submit">
                    Зарегистрироваться
                </button>
                <div class="text-center text-sm text-gray-500">
                    Уже есть аккаунт? <a href="{{ route('login') }}" class="text-indigo-600 hover:underline font-semibold">Войти</a>
                </div>
                <a href="{{ route('home') }}" class="text-center text-xs text-gray-400 hover:text-gray-600">На главную</a>
            </div>
        </form>
    </div>
</body>
</html>
