<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('background')</title>

    @vite('resources/css/app.css')
    @vite('resources/css/tailwind.css')
    <link rel="stylesheet" href="{{ asset('css/blur.css') }}">
</head>
<body>
    <div class="background"></div>

    <div id="wholePage" class="flex flex-col h-screen content">
        <div id="pageTitle" class="flex flex-1 items-center justify-center min-h-[150px]">
            <h1 class="flex font-extrabold text-3xl text-navy">AUTO BARISTA MACHINE</h1>
        </div>

        <div id="languageBtn" class="absolute border-1 border-gray-200 text-navy h-fit w-fit px-3 py-2 rounded-md right-2 top-2">EN</div>
        <div class="absolute left-2 top-2 flex gap-4">
            <a id="backBtn" onclick="history.back()" class="border-1 border-gray-200 text-gray-400 h-fit w-fit px-3 py-1 pb-2 rounded-md"><</a>
            <a id="setBtn" href="{{ route('Setting') }}" class="border-1 border-gray-200 text-gray-400 h-fit w-fit px-3 py-1 pb-2 rounded-md">Setting</a>
        </div>

        <div id="pageContent" class="flex-6">
            @yield('specifyContent')
        </div>
    </div>
</body>
<footer>
    <button onclick="window.location.href='/teaminfo'" id="contact_us">CONTACT US</button>
    <style>
        #contact_us {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 5px;
        }

        #contact_us:hover {
            background-color: #45a049; /* Darker green */
        }
        #contact_us:active {
            background-color: #3e8e41; /* Even darker green */
            transform: translateY(2px);
        }
    </style>
</footer>
</html>
