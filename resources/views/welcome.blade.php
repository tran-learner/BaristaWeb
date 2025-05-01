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
    <style>
        .top-bar {
            display: flex;
            justify-content: center; /* Horizontally center the content */
            width: 100%; /* Ensure it spans the entire width */
            padding-top: 20px; /* Add some space at the top if needed */
            padding-bottom: 20px; /* Add some space below if needed */
        }
        .logo-container {
            height: 150px; /* Set the desired height */
        }
        .logo-container img {
            max-height: 100%; /* Ensure the image doesn't exceed the container height */
        }
    </style>
    <div class="top-bar">
        <div class="logo-container">
            <img src="https://yu.ctu.edu.vn/images/upload/article/2020/03/0305-logo-ctu.png" alt="CTU logo">
        </div>
    </div>
    <div class="background"></div>
    <div id="languageBtn" class="absolute border-1 border-gray-200 text-navy h-fit w-fit px-3 py-2 rounded-md right-2 top-2">EN</div>
    <div class="absolute left-2 top-2 flex gap-4">
        <a id="setBtn" href="{{ route('Setting') }}" class="border-1 border-gray-200 text-gray-400 h-fit w-fit px-3 py-1 pb-2 rounded-md">Setting</a>
    </div>
    <div class="centered-content">
        <h1 class="inline-block">WELCOME TO AUTO BARISTA MACHINE</h1>
        <button class="bg-lightblue px-10 py-2 w-fit text-white font-extrabold rounded-md mt-5 opacity-clicked" id="submitBtn">START</button>
    </div>

    <style>
    .centered-content {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        min-height: calc(100vh - 190px); /* Adjust for the top bar height */
        margin: 0;
        text-align: center;
    }
    .centered-content h1 {
        margin-bottom: 20px;
        font-size: 5rem;
        font-weight: bold;
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
        font-size: 1.75rem;
    }

    #submitBtn:hover {
        background-color: #0056b3;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
    }
    </style>
</body>
<footer>
    <p>If you have any problem or feedback, please contact email: <a href="mailto:ng.tri.hoang2004ct@gmail.com">ng.tri.hoang2004ct@gmail.com</a> or phone number: <a href="tel:+84907208782">+84907208782</a></p>
    <button onclick="window.location.href='/teamInfo'" id="contact_us">CONTACT US</button>
    <link rel="stylesheet" href="css/opacity_bt.css">
</footer>
</html>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("submitBtn").onclick = async function() {
            // await sendIngredientQuantity();
            await (window.location.href = '/drinks');
        }
    });
</script>