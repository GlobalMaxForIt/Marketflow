<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcode Scanner</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
</head>
<style>
    #interactive canvas, #interactive video {
        max-width: 100%;
        height: auto;
        display: block;
    }
</style>
<body>
<h1>Barcode Scanner</h1>
<div id="interactive" style="width: 100%; max-width: 640px; height: 480px; border: 1px solid black;"></div>
<p>Scanned Code: <span id="result">None</span></p>

<script>
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(function(stream) {
            // Quagga konfiguratsiyasi
            Quagga.init({
                inputStream: {
                    name: "Live",
                    type: "LiveStream",
                    target: document.querySelector('#interactive'),// Kamera uchun element
                    constraints: {
                        facingMode: "environment" // Old kamera o‘rniga orqa kamera
                    }
                },
                decoder: {
                    readers: ["code_128_reader", "ean_reader", "upc_reader"] // Shtrix kod turlari
                }
            }, function(err) {
                if (err) {
                    console.log(err);
                    return;
                }
                console.log("Initialization finished. Ready to start");
                Quagga.start(); // Skannerni ishga tushirish
            });

            // Shtrix kodni o'qish
            Quagga.onDetected(function(data) {
                document.getElementById('result').textContent = data.codeResult.code;
                console.log("Scanned code: ", data.codeResult.code);
            });
        })
        .catch(function(err) {
            console.error('Camera access denied: ', err);
        });

</script>
</body>
</html>
