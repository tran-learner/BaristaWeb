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
        <button onclick="window.location.href='/teamInfo'" id="contact_us">CONTACT US</button>
        <link rel="stylesheet" href="css/opacity_bt.css">
    </div>
    
</body>
<footer>
    <p>If you have any problem or feedback, please contact email: <a href="mailto:ng.tri.hoang2004ct@gmail.com">ng.tri.hoang2004ct@gmail.com</a> or phone number: <a href="tel:+84907208782">+84907208782</a></p>
</footer>
</html>
