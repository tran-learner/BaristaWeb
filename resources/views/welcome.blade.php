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

    <style>
        /* CSS hiện có của bạn */
        .top-bar {
            display: flex;
            justify-content: center;
            width: 100%;
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .logo-container {
            height: 150px;
        }

        .logo-container img {
            max-height: 100%;
        }

        .centered-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            /* Điều chỉnh chiều cao cho phù hợp với nội dung */
            min-height: calc(100vh - 190px - 100px); /* Adjust for the top bar height and footer */
            margin: 0;
            text-align: center;
        }

        .centered-content h1 {
            margin-bottom: 20px;
            font-size: 5rem;
            font-weight: bold;
        }

        .submit-btn { /* Đổi từ #submitBtn sang class để dùng chung cho 2 nút */
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

        .submit-btn:hover {
            background-color: #0056b3;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }

        /* --- HIỆU ỨNG FADE-IN MỚI --- */

        /* Định nghĩa animation fade-in */
        @keyframes fadeInMoveUp {
            from {
                opacity: 0;
                transform: translateY(20px); /* Bắt đầu hơi dịch chuyển xuống dưới */
            }
            to {
                opacity: 1;
                transform: translateY(0); /* Về vị trí ban đầu */
            }
        }

        /* Ẩn các phần tử ban đầu trước khi animation chạy */
        .fade-target {
            opacity: 0;
        }

        /* Class để kích hoạt animation */
        .fade-in-active {
            animation: fadeInMoveUp 0.8s ease-out forwards; /* Tên, thời gian, hàm thời gian, giữ trạng thái cuối */
        }
    </style>
</head>

<body>
    <div class="background fade-target" id="backgroundEffect"></div>
    <div id="languageBtn"
        class="absolute border-1 border-gray-200 text-navy h-fit w-fit px-3 py-2 rounded-md right-2 top-2"
        style="position:fixed">EN</div>
    <div class="absolute left-2 top-2 flex gap-4">
        <a id="setBtn" href="{{ route('Setting') }}"
            class="border-1 border-gray-200 text-gray-400 h-fit w-fit px-3 py-1 pb-2 rounded-md"
            style="position: fixed">Setting</a>
    </div>
    <div class="flex items-center justify-center">
        <div class="bg-white w-5/6 min-h-9/10 rounded-2xl h-fit mt-50 opacity-95 fade-target" id="whiteBackground">
            <div class="top-bar">
                <div class="logo-container">
                    <img src="https://yu.ctu.edu.vn/images/upload/article/2020/03/0305-logo-ctu.png" alt="CTU logo">
                </div>
            </div>

            <div class="centered-content">
                <h1 class="inline-block fade-target" id="welcomeTitle">WELCOME TO AUTO BARISTA MACHINE</h1>
                <button class="bg-lightblue px-10 py-2 w-fit text-white font-extrabold rounded-md mt-5 opacity-clicked submit-btn fade-target"
                    id="startBtn">START</button>
                <button class="bg-lightblue px-10 py-2 w-fit text-white font-extrabold rounded-md mt-5 opacity-clicked submit-btn fade-target"
                    id="microBtn"><img src="images/app_icon/micro.png" class="h-[30px]"></button>
            </div>
        </div>
    </div>
</body>
<footer>
    <p>If you have any problem or feedback, please contact email: <a
            href="mailto:ng.tri.hoang2004ct@gmail.com">ng.tri.hoang2004ct@gmail.com</a> or phone number: <a
            href="tel:+84907208782">+84907208782</a></p>
    <button onclick="window.location.href='/teamInfo'" id="contact_us">CONTACT US</button>
    <link rel="stylesheet" href="css/opacity_bt.css">
</footer>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const backgroundEffect = document.getElementById('backgroundEffect');
        const whiteBackground = document.getElementById('whiteBackground');
        const welcomeTitle = document.getElementById('welcomeTitle');
        const startBtn = document.getElementById('startBtn');
        const microBtn = document.getElementById('microBtn');

        // Hàm để thêm class và kích hoạt fade-in
        const activateFadeIn = (element, delay) => {
            if (element) {
                setTimeout(() => {
                    element.classList.add('fade-in-active');
                }, delay);
            }
        };

        // Kích hoạt các hiệu ứng theo thứ tự
        const animationDuration = 800; // Thời gian animation của mỗi phần tử (ms)
        const delayBetweenElements = 250; // Khoảng cách thời gian giữa các phần tử (ms)

        activateFadeIn(backgroundEffect, 0); // Background hiện lên ngay lập tức
        activateFadeIn(whiteBackground, delayBetweenElements * 1); // Nền trắng
        activateFadeIn(welcomeTitle, delayBetweenElements * 2); // Dòng chữ WELCOME
        activateFadeIn(startBtn, delayBetweenElements * 3); // Nút START
        activateFadeIn(microBtn, delayBetweenElements * 4); // Nút Micro

        // Chức năng của nút START (giữ nguyên)
        if (startBtn) {
            startBtn.onclick = async function () {
                // await sendIngredientQuantity(); // Bỏ comment nếu bạn cần hàm này
                window.location.href = '/drinks';
            }
        }
    });
</script>

</html>