<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Home</title>
    @vite('resources/css/app.css')
    @vite('resources/css/tailwind.css')
</head>
<body>
    <div id="wholePage" class="flex flex-col h-screen">

        <div id="pageTitle" class="flex flex-1 items-center justify-center min-h-[150px]">
            <h1 class="flex font-extrabold text-3xl text-navy">Auto Barista Machine</h1>
        </div>

        <div id="languageBtn" class="absolute border-1 border-gray-200 text-navy h-fit w-fit px-3 py-2 rounded-md right-2 top-2">EN</div>
        <div class="absolute left-2 top-2 flex gap-4"> <!-- Sử dụng flex và gap -->
            <a id="backBtn" onclick="history.back()" class="border-1 border-gray-200 text-gray-400 h-fit w-fit px-3 py-1 pb-2 rounded-md"><</a>
            <a id="setBtn" href="{{ route('Setting') }}" class="border-1 border-gray-200 text-gray-400 h-fit w-fit px-3 py-1 pb-2 rounded-md">Setting</a>
        </div>
        <div id="pageContent" class="flex-6">
            @yield('specifyContent')
        </div>
    </div>
</body>
</html>