<!DOCTYPE html>
<html>
<head>
    <title>Pay via QR Code</title>
</head>
<body>
    <h2>Scan the QR Code to Pay</h2>
    @if($qrCodeUrl)
        <img src="{{ $qrCodeUrl }}" alt="QR Code for payment">
    @else
        <p>Unable to generate QR code. Please try again.</p>
    @endif
</body>
</html>
