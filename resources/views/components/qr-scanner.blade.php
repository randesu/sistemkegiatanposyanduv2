<div class="p-4 border rounded-lg bg-gray-50 text-center space-y-3">
    <h3 class="text-lg font-semibold">Scan QR Balita</h3>

    <!-- Tombol untuk memulai scan -->
    <button
        id="start-scan"
        type="button"
        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
    >
        Mulai Scan
    </button>

    <!-- Area tempat kamera muncul -->
    <div id="qr-reader" class="hidden mt-3 mx-auto" style="width: 250px;"></div>
</div>

<script src="https://unpkg.com/html5-qrcode"></script>
<script>
document.addEventListener('livewire:load', function () {
    if (typeof Html5Qrcode === 'undefined') return;

    const qrReader = new Html5Qrcode("qr-reader");
    const button = document.getElementById('start-scan');
    const qrContainer = document.getElementById('qr-reader');

    let scanning = false;

    button.addEventListener('click', async () => {
        if (scanning) {
            // Hentikan scan
            await qrReader.stop();
            qrContainer.classList.add('hidden');
            button.textContent = 'Mulai Scan';
            scanning = false;
        } else {
            // Mulai scan
            qrContainer.classList.remove('hidden');
            button.textContent = 'Berhenti Scan';
            scanning = true;

            try {
                await qrReader.start(
                    { facingMode: "environment" },
                    { fps: 10, qrbox: 200 },
                    (decodedText) => {
                        Livewire.emit('balitaScanned', decodedText);
                        qrReader.stop();
                        qrContainer.classList.add('hidden');
                        button.textContent = 'Mulai Scan';
                        scanning = false;
                    },
                    (error) => {}
                );
            } catch (err) {
                console.error('Gagal membuka kamera:', err);
                alert('Gagal membuka kamera. Pastikan izin kamera diaktifkan.');
            }
        }
    });
});
</script>
