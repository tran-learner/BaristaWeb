@extends('generalTemp')
@section('specifyContent')
    <div id="pageTitle" class="flex flex-1 items-center justify-center min-h-[100px]">
        <h1 class="flex font-extrabold text-3xl text-navy">
            <pre>SETTING MACHINE
        </pre>
        </h1>
    </div>

    <!-- WiFi status section, above the buttons -->
    <div id="wifiStatusContainer" style="padding: 10px 0;">
        <button id="refreshWifi"
            style="background-color: #4A90E2; color: #fff; padding: 6px 20px; border: none; border-radius: 4px; cursor: pointer;">Refresh
            WiFi Status</button>
        <pre id="wifiStatus"
            style="background: #f3f3f3; color: #333; padding: 8px; border-radius: 4px; margin-top: 8px; font-size: 1rem;"></pre>
    </div>

    <pre><br>   Cleaning machine       <button id="clean" style="background-color: #0075FF" class="opacity-clicked set_but">Clean</button></pre>
    <pre><br>   Shutdown machine       <button id="shut" style="background-color: #eb4934" class="opacity-clicked set_but">Shutdown</button></pre>
    <pre><br>   Restart machine        <button id="restart" style="background-color: #c6eb34" class="opacity-clicked set_but">Restart</button></pre>
    <link rel="stylesheet" href="{{ asset('css/opacity_bt.css') }}">
    <br>
    <div class="h-150"></div>
@endsection

<script>
    // Declare only one ngrok base URL
    // let ngrokBaseURL = 'https://8ddd-125-235-237-224.ngrok-free.app';
    const NGROK_URL = "{{ env('VITE_RASP_URL') }}"

    cleaning = {
        Coffee: 2160,
        Milk: 2160,
        Tea: 2160,
        Sugar: 2160,
        State: 0,
    }

    // Fetch WiFi Status (now via POST)
    async function fetchWifiStatus() {
        const wifiStatusElem = document.getElementById('wifiStatus');
        wifiStatusElem.textContent = 'Loading...';
        try {
            const resp = await fetch(NGROK_URL + '/wifi', {
                method: 'POST',
                headers: {
                    'ngrok-skip-browser-warning': 'true'
                }
            });
            if (!resp.ok) throw new Error('Could not fetch WiFi status');
            const data = await resp.json();
            wifiStatusElem.textContent =
                `WiFi: ${data.ssid || 'unknown'}
Signal: ${data.signal} dBm
IPv4: ${data.ipv4}
IPv6: ${data.ipv6}
MAC: ${data.mac}`;
        } catch (err) {
            wifiStatusElem.textContent = 'Error: ' + err;
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        // WiFi status events
        document.getElementById('refreshWifi').onclick = fetchWifiStatus;
        fetchWifiStatus(); // Load on page load

        // Machine operation events
        document.getElementById("clean").onclick = async function() {
            await sendCleaning();
        }
        async function sendCleaning() {
            try {
                const response = await fetch(NGROK_URL + '/pumphandle', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(cleaning)
                });
                response.ok ? alert('Cleaning finished') : alert(
                    'Cleaning error : Could not receive response from machine');
            } catch (error) {
                console.error('Fetch error:', error);
            }
        }

        document.getElementById("shut").onclick = async function() {
            await sendShut();
        }
        async function sendShut() {
            cleaning.State = 1;
            try {
                const response = await fetch(NGROK_URL + '/pumphandle', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(cleaning)
                });
                cleaning.State = 0;
                response.ok ? "" : alert('Shutdown error : Could not receive response from machine');
            } catch (error) {
                console.error('Fetch error:', error);
            }
        }

        document.getElementById("restart").onclick = async function() {
            await sendRestart();
        }
        async function sendRestart() {
            cleaning.State = 2;
            try {
                const response = await fetch(NGROK_URL + '/pumphandle', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(cleaning)
                });
                cleaning.State = 0;
                response.ok ? "" : alert('Shutdown error : Could not receive response from machine');
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
