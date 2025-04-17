<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Учет расходов</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 p-6">
{{--<div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
    <a href="http://127.0.0.1:8000/login" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

    <a href="http://127.0.0.1:8000/register" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
</div>--}}
{{--<div @click="open = ! open">
    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
        <div></strong><span style="color: blue;">{{ Auth::user()->name }}</div>

        <div class="ms-1">
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </div>
    </button>
</div>--}}

<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    @yield('content')
</div>
</body>
</html>
