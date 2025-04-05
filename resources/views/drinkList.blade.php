@extends('welcome')
@section('specifyContent')
    <div id="contentWrap" class="flex flex-row items-center justify-center w-full">
        <div id="drinkListContainer"
            class="flex flex-wrap gap-4 justify-between sm:justify-between w-5/6 max-w-[360px] sm:max-w-full">
            @foreach ($drinks as $drink)
                <a href="{{ route('getIngredients', ['drink' => $drink['name']]) }}" id="drinkSelector"
                    class="flex flex-col py-3 my-3 rounded-2xl shadow-md border-gray-200">

                    <div id="imgContainer" class="flex-4">
                        {{-- <img src="{{ Vite::asset($drink['imagePath']) }}" alt=""
                            class="w-[160px] h-[150px] sm:w-[210px] sm:h-[180px]"> --}}
                        <img src="{{ asset($drink['imagePath']) }}" alt=""
                            class="w-[160px] h-[150px] sm:w-[210px] sm:h-[180px]">
                    </div>

                    <div class="flex-1">
                        <h1 id="drinkName" class="font-bold text-center text-gray-700">{{ $drink['name'] }}</h1>
                    </div>

                </a>
            @endforeach
        </div>
    </div>
@endsection
