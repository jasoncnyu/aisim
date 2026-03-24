<?php

return [
    'title' => 'Lab Klasterisasi K-Means',
    'subtitle' => 'Simulator klasterisasi 2D interaktif dengan region Voronoi, update centroid, dan pelacakan inersia.',
    'accordion' => [
        '1' => [
            'title' => '1) Apa yang Dioptimalkan K-Means',
            'p1' => 'K-Means membagi data menjadi K klaster dengan meminimalkan jarak kuadrat dalam klaster (inersia).',
            'equation' => '$$ J = \\sum_{i=1}^{N} \\min_{1 \\leq j \\leq K} \\left\\lVert x_i - \\mu_j \\right\\rVert^2 $$',
            'p2' => 'Setiap sampel ditugaskan ke centroid terdekat, lalu centroid dihitung ulang sebagai rata-rata sampel yang ditugaskan.',
        ],
        '2' => [
            'title' => '2) Iterasi Lloyd (Assign lalu Update)',
            'p1' => 'Algoritma bergantian di antara dua langkah deterministik:',
            'equation1' => '$$ c_i \\leftarrow \\arg\\min_j \\lVert x_i - \\mu_j \\rVert^2 $$',
            'equation2' => '$$ \\mu_j \\leftarrow \\frac{1}{|C_j|}\\sum_{x_i \\in C_j} x_i $$',
            'p2' => 'Inersia menurun secara monoton hingga konvergen ke optimum lokal.',
        ],
        '3' => [
            'title' => '3) Mengapa Inisialisasi Penting',
            'p1' => 'Inisialisasi acak itu sederhana, tetapi bisa mulai dari seed yang buruk.',
            'p2' => 'k-means++ menyebarkan centroid awal dan sering memberi konvergensi lebih cepat serta inersia akhir lebih rendah.',
            'p3' => 'Di produksi, gunakan beberapa run dengan seed berbeda untuk mengurangi sensitivitas terhadap minimum lokal.',
        ],
        '4' => [
            'title' => '4) Alur Eksperimen Disarankan',
            'step1' => 'Muat titik demo lalu bandingkan inisialisasi Acak vs k-means++.',
            'step2' => 'Coba berbagai nilai K dan periksa batas region serta jumlah klaster.',
            'step3' => 'Gunakan Langkah untuk melihat satu siklus assign/update.',
            'step4' => 'Jalankan hingga konvergen dan bandingkan inersia akhir antar setelan.',
        ],
    ],
    'controls' => [
        'k_label' => 'K:',
        'init_label' => 'Init:',
        'init_random' => 'Acak',
        'init_plus' => 'k-means++',
        'region_density' => 'Kepadatan Region:',
        'load_demo' => 'Muat Demo',
        'init_centroids' => 'Inisialisasi Centroid',
        'step' => 'Langkah',
        'run' => 'Jalankan',
        'stop' => 'Hentikan',
        'clear' => 'Bersihkan',
        'hint' => 'Klik di mana saja pada kanvas untuk menambah titik. Tekan lama di perangkat sentuh atau klik kanan untuk menghapus titik terdekat.',
    ],
    'status' => [
        'title' => 'Status',
        'points' => 'Titik:',
        'k' => 'K:',
        'iteration' => 'Iterasi:',
        'inertia' => 'Inersia:',
        'shift' => 'Pergeseran Centroid:',
    ],
    'inertia_title' => 'Kurva Inersia',
    'summary_title' => 'Ringkasan Klaster',
];
