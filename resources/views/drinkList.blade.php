@extends('generalTemp')
@section('specifyContent')
@section('background', 'backgroundDrinkList')
<div id="contentWrap" class="flex flex-row items-center justify-center w-full">
    <div id="drinkListContainer"
        class="flex flex-wrap gap-4 justify-between sm:justify-between w-5/6 max-w-[360px] sm:max-w-full">
        @foreach ($drinks as $drink)
            <a href="{{ route('getIngredients', ['drink' => $drink['name']]) }}" id="drinkSelector"
                class="flex flex-col py-10 my-0 rounded-2xl shadow-md bg-white text-gray-800 w-[160px] sm:w-[350px] opacity-clicked items-center">
                <div id="imgContainer" class="flex-4">
                    {{-- <img src="{{ Vite::asset($drink['imagePath']) }}" alt=""
                            class="w-[160px] h-[150px] sm:w-[210px] sm:h-[180px]"> --}}
                    <img src="{{ asset($drink['imagePath']) }}" alt=""
                        class="w-[150px] h-[130px] sm:w-[420px] sm:h-[300px] ">
                    <link rel="stylesheet" href="{{ asset('css/opacity_bt.css') }}">
                </div>
                <br>
                <div class="flex-1">
                    <h1 id="drinkName" class="font-bold text-center text-gray-700 text-3xl">{{ $drink['name'] }}</h1>
                </div>

            </a>
        @endforeach
    </div>
</div>
@endsection

<script></script>