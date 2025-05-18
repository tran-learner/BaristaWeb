@extends('generalTemp')
@section('specifyContent')
        <div class="main-box">
            <div class="centered-content">
                <h1 class="inline-block">Payment successful. Your drink is being baristed</h1>
            <p id = "drink-data" style="display:none">{{ json_encode($paymentData) }}</p>
        </div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        pElement = document.getElementById('drink-data')
        drinkData = pElement.textContent
        console.log(drinkData)
        async function sendIngredientQuantity() {
            // Create payload from input values
            try {
                const response = await fetch('https://9e8a-125-235-236-38.ngrok-free.app/pumphandle', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: drinkData
                });
                response.ok ? (window.location.href = '/') : alert('Barista request receive error :((');
            } catch (error) {
                console.error('Fetch error:', error);
            }
        }
        sendIngredientQuantity()
    });
</script>