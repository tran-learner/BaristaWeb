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
        /* CSS hiện có của bạn */
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

        /* Đảm bảo footer cũng có thể được style nếu cần */
        footer {
            text-align: center;
            padding: 20px;
            margin-top: 20px;
            color: #555;
            font-size: 0.9em;
        }
        footer p {
            margin-bottom: 10px;
        }
        footer a {
            color: #007bff;
            text-decoration: none;
        }
        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div id="overlay"
        class="bg-gray-700/75 w-screen h-screen fixed z-50 flex items-center justify-center backdrop-blur-sm hidden">
        {{-- <div id="suggestFrame"
            class="w-1/2 h-1/2 bg-white rounded-lg flex flex-col overflow-hidden justify-center items-center">
            <div class="flex text-lg flex-3 items-center justify-center">
                <p class="" id="suggestString"></p>
            </div>
            <div class="flex-1 items-center gap-5 justify-center flex">
                <button id="noBtn" class="bg-gray-500 text-white p-3 rounded-md">Maybe no...</button>
                <button id="okayBtn" class="bg-navy text-white p-3 px-7 rounded-md">Okay!</button>
            </div>
        </div> --}}
        <div id="suggestFrame"
            class="relative w-1/2 h-1/2 bg-white rounded-lg flex flex-col overflow-hidden justify-center items-center">

            <!-- Loading Overlay -->
            <div id="loadingOverlay" class="absolute inset-0 bg-white/80 flex items-center justify-center z-10 hidden">
                <p id="loadingStr" class="text-lg font-semibold text-gray-700 animate-pulse">Chatting with voice
                    assistant...</p>
            </div>

            <!-- Suggest Content -->
            <div id="suggestContent" class="flex flex-col flex-1 w-full h-full items-center justify-center z-0 hidden">
                <div class="flex text-lg flex-3 items-center justify-center h-1/2">
                    <p id="suggestString"></p>
                </div>
                <div class="flex-1 items-center gap-5 justify-center flex">
                    <button id="noBtn" class="bg-gray-500 text-white p-3 rounded-md">Maybe no...</button>
                    <button id="okayBtn" class="bg-navy text-white p-3 px-7 rounded-md">Okay!</button>
                </div>
            </div>

            <!-- Voice confirm content -->
            <div id="confirmContent" class="flex flex-col flex-1 w-full h-full items-center justify-center z-0 hidden">
                <div class="flex text-lg flex-3 items-center justify-center h-1/2">
                    <p id="confirmString" class="text-xl font-semibold text-center text-gray-800 px-4"></p>
                </div>
                <div class="flex-1 items-center gap-5 justify-center flex hidden">
                    <button id="noBtn" class="bg-gray-500 text-white p-3 rounded-md">Maybe no...</button>
                    <button id="okayBtn" class="bg-navy text-white p-3 px-7 rounded-md">Okay!</button>
                </div>
            </div>

        </div>

    </div>
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
        <div class="bg-white w-5/6 rounded-2xl mt-10 opacity-97" id="whiteBackground">
            <div id="pageTitle" class="flex flex-1 items-center justify-center min-h-[150px]">
                <h1 class="flex font-extrabold text-3xl text-navy">AUTO BARISTA MACHINE</h1>
            </div>
            <div id="pageContent" class="flex-6 fade-target">
                @yield('specifyContent')
            </div>
            <br>
        </div>
        <!-- Nút CONTACT US và footer không nằm trong chuỗi fade-in chính,
             nhưng bạn có thể thêm class .fade-target và ID nếu muốn chúng fade in sau cùng -->
        <button onclick="window.location.href='/teamInfo'" id="contact_us">CONTACT US</button>
    </div>
    <footer>
        <link rel="stylesheet" href="css/opacity_bt.css">
        <p style="z-index: 1; position: relative;">If you have any problem or feedback, please contact email: <a
                href="mailto:ng.tri.hoang2004ct@gmail.com">ng.tri.hoang2004ct@gmail.com</a> or phone number: <a
                href="tel:+84907208782">+84907208782</a></p>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const backgroundEffect = document.getElementById('backgroundEffect');
            const whiteBackground = document.getElementById('whiteBackground');
            const pageTitle = document.getElementById('pageTitle');
            const pageContent = document.getElementById('pageContent');
            // Bạn có thể thêm các phần tử khác ở footer nếu muốn chúng fade in sau cùng
            // const contactUsBtn = document.getElementById('contact_us');
            // const footerText = document.querySelector('footer p');

            // Hàm để thêm class và kích hoạt fade-in
            const activateFadeIn = (element, delay) => {
                if (element) {
                    setTimeout(() => {
                        element.classList.add('fade-in-active');
                    }, delay);
                }
            };

            const animationDuration = 800; // Thời gian animation của mỗi phần tử (ms)
            const delayBetweenElements = 250; // Khoảng cách thời gian giữa các phần tử (ms)

            // backgroundEffect, whiteBackground và pageTitle sẽ hiển thị ngay lập tức
            // Kích hoạt các hiệu ứng cho các phần tử còn lại
            activateFadeIn(pageContent, 0); // Nội dung chính sẽ là phần tử đầu tiên fade in

            // Nếu bạn muốn nút CONTACT US và footer cũng fade in, hãy thêm vào đây:
            // activateFadeIn(contactUsBtn, delayBetweenElements * 4);
            // activateFadeIn(footerText, delayBetweenElements * 5);
        });
    </script>
</body>

</html>
