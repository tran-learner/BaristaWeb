@extends('generalTemp')
@section('specifyContent')
<div id="pageTitle" class="flex flex-1 items-center justify-center min-h-[100px]">
    <h1 class="flex font-extrabold text-3xl text-navy"><pre>SETTING MACHINE
        </pre></h1>
</div>
    <pre><br>   Cleaning machine       <button id = "clean" style="background-color: #0075FF" class = "opacity-clicked set_but">Clean</button></pre>
    <pre><br>   Shutdown machine       <button id = "shut" style="background-color: #eb4934" class = "opacity-clicked set_but">Shutdown</button></pre>
    <pre><br>   Restart machine        <button id = "restart" style="background-color: #c6eb34" class = "opacity-clicked set_but">Restart</button></pre>
    <link rel="stylesheet" href="{{ asset('css/opacity_bt.css') }}">
    <br>
    <div class="h-150"></div>
</div>  
@endsection

<script>
    cleaning={
        Coffee: 2160,
        Milk: 2160,
        Tea: 2160,
        Sugar: 2160,
        State: 0,
    }
    let ngrokURL='https://32f2-125-235-236-149.ngrok-free.app/pumphandle'
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("clean").onclick = async function() {await sendCleaning();}
        async function sendCleaning() {
                // Tạo object cleaning từ các giá trị slider
                try {
                    const response = await fetch(ngrokURL, {
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

        document.getElementById("shut").onclick = async function() {await sendShut();}
        async function sendShut() {
            // Tạo object cleaning từ các giá trị slider
            cleaning.State = 1;
            try {
                const response = await fetch(ngrokURL, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(cleaning)
                });
                cleaning.State = 0;
                response.ok ? "" : alert('Shutdown error : Could not receive responde from machine');
            } catch (error) {
                console.error('Fetch error:', error);
            }
        }

        document.getElementById("restart").onclick = async function() {await sendRestart();}
        async function sendRestart() {
            // Tạo object cleaning từ các giá trị slider
            cleaning.State = 2;
            try {
                const response = await fetch(ngrokURL, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(cleaning)
                });
                cleaning.State = 0;
                response.ok ? "" : alert('Shutdown error : Could not receive responde from machine');
            } catch (error) {
                console.error('Fetch error:', error);
            }
        }
    });
</script>

<style>
    .set_but {
        color: white;
        padding: 10px 50px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
</style>