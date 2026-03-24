<?php

return [
    'title' => 'Lab CNN Biner',
    'subtitle' => 'CNN kecil untuk klasifikasi gambar dua kelas dengan visualisasi filter dan feature map.',
    'accordion' => [
        '1' => [
            'title' => '1) Arsitektur Model',
            'p1' => 'Halaman ini melatih CNN kompak: Conv(3x3) -> ReLU -> Flatten -> Dense -> ReLU -> Dense -> Softmax.',
            'p2' => 'Gambar input diubah ke grayscale dan diubah ukurannya menjadi 32x32, sehingga tiap sampel adalah vektor 1024 dimensi sebelum konvolusi.',
            'p3' => 'Label biner dipetakan ke probabilitas kelas: P(kelas 1) dan P(kelas 2).',
        ],
        '2' => [
            'title' => '2) Tujuan Pembelajaran',
            'p1' => 'Jaringan dioptimalkan dengan cross-entropy untuk dua kelas:',
            'equation' => '$$ L = -\\frac{1}{N}\\sum_{i=1}^{N}\\sum_{c=1}^{2} y_{ic}\\log(\\hat{y}_{ic}) $$',
            'p2' => 'Gunakan learning rate lebih kecil untuk konvergensi stabil atau lebih besar untuk update lebih cepat namun lebih berisik.',
        ],
        '3' => [
            'title' => '3) Alur Kerja Disarankan',
            'step1' => 'Muat gambar demo kucing/anjing atau unggah file kustom ke tiap kelas.',
            'step2' => 'Inisialisasi bobot, jalankan beberapa epoch, dan pantau loss serta akurasi.',
            'step3' => 'Periksa nilai filter dan feature map untuk memahami apa yang ditangkap layer conv pertama.',
            'step4' => 'Unggah gambar uji dan periksa probabilitas kelas.',
        ],
    ],
    'controls' => [
        'load_demo' => 'Muat Data Demo',
        'init_weights' => 'Inisialisasi Bobot',
        'step' => 'Langkah (1 Epoch)',
        'run' => 'Jalankan',
        'stop' => 'Hentikan',
        'reset' => 'Reset',
        'lr' => 'LR:',
        'epochs' => 'Epoch:',
        'batch' => 'Batch:',
    ],
    'metrics' => [
        'dataset' => 'Dataset:',
        'epoch' => 'Epoch:',
        'loss' => 'Loss:',
        'accuracy' => 'Akurasi:',
    ],
    'training_images_title' => 'Gambar Training',
    'class1_label' => 'Kelas 1 (label 0)',
    'class2_label' => 'Kelas 2 (label 1)',
    'upload_hint' => 'Gambar yang diunggah diubah ukurannya menjadi 32x32 grayscale sebelum training.',
    'loading_images' => 'Memuat gambar...',
    'conv_filters_title' => 'Filter Conv (Realtime)',
    'prediction_title' => 'Prediksi',
    'predict_button' => 'Prediksi Gambar yang Diunggah',
    'feature_maps_title' => 'Feature Map (Layer Conv)',
];
