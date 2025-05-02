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
    <style>
        .fixed-buttons {
            position: fixed;
            top: 10px;
            left: 10px;
            display: flex;
            gap: 4px;
            z-index: 10;
        }

        #languageBtn {
            position: fixed;
            top: 10px;
            right: 10px;
            z-index: 10;
        }

        #contact_us {
            /* Adjust styling for the contact button as needed */
            margin-top: 20px;
            /* Add some space above the button */
            padding: 10px 20px;
            background-color: #007bff;
            /* Example color */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            z-index: 1;
            /* Ensure it's above the background */
        }
    </style>
</head>

<body>
    <div class="background"></div>
    <div id="languageBtn" class="border-1 border-gray-200 text-navy h-fit w-fit px-3 py-2 rounded-md">EN</div>
    <div class="fixed-buttons">
        <a id="backBtn" onclick="history.back()"
            class="border-1 border-gray-200 text-gray-400 h-fit w-fit px-3 py-1 pb-2 rounded-md">
            < </a>
                <a id="setBtn" href="{{ route('Setting') }}"
                    class="border-1 border-gray-200 text-gray-400 h-fit w-fit px-3 py-1 pb-2 rounded-md">Setting</a>
    </div>
    <div id="wholePage" class="flex flex-col items-center">
        <div class="bg-white w-5/6 rounded-2xl mt-10 opacity-97">
            <div id="pageTitle" class="flex flex-1 items-center justify-center min-h-[150px] ">
                <h1 class="flex font-extrabold text-3xl text-navy">AUTO BARISTA MACHINE</h1>
            </div>
            <div id="pageContent" class="flex-6">
                @yield('specifyContent')
            </div>
            <br>
        </div>
        <button onclick="window.location.href='/teamInfo'" id="contact_us">CONTACT US</button>
    </div>
    <div>
        <link rel="stylesheet" href="css/opacity_bt.css">
        <p style="z-index: 1; position: relative;">If you have any problem or feedback, please contact email: <a
                href="mailto:ng.tri.hoang2004ct@gmail.com">ng.tri.hoang2004ct@gmail.com</a> or phone number: <a
                href="tel:+84907208782">+84907208782</a></p>
    </div>

</body>

</html>