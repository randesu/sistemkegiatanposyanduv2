@props(['balitaStatePath'])

<div
    x-data="balitaQrScanner({
        onScan: (value) => $wire.set('data.{{ $balitaStatePath }}', value),
    })"
    x-init="init()"
    class="space-y-2"
>
    <div class="text-sm text-gray-600">
        Klik tombol <strong>Scan QR</strong> untuk membuka kamera, lalu arahkan ke QR balita.
        Nilai ID akan otomatis mengisi field <strong>Balita</strong>.
    </div>

    <div class="flex gap-2">
        <!-- Tombol mulai scan -->
        <x-filament::button
            type="button"
            x-show="!isScanning"
            x-on:click="startScan()"
            icon="heroicon-o-qr-code"
        >
            Scan QR
        </x-filament::button>

        <!-- Tombol stop scan -->
        <x-filament::button
            type="button"
            color="gray"
            x-show="isScanning"
            x-on:click="stopScan()"
            icon="heroicon-o-x-circle"
        >
            Stop Scan
        </x-filament::button>
    </div>

    {{-- Area kamera: hanya tampil saat scanning --}}
    <div
        id="balita-qr-reader"
        style="width: 100%; max-width: 320px;"
        x-show="isScanning"
    ></div>

    <div class="text-xs text-gray-500" x-text="status"></div>
</div>

<script src="https://unpkg.com/html5-qrcode"></script>

<script>
    function balitaQrScanner(config) {
        return {
            status: 'Belum mulai scan.',
            isScanning: false,
            html5QrCode: null,

            init() {
                if (!window.Html5Qrcode) {
                    this.status = 'Gagal memuat library scanner.';
                    return;
                }

                // Jangan start kamera di sini, cukup siapkan instance saat dibutuhkan
                this.status = 'Siap untuk scan. Klik tombol "Scan QR".';
            },

            startScan() {
                if (!window.Html5Qrcode) {
                    this.status = 'Gagal memuat library scanner.';
                    return;
                }

                if (!this.html5QrCode) {
                    this.html5QrCode = new Html5Qrcode('balita-qr-reader');
                }

                this.status = 'Membuka kamera...';

                Html5Qrcode.getCameras().then(cameras => {
                    if (!cameras || cameras.length === 0) {
                        this.status = 'Kamera tidak ditemukan.';
                        return;
                    }

                    // 🔍 Prioritaskan kamera belakang
                    let backCamera = cameras.find(cam => {
                        const label = (cam.label || '').toLowerCase();
                        return label.includes('back') || label.includes('rear') || label.includes('environment');
                    });

                    // Jika tidak ketemu, fallback ke kamera terakhir (biasanya belakang)
                    if (!backCamera) {
                        backCamera = cameras[cameras.length - 1];
                    }

                    const cameraId = backCamera.id;
                    this.isScanning = true;

                    this.html5QrCode.start(
                        { deviceId: { exact: cameraId } },
                        { fps: 10, qrbox: { width: 250, height: 250 } },
                        (decodedText, decodedResult) => {
                            const value = decodedText.trim();

                            // ✅ Set nilai balita_id di form Filament (ID balita dari QR)
                            config.onScan(value);

                            this.status = 'QR terbaca: ' + value;

                            // Auto stop setelah berhasil scan (kalau mau scan terus, hapus baris ini)
                            this.stopScan();
                        },
                        (errorMessage) => {
                            // error per frame, boleh diabaikan
                        }
                    ).catch(err => {
                        console.error(err);
                        this.status = 'Tidak bisa mengakses kamera.';
                        this.isScanning = false;
                    });
                }).catch(err => {
                    console.error(err);
                    this.status = 'Tidak bisa mengakses daftar kamera.';
                });
            },

            stopScan() {
                if (!this.html5QrCode || !this.isScanning) {
                    this.isScanning = false;
                    return;
                }

                this.html5QrCode.stop()
                    .then(() => {
                        this.isScanning = false;
                        this.status = 'Scan dihentikan.';
                    })
                    .catch(err => {
                        console.error('Gagal stop kamera', err);
                        this.isScanning = false;
                    });
            },
        }
    }
</script>
