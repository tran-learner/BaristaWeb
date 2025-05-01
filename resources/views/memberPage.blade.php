@extends('generalTemp')
@section('specifyContent')
    <div id="contentWrap" class="flex flex-row items-center justify-center w-full">
        <div id="ingListContainer"
            class="flex flex-col flex-wrap gap-4 justify-between sm:justify-between w-5/6 max-w-[360px] sm:max-w-full">
            <h1 id="drink-name" data-name="{{ $info }}" class="font-light text-2xl
                text-center text-gray-700 mb-7">Infomation about {{ $info }}</h1>
            {{-- @foreach ($infos as $ing)
                <div class="flex items-center justify-center gap-5">
                    
                </div>
            @endforeach --}}
        </div>
    </div>
@endsection