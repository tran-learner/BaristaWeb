<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Thanh toán thành công</title>
        <link rel="stylesheet" href="style.css" />
    </head>
    <body>
        <div class="main-box">
            <h4 class="payment-titlte">
                Thanh toán thành công. Cảm ơn bạn đã sử dụng payOS!
            </h4>
            <p>
                Nếu có bất kỳ câu hỏi nào, hãy gửi email tới
                <a href="mailto:support@payos.vn">support@payos.vn</a>
            </p>
            <a href="/" id="return-page-btn"
                >Trở về trang Tạo Link thanh toán</a>
            <p id = "drink-data">{{ json_encode($paymentData) }}</p>
        </div>
    </body>
</html>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        pElement = document.getElementById('drink-data')
        drinkData = pElement.textContent
        console.log(drinkData)
        async function sendIngredientQuantity() {
            // Create payload from input values
            try {
                const response = await fetch('https://67d1-2402-800-63b5-b58e-24a2-653-171e-715f.ngrok-free.app/pumphandle', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: drinkData;
                });

                response.ok ? alert('Barista completed') : alert('Barista request receive error :((');
            } catch (error) {
                console.error('Fetch error:', error);
            }
        }
    });
</script>