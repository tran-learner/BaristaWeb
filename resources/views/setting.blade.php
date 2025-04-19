@extends('welcome')
@section('specifyContent')
<div id="pageTitle" class="flex flex-1 items-center justify-center min-h-[100px]">
    <h1 class="flex font-extrabold text-3xl text-navy">Setting</h1>
</div>
    <pre><br>Cleaning machine       <button id = "clean" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">Clean</button></pre>
    <pre><br>Shutdown machine       <button id = "shut" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">Shutdown</button></pre>
    <pre><br>Restart machine        <button id = "restart" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">Restart</button></pre>
</div>  
@endsection

<script>
    cleaning={
        Coffee: 21600,
        Milk: 21600,
        Tea: 21600,
        Sugar: 21600,
        State: 0,
    }
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("clean").onclick = async function() {await sendCleaning();}
        async function sendCleaning() {
                // Tạo object cleaning từ các giá trị slider
                try {
                    const response = await fetch('https://ebe7-125-235-236-149.ngrok-free.app/pumphandle', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(cleaning)
                    });

                    response.ok ? alert('Cleaning finished') : alert('Cleaning error : Could not receive responde from machine');
                } catch (error) {
                    console.error('Fetch error:', error);
                }
            }

        document.getElementById("shut").onclick = async function() {await sendCleaning();}
        async function sendCleaning() {
            // Tạo object cleaning từ các giá trị slider
            cleaning.State = 1;
            try {
                const response = await fetch('https://48a5-125-235-236-149.ngrok-free.app/pumphandle', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(cleaning)
                });

                response.ok ? "" : alert('Shutdown error : Could not receive responde from machine');
            } catch (error) {
                console.error('Fetch error:', error);
            }
        }

        document.getElementById("restart").onclick = async function() {await sendCleaning();}
        async function sendCleaning() {
            // Tạo object cleaning từ các giá trị slider
            cleaning.State = 2;
            try {
                const response = await fetch('https://48a5-125-235-236-149.ngrok-free.app/pumphandle', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(cleaning)
                });

                response.ok ? "" : alert('Shutdown error : Could not receive responde from machine');
            } catch (error) {
                console.error('Fetch error:', error);
            }
        }
    });
</script>