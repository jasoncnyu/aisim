<?php

return [
    'pageTitle' => 'Beranda',
    'tagline' => 'AI Simulator',
    'title' => 'Laboratorium Visual untuk Belajar AI',
    'description' => 'AI Simulator mengubah matematika abstrak menjadi eksperimen interaktif. Bangun intuisi dengan melatih model secara real-time, menonton kurva rugi bergerak, dan melihat bagaimana keputusan berubah saat Anda menyesuaikan parameter.',
    'labels' => [
        'interactive_labs' => 'Laboratorium Interaktif',
        'live_training' => 'Pelatihan Langsung',
        'explainable_visuals' => 'Visual yang Dapat Dijelaskan',
        'guided_experiments' => 'Eksperimen Terpandu',
    ],
    'cta' => [
        'start_learning' => 'Mulai Belajar',
        'try_cnn_mnist' => 'Coba CNN MNIST',
    ],
    
    // How to Use Section
    'howToUse' => [
        'title' => 'Cara Menggunakan Platform Ini',
        'subtitle' => 'Jalur pendek dari keingintahuan menuju intuisi yang percaya diri.',
        'steps' => [
            [
                'number' => '1',
                'label' => 'Langkah',
                'title' => 'Pilih laboratorium',
                'description' => 'Pilih laboratorium dan baca awal konsep di bagian atas. Ini memberitahu Anda apa yang coba dipelajari model.',
            ],
            [
                'number' => '2',
                'label' => 'Langkah',
                'title' => 'Buat data',
                'description' => 'Buat data dengan mengklik, memuat demo, atau menggunakan gambar sampel. Bentuk data mendorong segalanya.',
            ],
            [
                'number' => '3',
                'label' => 'Langkah',
                'title' => 'Latih dan amati',
                'description' => 'Latih dan amati dengan langkah atau jalankan otomatis, lalu tonton kurva rugi dan perilaku model berkembang.',
            ],
            [
                'number' => '4',
                'label' => 'Langkah',
                'title' => 'Bandingkan dan refleksikan',
                'description' => 'Bandingkan dan refleksikan dengan mengubah hyperparameter atau tipe model untuk melihat bias, varians, dan overfitting.',
            ],
        ],
    ],
    
    // Learning Tracks Section
    'learningTracks' => [
        'title' => 'Trek Pembelajaran Inti',
        'machinelearning' => [
            'title' => 'Machine Learning',
            'description' => 'Mulai di sini untuk memahami bagaimana model belajar dari data. Anda akan melihat bagaimana kurva sederhana membengkok untuk menyesuaikan poin, bagaimana pengklasifikasi menggambar batas, dan mengapa kapasitas model penting. Trek ini tentang membangun intuisi untuk fungsi kerugian, gradien, dan geometri data.',
            'question' => 'Gunakan untuk menjawab: Mengapa model kurang pas atau pas berlebihan? Bagaimana distribusi data membentuk kembali batas keputusan?',
        ],
        'deeplearning' => [
            'title' => 'Deep Learning',
            'description' => 'Trek ini menskalakan intuisi dari kurva ke jaringan. Saksikan bagaimana neuron mengubah input menjadi representasi, lalu lihat bagaimana filter konvolusional mengekstrak fitur visual. Fokusnya adalah pada bagaimana kedalaman dan non-linearitas mengubah apa yang dapat diekspresikan model.',
            'question' => 'Gunakan untuk menjawab: Bagaimana CNN mempelajari tepi? Mengapa model neural pas berlebihan saat kerugian terus membaik?',
        ],
    ],
];
