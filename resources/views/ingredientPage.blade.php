@extends('welcome')
@section('specifyContent')
    <div id="contentWrap" class="flex flex-row items-center justify-center w-full">
        <div id="ingListContainer"
            class="flex flex-col flex-wrap gap-4 justify-between sm:justify-between w-5/6 max-w-[360px] sm:max-w-full">
            <h1 class="font-light text-2xl text-center text-gray-700 mb-7">Build your {{ $drink }}!</h1>
            @foreach ($ingredients as $ing)
                <div class="flex items-center justify-center gap-5">
                    <label class="font-bold text-navy" for="{{ $ing . 'Input' }}">{{ $ing }}</label>
                    <input type="range" id="{{ $ing . 'Input' }}" name="coffee" min="0" max="1000"
                    data-output-id="{{ $ing . 'Output' }}"
                        value="500" oninput="updateValueCF()" class="sm:w-96 h-20 ing-range">
                    <output id="{{ $ing . 'Output' }}">500</output>
                </div>
            @endforeach
            <div class="flex justify-center items-center w-full">
                <button class="bg-lightblue px-10 py-2 w-fit text-white font-extrabold rounded-md mt-5"
                    id="submitBtn">OK</button>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("submitBtn").onclick = async function() {
            await sendIngredientQuantity()
        }

        document.querySelectorAll('.ing-range').forEach(input=>{
            input.addEventListener('input', function(){
                const outputId = this.dataset.outputId
                const output = document.getElementById(outputId)
                if (output) {
                    output.textContent = this.value
                }
            })
        })

        async function sendIngredientQuantity() {
            // const sugarValue = document.getElementById("sugarValue").textContent
            // const coffeeValue = document.getElementById("coffeeValue").textContent
            // const response = await fetch('http://127.0.0.1:8085/pumphandle', {
            //     method: 'POST',
            //     headers: {
            //         'Content-Type': 'application/json'
            //     },
            //     body: JSON.stringify({
            //         sugar: sugarValue,
            //         coffee: coffeeValue
            //     })
            // })
            // if (response.ok) alert('POST ok')
            // else {
            //     console.log(response.status)
            // }
            alert('Waiting for hw server...')
        }
    })
</script>
