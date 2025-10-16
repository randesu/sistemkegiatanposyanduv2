<div class="p-4 border rounded-lg bg-gray-50 text-center">
    <h3 class="text-lg font-semibold mb-2">Scan QR Balita</h3>
    <div id="qr-reader" style="width: 250px; margin: 0 auto;"></div>
</div>

<script src="https://unpkg.com/html5-qrcode"></script>
<script>
document.addEventListener('livewire:load', function () {
    const qrReader = new Html5Qrcode("qr-reader");
    qrReader.start(
        { facingMode: "environment" },
        { fps: 10, qrbox: 200 },
        (decodedText) => {
            Livewire.emit('balitaScanned', decodedText);
            qrReader.stop();
        },
        (error) => {}
    ).catch(console.error);
});
</script>
