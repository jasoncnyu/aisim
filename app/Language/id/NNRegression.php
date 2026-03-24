<?php

return [
    'title' => 'Lab Regresi Neural Nonlinier',
    'subtitle' => 'Fit kurva nonlinier dengan perceptron multilapis, lalu amati perbedaan train/validasi saat overtraining.',
    'accordion' => [
        '1' => [
            'title' => '1) Formulasi Model',
            'p1' => 'Berbeda dengan regresi linear y=ax+b, lab ini memakai hidden layer untuk mempelajari pemetaan nonlinier x → y.',
            'equation' => '$$\\hat{y}=W_L\\,\\phi(W_{L-1}\\phi(\\cdots\\phi(W_1x+b_1)\\cdots)+b_{L-1})+b_L$$',
            'p2' => 'Pilih kedalaman, lebar, dan aktivasi untuk mengatur kapasitas model.',
        ],
        '2' => [
            'title' => '2) Loss dan Sinyal Overfitting',
            'p1' => 'Tujuan utamanya adalah mean squared error pada subset training:',
            'equation' => '$$\\text{MSE}=\\frac{1}{n}\\sum_{i=1}^{n}(y_i-\\hat{y}_i)^2$$',
            'p2' => 'Overfitting muncul ketika loss training terus turun sementara loss validasi mendatar atau naik.',
        ],
    ],
    'controls' => [
        'add_point' => 'Tambah Titik',
        'test_mode' => 'Mode Uji',
        'clear' => 'Bersihkan',
        'demo' => [
            'sine' => 'Kurva Sinus',
            'cubic' => 'Kurva Kubik',
            'piecewise' => 'Kurva Piecewise',
        ],
        'load_demo' => 'Muat Demo',
        'hint' => 'Klik untuk menambah sampel. Di Mode Uji, klik posisi x untuk melihat y prediksi dan residual.',
    ],
    'params' => [
        'hidden_layers' => 'Hidden Layer',
        'units_per_layer' => 'Unit / Layer',
        'activation' => 'Aktivasi',
        'val_ratio' => 'Rasio Validasi',
        'lr' => 'LR',
        'batch' => 'Batch',
        'epochs' => 'Epoch',
        'l2_reg' => 'Reg L2',
        'init_model' => 'Inisialisasi Model',
    ],
    'actions' => [
        'step' => 'Langkah',
        'run' => 'Jalankan',
        'stop' => 'Hentikan',
    ],
    'status' => [
        'title' => 'Status Training',
        'points' => 'Titik:',
        'train_val' => 'Train / Val:',
        'epoch' => 'Epoch:',
        'train_loss' => 'Loss Training:',
        'val_loss' => 'Loss Validasi:',
    ],
    'interpretation' => [
        'title' => 'Interpretasi',
        'li1' => 'Titik biru: subset training, titik oranye: subset validasi.',
        'li2' => 'Penanda kuning di Mode Uji: keluaran prediksi pada x yang diklik.',
        'li3' => 'Jika loss training turun tetapi loss validasi naik, kapasitas terlalu tinggi atau training terlalu lama.',
        'li4' => 'Coba regulasi L2 lebih kuat atau hidden layer lebih kecil untuk mengurangi overfitting.',
    ],
];
