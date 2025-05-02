@extends('generalTemp')
@section('specifyContent')
    <div id="contentWrap" class="flex flex-row items-center justify-center w-full">
        <div id="ingListContainer"
            class="flex flex-col flex-wrap gap-4 justify-between sm:justify-between w-5/6 max-w-[360px] sm:max-w-full">
            <h1 id="drink-name" data-name="{{ $drink }}" data-price="{{ $price[0] }}" class="font-light text-3xl
                text-center text-gray-700 mb-7">Build your {{ $drink }}</h1>
            @foreach ($ingredients as $ing)
                <div class="flex items-center justify-center gap-5">
                    <label class="font-bold text-navy text-xl" for="{{ $ing . 'Input' }}">{{ $ing }}</label>
                    <div class="flex gap-2">
                        <button class="size-button text-xl opacity-clicked" data-ing="{{ $ing }}" data-value="50">S</button>
                        <button class="size-button text-xl opacity-clicked" data-ing="{{ $ing }}" data-value="100">M</button>
                        <button class="size-button text-xl opacity-clicked" data-ing="{{ $ing }}" data-value="150">L</button>
                    </div>
                    <input type="hidden" id="{{ $ing . 'Input' }}" name="{{ $ing }}" value="0">
                    <output id="{{ $ing . 'Output' }}">0</output>
                </div>
            @endforeach
            <div class="flex justify-center items-center w-full">
                <link rel="stylesheet" href="{{ asset('css/opacity_bt.css') }}">
                <button class="bg-lightblue px-10 py-2 w-fit text-white font-extrabold rounded-md mt-5 opacity-clicked"
                    id="submitBtn">OK</button>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Khai báo object chứa thông tin nguyên liệu
        const ingredients = ['Name', 'Coffee', 'Sugar', 'Tea', 'Milk', 'Price'];

        document.getElementById("submitBtn").onclick = async function() {
            // await sendIngredientQuantity();
            await operatePayment()
        }

        // Event listener for the size buttons
        document.querySelectorAll('.size-button').forEach(button => {
            button.addEventListener('click', function() {
                const ingredient = this.dataset.ing;
                const value = this.dataset.value;
                const outputId = ingredient + 'Output';
                const inputId = ingredient + 'Input';

                document.getElementById(outputId).textContent = value;
                document.getElementById(inputId).value = value;

                // Remove green color from all buttons for this ingredient
                const buttons = document.querySelectorAll(
                    `.size-button[data-ing="${ingredient}"]`);
                buttons.forEach(b => {
                    b.style.backgroundColor = ''; // Reset to default background
                    b.style.color = ''; // Reset text color if you have changed it
                });

                // Add green background to the clicked button
                this.style.backgroundColor = 'green';
                this.style.color = 'white'; // Make text visible on green background
            });
        });

        async function operatePayment() {
            // Create payload from input values
            const payload = ingredients.reduce((acc, ing) => {
                const input = document.getElementById(`${ing}Input`);
                acc[ing.charAt(0).toUpperCase() + ing.slice(1)] = input ? input.value : 0;
                return acc;
            }, {});
            payload.State = 0;
            const drinkName = document.getElementById('drink-name').getAttribute('data-name')
            const price = document.getElementById('drink-name').getAttribute('data-price')
            payload.Name = drinkName
            payload.Price = price
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
            .then(data=>{
                // console.log(data)
                window.location.href = data.checkoutUrl
            })
        }

        // async function sendIngredientQuantity() {
        //     // Create payload from input values
        //     const payload = ingredients.reduce((acc, ing) => {
        //         const input = document.getElementById(`${ing}Input`);
        //         acc[ing.charAt(0).toUpperCase() + ing.slice(1)] = input ? input.value : 0;
        //         return acc;
        //     }, {});
        //     payload.State = 0;
        //     try {
        //         const response = await fetch('https://67d1-2402-800-63b5-b58e-24a2-653-171e-715f.ngrok-free.app/pumphandle', {
        //             method: 'POST',
        //             headers: {
        //                 'Content-Type': 'application/json'
        //             },
        //             body: JSON.stringify(payload)
        //         });

        //         response.ok ? alert('Barista completed') : alert('Barista request receive error :((');
        //     } catch (error) {
        //         console.error('Fetch error:', error);
        //     }
        // }
    });
</script>

<style>
    .size-button {
        width: 50px;
        height: 50px;
        margin: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border-radius: 10px;
        background-color: white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .size-button:hover {
        background-color: lightgreen;
        border: 1px lightgreen;
        /* Light green on hover for better UX */
    }
</style>
