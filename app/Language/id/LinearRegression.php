<?php

return [
    'title' => 'Visualisasi Regresi Linear',
    'subtitle' => 'Simulasi interaktif untuk OLS, GD, dan SGD.',
    'accordion' => [
        '1' => [
            'title' => '1) Apa yang diselesaikan regresi linear',
            'p1' => 'Regresi linear memperkirakan hubungan garis lurus antara masukan x dan keluaran y.',
            'equation' => 'y = ax + b',
            'p2' => 'Di sini, a adalah kemiringan dan b adalah intersep. Dalam simulator ini, setiap titik yang Anda tambahkan adalah sampel pelatihan dan model menemukan a dan b terbaik.',
        ],
        '2' => [
            'title' => '2) Fungsi error dan mengapa MSE digunakan',
            'p1' => 'Model meminimalkan mean squared error (MSE):',
            'equation' => '$$ MSE(a,b) = \\frac{1}{n}\\sum_{i=1}^{n}(y_i-(ax_i+b))^2 $$',
            'p2' => 'Pengkuadratan menghukum kesalahan besar lebih kuat dan memberi target optimisasi yang halus. Loss yang lebih rendah berarti kecocokan lebih baik.',
        ],
        '3' => [
            'title' => '3) OLS vs GD vs SGD',
            'ols' => 'Solusi bentuk tertutup dan sekali jalan.',
            'gd' => 'Memakai semua sampel per epoch, stabil namun lebih berat.',
            'sgd' => 'Pembaruan satu-sampel yang diacak, lebih cepat namun lebih bising.',
            'p1' => 'Gunakan titik yang sama dan bandingkan kurva pembelajaran tiap metode.',
        ],
        '4' => [
            'title' => '4) Alur belajar yang disarankan',
            'step1' => 'Tambahkan titik atau muat data demo.',
            'step2' => 'Jalankan OLS terlebih dahulu untuk mendapatkan garis dasar.',
            'step3' => 'Beralih ke GD/SGD dan sesuaikan laju belajar serta epoch.',
            'step4' => 'Gunakan Mode uji untuk memeriksa nilai aktual vs prediksi.',
        ],
    ],
    'controls' => [
        'add_point' => 'Tambah titik',
        'clear_points' => 'Hapus titik',
        'load_demo' => 'Muat data demo',
        'hint' => 'Klik untuk menambah titik. Tekan lama pada titik untuk menghapusnya.',
        'method' => 'Metode regresi',
        'method_ols' => 'OLS',
        'method_gd' => 'Gradient Descent batch',
        'method_sgd' => 'Gradient Descent stokastik',
        'learning_rate' => 'Laju belajar',
        'epochs' => 'Epoch',
        'step_train' => 'Latih per langkah',
        'auto_train' => 'Latih otomatis',
        'test_mode' => 'Mode uji',
    ],
    'loss_title' => 'Loss (MSE)',
    'model' => [
        'title' => 'Model',
        'points' => 'Titik:',
        'slope' => 'Kemiringan (a):',
        'intercept' => 'Intersep (b):',
        'r2' => 'R2:',
        'last_loss' => 'Loss terakhir:',
    ],
    'notes' => [
        'title' => 'Catatan metode',
        'ols' => [
            'title' => 'OLS',
            'desc' => 'Solusi bentuk tertutup dari kovariansi dan variansi:',
            'formula' => '$$ a = \\frac{\\sum (x_i-\\bar{x})(y_i-\\bar{y})}{\\sum (x_i-\\bar{x})^2}, \\quad b = \\bar{y} - a\\bar{x} $$',
        ],
        'gd' => [
            'title' => 'Batch GD',
            'desc' => 'Pembaruan menggunakan gradien pada seluruh dataset:',
            'formula' => '$$ a \\leftarrow a - \\eta \\frac{\\partial MSE}{\\partial a}, \\quad b \\leftarrow b - \\eta \\frac{\\partial MSE}{\\partial b} $$',
        ],
        'sgd' => [
            'title' => 'SGD',
            'desc' => 'Pembaruan per-sampel dengan titik yang diacak:',
            'formula' => '$$ a \\leftarrow a - \\eta \\cdot 2(ax_j+b-y_j)x_j, \\quad b \\leftarrow b - \\eta \\cdot 2(ax_j+b-y_j) $$',
        ],
    ],
];
