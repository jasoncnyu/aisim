<?php

return [
    'title' => 'Lab Quantization',
    'subtitle' => 'Kompres bobot ke format low-bit dan visualisasikan trade-off akurasi.',
    'accordion' => [
        '1' => [
            'title' => '1) Mengapa Quantization Penting',
            'p1' => 'Model modern besar dan berat. Quantization mengurangi bobot dari float32 ke bit lebih sedikit (8, 4, atau 1), mengecilkan model dan mempercepat inferensi.',
            'p2' => 'Trade-off utama adalah akurasi vs efisiensi. Dengan kalibrasi yang baik, model low-bit masih mempertahankan performa.',
        ],
        '2' => [
            'title' => '2) Mode Quantization',
            'li1_label' => 'Uniform Simetris',
            'li1' => 'skala di sekitar nol; sederhana dan ramah hardware.',
            'li2_label' => 'Uniform Asimetris',
            'li2' => 'menggeser rentang agar cocok untuk distribusi non-zero.',
            'li3_label' => 'Dynamic Range (per baris)',
            'li3' => 'skala terpisah per baris untuk fidelitas lebih baik.',
            'li4_label' => 'Log / Biner / Ternary',
            'li4' => 'kompresi agresif untuk efisiensi ekstrem, dengan distorsi lebih besar.',
        ],
        '3' => [
            'title' => '3) Cara Menggunakan Lab Ini',
            'step1' => 'Buat matriks acak atau atur densitas.',
            'step2' => 'Pilih mode quantization dan lebar bit.',
            'step3' => 'Terapkan quantization dan periksa MSE, PSNR, serta heatmap error.',
        ],
    ],
    'generator' => [
        'title' => 'Generator Matriks',
        'rows' => 'Baris',
        'cols' => 'Kolom',
        'density' => 'Densitas (% non-zero)',
        'current' => 'Saat ini:',
        'generate' => 'Buat',
    ],
    'settings' => [
        'title' => 'Pengaturan Quantization',
        'type' => 'Tipe quantization',
        'int8_sym' => 'Uniform Simetris (int8)',
        'uint8_asym' => 'Uniform Asimetris (uint8)',
        'row_dynamic' => 'Dynamic Range (per baris)',
        'log' => 'Log quantization',
        'binary' => 'Biner (tanda)',
        'ternary' => 'Ternary (-1, 0, +1)',
        'bit_width' => 'Lebar bit',
        'apply' => 'Terapkan quantization',
        'reset' => 'Reset',
    ],
    'summary' => [
        'title' => 'Ringkasan',
        'dimensions' => 'Dimensi:',
        'value_range' => 'Rentang nilai:',
        'quant_range' => 'Rentang quantized:',
        'mse' => 'MSE:',
        'psnr' => 'PSNR (dB):',
        'avg_error' => 'Rata-rata |error|:',
        'bitrate' => 'Bitrate:',
        'bits_per_value' => 'bit/nilai',
        'last_strategy' => 'Strategi terakhir:',
    ],
    'matrix' => [
        'title' => 'Matriks asli',
    ],
    'quantized' => [
        'title' => 'Matriks quantized (integer)',
    ],
    'dequantized' => [
        'title' => 'Matriks dequantized (float)',
    ],
    'error' => [
        'title' => 'Heatmap error (merah = positif, biru = negatif)',
    ],
    'json' => [
        'title' => 'Ekspor JSON',
        'download' => 'Unduh',
    ],
];
