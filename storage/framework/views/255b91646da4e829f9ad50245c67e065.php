<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['balitaStatePath']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['balitaStatePath']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div
    x-data="balitaQrScanner({
        onScan: (value) => $wire.set('data.<?php echo e($balitaStatePath); ?>', value),
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
        <?php if (isset($component)) { $__componentOriginal6330f08526bbb3ce2a0da37da512a11f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6330f08526bbb3ce2a0da37da512a11f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.button.index','data' => ['type' => 'button','xShow' => '!isScanning','xOn:click' => 'startScan()','icon' => 'heroicon-o-qr-code']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'button','x-show' => '!isScanning','x-on:click' => 'startScan()','icon' => 'heroicon-o-qr-code']); ?>
            Scan QR
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6330f08526bbb3ce2a0da37da512a11f)): ?>
<?php $attributes = $__attributesOriginal6330f08526bbb3ce2a0da37da512a11f; ?>
<?php unset($__attributesOriginal6330f08526bbb3ce2a0da37da512a11f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6330f08526bbb3ce2a0da37da512a11f)): ?>
<?php $component = $__componentOriginal6330f08526bbb3ce2a0da37da512a11f; ?>
<?php unset($__componentOriginal6330f08526bbb3ce2a0da37da512a11f); ?>
<?php endif; ?>

        <!-- Tombol stop scan -->
        <?php if (isset($component)) { $__componentOriginal6330f08526bbb3ce2a0da37da512a11f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6330f08526bbb3ce2a0da37da512a11f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.button.index','data' => ['type' => 'button','color' => 'gray','xShow' => 'isScanning','xOn:click' => 'stopScan()','icon' => 'heroicon-o-x-circle']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'button','color' => 'gray','x-show' => 'isScanning','x-on:click' => 'stopScan()','icon' => 'heroicon-o-x-circle']); ?>
            Stop Scan
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6330f08526bbb3ce2a0da37da512a11f)): ?>
<?php $attributes = $__attributesOriginal6330f08526bbb3ce2a0da37da512a11f; ?>
<?php unset($__attributesOriginal6330f08526bbb3ce2a0da37da512a11f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6330f08526bbb3ce2a0da37da512a11f)): ?>
<?php $component = $__componentOriginal6330f08526bbb3ce2a0da37da512a11f; ?>
<?php unset($__componentOriginal6330f08526bbb3ce2a0da37da512a11f); ?>
<?php endif; ?>
    </div>

    
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
<?php /**PATH /home/cyrene/Documents/sistemkegiatanposyanduv2/resources/views/filament/forms/components/balita-qr-scanner.blade.php ENDPATH**/ ?>