@extends('generalTemp')
@section('specifyContent')
@section('background', 'backgroundDrinkList')
<div id="contentWrap" class="flex flex-row items-center justify-center w-full">
    <div id="drinkListContainer"
        class="flex flex-wrap gap-4 justify-between sm:justify-between w-5/6 max-w-[360px] sm:max-w-full">
        @foreach ($infos as $info)
            <div id="infoSelector"
                class="flex flex-col py-3 my-3 rounded-2xl shadow-md bg-white text-gray-800 w-[160px] sm:w-[210px] transition">

                <a href="{{ route('getInfos', ['info' => $info['name']]) }}" class="flex flex-col items-center opacity-clicked">
                    <img src="{{ asset($info['imagePath']) }}" alt=""
                        class="w-[150px] h-[130px] sm:w-[210px] sm:h-[180px] rounded-t-2xl">
                    <h1 id="drinkName" class="font-bold text-center text-gray-700 py-2">{{ $info['name'] }}</h1>
                </a>
                <div class="flex justify-around items-center py-2 ">
                    <a href="https://www.facebook.com/{{ $info['facebook'] }}" target="blank"><img
                            src="{{ asset('images/app_icon/facebook.png') }}" alt="Facebook" class="w-[30px] h-[30px] opacity-clicked"></a>
                    <a href="mailto:{{ $info['email'] }}"><img src="{{ asset('images/app_icon/email.png') }}"
                            alt="Email" class="w-[30px] h-[30px] opacity-clicked"></a>
                </div>

            </div>
        @endforeach
    </div>
</div>
@endsection