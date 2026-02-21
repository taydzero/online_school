<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Online School</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex space-x-7">
                    <div>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center py-4 px-2">
                            <span class="font-semibold text-gray-500 text-lg">School Admin</span>
                        </a>
                    </div>
                    <div class="hidden md:flex items-center space-x-1">
                        <a href="{{ route('courses.index') }}" class="py-4 px-2 text-gray-500 font-semibold hover:text-blue-500 transition duration-300">Курсы</a>
                        <a href="{{ route('admin.students') }}" class="py-4 px-2 text-gray-500 font-semibold hover:text-blue-500 transition duration-300">Студенты</a>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="py-2 px-4 font-medium text-white bg-red-500 rounded-xl hover:bg-red-600 transition duration-300 shadow-md">Выход</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto mt-8 px-4">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative mb-4 shadow-sm" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl relative mb-4 shadow-sm" role="alert">
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>
