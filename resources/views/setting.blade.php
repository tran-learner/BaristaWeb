@extends('welcome')
@section('specifyContent')
<div id="pageTitle" class="flex flex-1 items-center justify-center min-h-[100px]">
    <h1 class="flex font-extrabold text-3xl text-navy">Setting</h1>
</div>
    <pre><br>Cleaning machine       <button id = "button" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">Clean</button>
    
    </pre></p>    
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("button").onclick = async function() {await sendCleaning();}
        async function sendCleaning() {
                // Tạo payload từ các giá trị slider
                try {
                    const response = await fetch('https://48a5-125-235-236-149.ngrok-free.app/pumphandle', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            Coffee: 21600,
                            Milk: 21600,
                            Tea: 21600,
                            Sugar: 21600,
                        })
                    });

                    response.ok ? alert('Cleaning finished') : alert('Cleaning error : Could not receive responde from machine');
                } catch (error) {
                    console.error('Fetch error:', error);
                }
            }
    });
</script>