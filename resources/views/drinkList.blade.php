@extends('generalTemp')
@section('specifyContent')
@section('background', 'backgroundDrinkList')

<div id="contentWrap" class="flex flex-row items-center justify-center w-full">
    <div id="drinkListContainer"
        class="flex flex-wrap gap-4 justify-between sm:justify-between w-5/6 max-w-[360px] sm:max-w-full">

        {{-- Iterate over the $item array. Each element will be assigned to the $drink variable. --}}
        @forelse ($item as $drink)
            {{-- Inside the loop, $drink is one of the drink objects from your array --}}
            <a href="{{ route('getIngredients', ['drink' => $drink->drink_name]) }}" id="drinkSelector"
                class="flex flex-col py-10 my-0 rounded-2xl shadow-md bg-white text-gray-800 w-[160px] sm:w-[350px] opacity-clicked items-center">
                <div id="imgContainer" class="flex-4">
                    {{-- Assuming imagePath is a property on your drink objects --}}
                    {{-- Note: imagePath is not in your provided sample data for $item. --}}
                    {{-- You might need to adjust this if imagePath is stored differently or derived. --}}
                    <img src="{{ asset($drink->imagePath ?? 'images/default_drink_image.png') }}" alt="{{ $drink->drink_name }}"
                        class="w-[150px] h-[130px] sm:w-[420px] sm:h-[300px] ">
                    <link rel="stylesheet" href="{{ asset('css/opacity_bt.css') }}">
                </div>
                <br>
                <div class="flex-1">
                    {{-- Display the drink_name from the current $drink object --}}
                    <h1 id="drinkName" class="font-bold text-center text-gray-700 text-3xl">{{ $drink->drink_name }}</h1>
                </div>
            </a>
        @empty
            {{-- This block will execute if the $item array is empty --}}
            <p>No drinks available.Check drink data or check the connection again</p>
        @endforelse

    </div>
</div>
@endsection