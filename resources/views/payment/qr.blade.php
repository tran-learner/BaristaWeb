<!DOCTYPE html>
<html>
<head>
    <title>Pay with QR Code</title>
</head>
<body>
    <h2>Scan QR to Pay</h2>
    @if($qrCodeUrl)
        <img src="{{ $qrCodeUrl }}" alt="QR Code">
    @else
        <p>❌ Failed to generate QR Code.</p>
    @endif
</body>
</html>
