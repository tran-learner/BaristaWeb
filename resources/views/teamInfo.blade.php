@extends('generalTemp')
@section('specifyContent')
@section('background', 'backgroundDrinkList')
<div id="contentWrap" class="flex flex-row items-center justify-center w-full">
    <div id="drinkListContainer"
        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 w-5/6 max-w-full justify-items-center">
        @foreach ($infos as $info)
            <div id="infoSelector"
                class="flex flex-col py-3 my-3 rounded-2xl shadow-md bg-white text-gray-800 w-full max-w-[300px] hover:shadow-lg transition ">

                <a href="{{ route('getInfos', ['info' => $info['name']]) }}" class="flex flex-col items-center opacity-clicked">
                    <img src="{{ asset($info['imagePath']) }}" alt=""
                        class="w-full h-[150px] sm:h-[250px] rounded-t-2xl">
                    <h1 id="drinkName" class="font-bold text-center text-gray-700 py-2 text-xl">{{ $info['name'] }}<br>{{ $info['position'] }}</h1>
                </a>
                <div class="flex justify-center py-2">
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

<style>
    #drinkListContainer {
        justify-content: center; /* Center the grid items horizontally */
    }
</style>