<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('background')</title>

    @vite('resources/css/app.css')
    @vite('resources/css/tailwind.css')
    <link rel="stylesheet" href="{{ asset('css/blur.css') }}">
</head>
<body>
    <div class="background"></div>
    <div id="languageBtn" class="absolute border-1 border-gray-200 text-navy h-fit w-fit px-3 py-2 rounded-md right-2 top-2">EN</div>
    <div class="absolute left-2 top-2 flex gap-4">
        <a id="backBtn" onclick="history.back()" class="border-1 border-gray-200 text-gray-400 h-fit w-fit px-3 py-1 pb-2 rounded-md"><</a>
        <a id="setBtn" href="{{ route('Setting') }}" class="border-1 border-gray-200 text-gray-400 h-fit w-fit px-3 py-1 pb-2 rounded-md">Setting</a>
    </div>
    <div class="centered-content">
        <h1 class="inline-block">WELCOME TO AUTO BARISTA MACHINE</h1>
        <button class="bg-lightblue px-10 py-2 w-fit text-white font-extrabold rounded-md mt-5 opacity-clicked" id="submitBtn">START</button>
    </div>

    <style>
    .centered-content {
        display: flex;          /* Use flexbox for centering */
        flex-direction: column;  /* Stack items vertically by default */
        justify-content: center;  /* Center content horizontally */
        align-items: center;      /* Center content vertically */
        min-height: 100vh;      /* Ensure full viewport height */
        margin: 0;            /* Remove default body margins */
        text-align: center;      /* Center text within items */
    }
    .centered-content h1 {
        margin-bottom: 20px; /* Add space between heading and button */
    }

    #submitBtn {
        background-color: #0075FF;
        color: white;
        padding: 10px 50px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    #submitBtn:hover {
        background-color: #0056b3;  /* Darker blue on hover */
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3); /* Increased shadow on hover */
    }

    #submitBtn:active {
        background-color: #004080;  /* Even darker blue on active */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); /* Smaller shadow on active */
        transform: translateY(1px); /* Simulate button press */
    }
    </style>
    <footer>
        <p>If you have any problem or feedback, please contact email: <a href="mailto:ng.tri.hoang2004ct@gmail.com">ng.tri.hoang2004ct@gmail.com</a> or phone number: <a href="tel:+84907208782">+84907208782</a></p>
    </footer>
</body>
</html>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("submitBtn").onclick = async function() {
            // await sendIngredientQuantity();
            window.location.href = '/drinklist';
        }
    }
</script>