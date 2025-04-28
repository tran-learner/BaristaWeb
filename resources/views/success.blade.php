@extends('welcome')
@section('specifyContent')
        <div class="main-box">
            <h4 class="payment-titlte">
                Thanh toán thành công. Cảm ơn bạn đã sử dụng payOS!
            </h4>
            <p>
                Nếu có bất kỳ câu hỏi nào, hãy gửi email tới
                <a href="mailto:support@payos.vn">support@payos.vn</a>
            </p>
            <p style="">Payment successful. Your drink is being baristed</p>
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
                const response = await fetch('https://a163-125-235-236-149.ngrok-free.app/pumphandle', {
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