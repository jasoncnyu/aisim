<?php

return [
    'title' => 'Lab visual regresi logistik',
    'subtitle' => 'Simulasi klasifikasi biner dengan pembelajaran batas sigmoid.',
    'accordion' => [
        '1' => [
            'title' => '1) Apa yang dilakukan regresi logistik',
            'p1' => 'Regresi logistik memprediksi probabilitas keanggotaan kelas untuk target biner.',
            'equation' => '$$ \\hat{y} = \\sigma(z), \\quad z = mx + b, \\quad \\sigma(z)=\\frac{1}{1+e^{-z}} $$',
            'p2' => 'Model menghasilkan nilai antara 0 dan 1. Ambang seperti 0.5 mengubah probabilitas menjadi label kelas.',
        ],
        '2' => [
            'title' => '2) Fungsi objektif (cross-entropy biner)',
            'p1' => 'Tujuan pelatihan meminimalkan log-likelihood negatif:',
            'equation' => '$$ L(m,b)=-\\frac{1}{n}\\sum_{i=1}^{n}\\left[y_i\\log(\\hat{y_i})+(1-y_i)\\log(1-\\hat{y_i})\\right] $$',
            'p2' => 'Loss ini menghukum prediksi salah yang sangat yakin, sehingga meningkatkan kalibrasi probabilitas.',
        ],
        '3' => [
            'title' => '3) Pembaruan gradien',
            'p1' => 'Untuk regresi logistik satu fitur, gradien batch adalah:',
            'equation1' => '$$ \\frac{\\partial L}{\\partial m}=\\frac{1}{n}\\sum(\\hat{y_i}-y_i)x_i,\\quad \\frac{\\partial L}{\\partial b}=\\frac{1}{n}\\sum(\\hat{y_i}-y_i) $$',
            'equation2' => '$$ m \\leftarrow m-\\eta\\frac{\\partial L}{\\partial m},\\quad b \\leftarrow b-\\eta\\frac{\\partial L}{\\partial b} $$',
            'p2' => 'Laju belajar yang lebih rendah meningkatkan stabilitas, sedangkan laju yang lebih tinggi konvergen lebih cepat namun bisa berosilasi.',
        ],
        '4' => [
            'title' => '4) Alur kerja praktis',
            'step1' => 'Tambahkan titik kelas secara manual (pita bawah untuk kelas 0, pita atas untuk kelas 1) atau muat data acak.',
            'step2' => 'Latih dengan Latih otomatis dan pantau penurunan loss.',
            'step3' => 'Gunakan Langkah untuk memeriksa perilaku per iterasi.',
            'step4' => 'Aktifkan Mode uji dan klik untuk memeriksa probabilitas prediksi di posisi input mana pun.',
        ],
    ],
    'controls' => [
        'generate_data' => 'Buat data sampel',
        'auto_train' => 'Latih otomatis',
        'step' => 'Langkah',
        'test_mode' => 'Mode uji',
        'reset' => 'Atur ulang',
        'learning_rate' => 'LR:',
        'hint' => 'Klik kanvas untuk menambah titik. Titik dekat y=0 mewakili kelas 0 dan titik dekat y=1 mewakili kelas 1.',
    ],
    'loss_title' => 'Kurva loss',
    'interpretation' => [
        'title' => 'Panduan interpretasi',
        'li1' => 'Kurva S kuning adalah fungsi probabilitas yang dipelajari.',
        'li2' => 'Titik merah adalah kelas 1, titik sian adalah kelas 0.',
        'li3' => 'Zona transisi di tengah mendekati batas keputusan.',
        'li4' => 'Penurunan loss menunjukkan meningkatnya kepercayaan klasifikasi.',
    ],
];
