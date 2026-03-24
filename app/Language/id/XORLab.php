<?php

return [
    'title' => 'Lab Jaringan Saraf XOR',
    'subtitle' => 'Visualisasi forward/backward pass untuk MLP kecil.',
    'accordion' => [
        '1' => [
            'title' => '1) Mengapa XOR Demo Klasik NN',
            'p1' => 'XOR tidak bisa diselesaikan dengan satu pemisah linear. Model harus belajar permukaan keputusan nonlinier.',
            'p2' => 'Karena itu XOR menjadi masalah mainan standar untuk menunjukkan hidden layer dan aktivasi nonlinier.',
        ],
        '2' => [
            'title' => '2) Struktur Jaringan yang Dipakai',
            'p1' => 'Simulator menggunakan MLP kompak:',
            'structure' => 'Input(2) -> Hidden(4) -> Hidden(2) -> Output(1)',
            'p2' => 'Aktivasi output adalah sigmoid untuk probabilitas biner. Aktivasi hidden bisa tanh atau ReLU.',
        ],
        '3' => [
            'title' => '3) Dinamika Training',
            'p1' => 'Setiap langkah mengambil satu kasus XOR, melakukan forward pass, menghitung loss, lalu menerapkan update backprop.',
            'equation1' => '$$ z^{(l)} = a^{(l-1)}W^{(l)} + b^{(l)}, \\quad a^{(l)} = f(z^{(l)}) $$',
            'equation2' => '$$ W \\leftarrow W - \\eta \\nabla_W L, \\quad b \\leftarrow b - \\eta \\nabla_b L $$',
        ],
        '4' => [
            'title' => '4) Cara Membaca Visual',
            'li1' => 'Grafik loss menunjukkan tren konvergensi sepanjang langkah training.',
            'li2' => 'Panel prediksi menampilkan kepercayaan output untuk keempat input XOR.',
            'li3' => 'Panel perhitungan mencatat nilai forward/backward terbaru untuk ditinjau.',
        ],
    ],
    'controls' => [
        'title' => 'Kontrol Training',
        'learning_rate' => 'Learning Rate',
        'sleep' => 'Jeda (ms)',
        'activation' => 'Aktivasi',
        'step' => '+1 Langkah',
        'auto_train' => 'Training Otomatis',
        'reset' => 'Reset',
        'step_label' => 'Langkah:',
        'loss_label' => 'Loss:',
    ],
    'trace_title' => 'Jejak Forward/Backward',
    'prediction_title' => 'Cuplikan Prediksi',
    'prediction_hint' => 'Lingkaran lebih besar menunjukkan probabilitas output lebih tinggi mendekati kelas 1.',
    'targets_title' => 'Target XOR',
    'targets' => [
        'li1' => '(0,0) -> 0',
        'li2' => '(0,1) -> 1',
        'li3' => '(1,0) -> 1',
        'li4' => '(1,1) -> 0',
    ],
];
