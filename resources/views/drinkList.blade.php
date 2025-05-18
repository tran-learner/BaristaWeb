@extends('generalTemp')
@section('specifyContent')

@section('background', 'backgroundDrinkList')
<div class="fixed top-20 right-5">
    <div id="suggestBtn"
        class="bg-black text-white px-4 py-2 rounded-md flex items-center gap-2 shadow-md hover:bg-gray-800 transition">
        <p class="text-base font-medium">Suggest me</p>
        <img src="{{ asset('images/app_icon/star.png') }}" alt="Mic" class="w-5 h-5">
    </div>
    <div id="voiceBtn"
        class="bg-black text-white px-4 py-2 rounded-md flex items-center gap-2 shadow-md hover:bg-gray-800 transition mt-3">
        <p class="text-base font-medium">Voice order</p>
        <img src="{{ asset('images/app_icon/in_mic.png') }}" alt="Mic" class="w-5 h-5">
    </div>
</div>


<div id="contentWrap" class="flex flex-row items-center justify-center w-full
">
    <div id="drinkListContainer"
        class="flex flex-wrap gap-4 justify-between sm:justify-between w-5/6 max-w-[360px] sm:max-w-full
        {{-- bg-black --}}
        ">
        @foreach ($drinks as $drink)
            {{-- <a href="{{ route('getIngredients', ['drink' => $drink['name']]) }}" id="drinkSelector" --}}
            <a href="{{ route('getIngredients', ['drink' => $drink['name']]) }}" id="{{ $drink['name'] }}"
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
    const CAMERA_SERVER = "{{ env('VITE_CAMERA_SERVER') }}"
    const VOICE_SERVER = "{{ env('VITE_VOICE_SERVER') }}"
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById("suggestBtn").onclick = async function() {
            const customer = await predictFace()
            const suggestResult = handleSuggestString(customer)
            const pElement = document.getElementById("suggestString").textContent = suggestString
            pElement.textContent = suggestResult.suggestString
            pElement.dataset.drink = suggestResult.drinkName
            document.getElementById("overlay").classList.remove("hidden");
        }

        async function predictFace() {
            try {
                const response = await fetch(CAMERA_SERVER)
                const prediction = await response.json()
                console.log(prediction)
                var age, gender
                age = prediction.age
                gender = prediction.gender >= 0.6 ? 1 : 0
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
            let suggestString, drinkName
            const male30 = (customer.gender == 0 && customer.age >= 3)
            const maleUnder30 = (customer.gender == 0 && customer.age < 3)
            const female30 = (customer.gender == 1 && customer.age >= 3)
            const femaleUnder30 = (customer.gender == 0 && customer.age < 3)
            if (male30) {
                drinkName = 'Coffee'
                suggestString =
                    `Looks like a gentle man around ${customer.age}0s out there, `
            } else if (maleUnder30) {
                drinkName = 'Milk Coffee'
                suggestString =
                    `Looks like a gentle man around ${customer.age}0s out there, `
            } else if (female30) {
                drinkName = 'Tea'
                suggestString =
                    `Looks like a beautiful lady around ${customer.age}0s out there, `
            } else {
                drinkName = 'Milk Tea'
                suggestString = `Looks like a little girl out there, `
            }
            suggestString += `would you like to try our ${drinkName}?`
            const obj = {
                drinkName: drinkName,
                suggestString: suggestString
            }
            return obj
        }
        document.getElementById('voiceBtn').onclick = async function() {
            // hiện overlay
            displayLoading('voice')
            // kết nối với voice server 
            const order = await getOrderByVoice()
            const orderString = handleOrderString(order)
            // hiện kết quả
            voicePopup(orderString)
            operatePayment(order)
            // đến payload
        }

        function displayLoading(type) {
            let str = ''
            if (type == 'camera') {
                str = 'Looking at you to find your match...'
            } else if (type == 'voice') {
                str = 'Chatting with voice assistant...'
            }
            document.getElementById('loadingStr').textContent = str
            document.getElementById("overlay").classList.remove("hidden")
            document.getElementById("loadingOverlay").classList.remove("hidden")
        }

        async function getOrderByVoice() {
            const response = await fetch(VOICE_SERVER)
            console.log(response)
            const res = await response.json()
            return res
        }

        function handleOrderString(res) {
            const drink = res.drink
            const details = res.details
            let drinkSize = 'medium'
            let description = []

            for (let ing in details) {
                if (ing == 'price') continue
                const level = mapLevel(details[ing])
                if (ing === drink) drinkSize = level
                else {
                    description.push(`${level} ${uncapitalize(ing)}`)
                }
            }

            const descStr = description.length ? `${description.join(', ')}` : ''
            return `Order confirmed: ${drinkSize} ${drink} with ${descStr}`
        }

        async function operatePayment(orderObj) {
            console.log(orderObj)
            const drinkName = orderObj.drink
            const ingredients = orderObj.details
            const payload = {}
            payload.Name = drinkName
            for (let ing in ingredients) {
                if (ing == 'price') break
                let level = ingredients[ing]
                if (uncapitalize(level) == 's') level = 50
                else if (uncapitalize(level) == 'm') level = 100
                else level = 150
                payload[`${ing}`] = level
            }
            payload.State = 0;
            payload.Price = orderObj.details.price
            console.log(payload)
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch('/checkout', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify(payload)
                })
                .then(res => {
                    result = res.json()
                    console.log(result)
                    return result
                })
                .then(data => {
                    // console.log(data)
                    window.location.href = data.checkoutUrl
                })
        }

        function mapLevel(code) {
            switch (code) {
                case 's':
                    return 'small';
                case 'm':
                    return 'medium';
                case 'l':
                    return 'large';
                default:
                    return 'Normal';
            }
        }

        function uncapitalize(str) {
            return str.charAt(0).toLowerCase() + str.slice(1);
        }

        document.getElementById("okayBtn").onclick = function() {
            console.log('click')
            const drinkName = document.getElementById('suggestString').dataset.drink
            document.getElementById(drinkName).click()
        }

        document.getElementById("noBtn").onclick = function() {
            document.getElementById("overlay").classList.add("hidden")
        }

        function voicePopup(str) {
            document.getElementById('loadingOverlay').classList.add('hidden')
            document.getElementById('confirmString').textContent = str
            document.getElementById('confirmContent').classList.remove('hidden')
        }
    })
</script>
