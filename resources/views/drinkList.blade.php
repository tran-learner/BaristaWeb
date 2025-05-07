@extends('generalTemp')
@section('specifyContent')

@section('background', 'backgroundDrinkList')
<div id="suggestBtn" class="bg-black w-fit h-fit fixed top-20 right-5 p-3 rounded-md">
    <p class="text-lg text-white">Suggest me</p>
</div>

<div id="contentWrap" class="flex flex-row items-center justify-center w-full
">
    <div id="drinkListContainer"
        class="flex flex-wrap gap-4 justify-between sm:justify-between w-5/6 max-w-[360px] sm:max-w-full
        {{-- bg-black --}}
        ">
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

<script>
    const CAMERA_SERVER = "{{ env('VITE_CAMERA_SERVER') }}";

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById("suggestBtn").onclick = async function() {
            console.log('click')
            const customer = await predictFace()
            const suggestString = handleSuggestString(customer)
            console.log(suggestString)
            document.getElementById("suggestString").textContent = suggestString
            document.getElementById("overlay").classList.remove("hidden");
        }

        async function predictFace() {
            try {
                const response = await fetch(CAMERA_SERVER)
                const prediction = await response.json()
                console.log(prediction)
                var age, gender
                age = prediction.age
                gender = prediction.gender > 0.5 ? 1 : 0
                const obj = {
                    age: age,
                    gender: gender
                }
                return obj
            } catch (e) {
                console.log(e)
            }
        }

        function handleSuggestString(customer) {
            let suggestString
            const male30 = (customer.gender == 0 && customer.age >= 30)
            const maleUnder30 = (customer.gender == 0 && customer.age < 30)
            const female30 = (customer.gender == 1 && customer.age > 30)
            const femaleUnder30 = (customer.gender == 0 && customer.age < 30)
            if (male30) {
                suggestString =
                    `Looks like a gentle man around ${customer.age}0s out there, would you like to try our black coffee?`
            }
            if (maleUnder30) {
                suggestString =
                    `Looks like a gentle man around ${customer.age}0s out there, would you like to try our milk coffee?`
            }
            if (female30) {
                suggestString =
                    `Looks like a beautiful lady around ${customer.age}0s out there, would you like to try our iced tea?`
            } else {
                suggestString = `Looks like a little girl out there, would you like to try our milk tea?`
            }
            return suggestString
        }
    })
</script>
