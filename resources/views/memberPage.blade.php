@extends('generalTemp')
@section('specifyContent')
    <div id="contentWrap" class="flex flex-row items-center justify-center w-full">
        <div id="ingListContainer"
            class="flex flex-col flex-wrap gap-4 justify-between sm:justify-between w-5/6 max-w-[360px] sm:max-w-full">
            <h1 id="drink-name" data-name="{{ $info }}" class="font-light text-2xl
                text-center text-gray-700 mb-7">Infomation about {{ $info }}</h1>
            <img src="{{ asset($imagePath) }}" alt="Image of {{ $info }}" class="w-full h-auto mb-4 rounded-lg shadow-md">
            <a href="{{ asset('https://www.facebook.com/' .$facebook) }}" target="blank"><img src="images/app_icon/facebook.png" alt="Facebook" ></a>
            <a href="{{ asset('mailto:' .$email) }}" ><img src="images/app_icon/email.png" alt="Email" ></a>
        </div>
    </div>
@endsection