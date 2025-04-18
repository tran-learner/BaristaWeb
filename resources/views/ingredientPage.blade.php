@extends('welcome')
@section('specifyContent')
    <div id="contentWrap" class="flex flex-row items-center justify-center w-full">
        <div id="ingListContainer"
            class="flex flex-col flex-wrap gap-4 justify-between sm:justify-between w-5/6 max-w-[360px] sm:max-w-full">
            <h1 class="font-light text-2xl text-center text-gray-700 mb-7">Build your {{ $drink }}!</h1>
            @foreach ($ingredients as $ing)
                <div class="flex items-center justify-center gap-5">
                    <label class="font-bold text-navy" for="{{ $ing . 'Input' }}">{{ $ing }}</label>
                    <input type="range" id="{{$ing.'Input'}}" name="coffee" min="0" max="1000"
                        data-output-id="{{ $ing.'Output'}}" value="0" oninput=""
                        class="sm:w-96 h-20 ing-range">
                    <output id="{{$ing.'Output'}}">0</output>
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
        // Khai báo object chứa thông tin nguyên liệu
        const ingredients = ['Coffee', 'Sugar', 'Tea', 'Milk'];
        
        document.getElementById("submitBtn").onclick = async function() {
            await sendIngredientQuantity();
        }

        // Xử lý sự kiện cho tất cả slider
        document.querySelectorAll('.ing-range').forEach(input => {
            input.addEventListener('input', function() {
                const output = document.getElementById(this.dataset.outputId);
                output && (output.textContent = this.value);
            });
        });

        async function sendIngredientQuantity() {
            // Tạo payload từ các giá trị slider
            const payload = ingredients.reduce((acc, ing) => {
                const input = document.getElementById(`${ing}Input`);
                acc[ing.charAt(0).toUpperCase() + ing.slice(1)] = input ? input.value : 0;
                return acc;
            }, {});

            try {
                const response = await fetch('https://fdc6-125-235-236-149.ngrok-free.app/pumphandle', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                response.ok ? alert('Settings sent!') : alert('Error occurred');
            } catch (error) {
                console.error('Fetch error:', error);
            }
        }
    });
</script>