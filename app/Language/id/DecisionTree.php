<?php

return [
    'title' => 'Lab Visual Decision Tree',
    'subtitle' => 'Simulator interaktif pemisahan sejajar sumbu untuk klasifikasi biner.',
    'accordion' => [
        '1' => [
            'title' => '1) Cara Decision Tree Belajar',
            'p1' => 'Decision tree membagi data secara rekursif menjadi region lebih kecil. Di simulator ini, setiap split sejajar sumbu dan menggunakan x atau y dengan ambang.',
            'p2' => 'Setiap node internal menanyakan aturan seperti x <= 22. Leaf menampilkan probabilitas kelas dan label akhir.',
        ],
        '2' => [
            'title' => '2) Kualitas Split: Gini Impurity',
            'p1' => 'Untuk proporsi kelas p_k, Gini impurity adalah:',
            'equation' => '$$ G = 1 - \\sum_k p_k^2 $$',
            'p2' => 'Model mencoba split kandidat dan memilih yang meminimalkan impurity anak berbobot.',
        ],
        '3' => [
            'title' => '3) Kriteria Berhenti dan Generalisasi',
            'li1' => 'Kedalaman maksimum membatasi kompleksitas pohon.',
            'li2' => 'Jumlah sampel minimum menghindari micro-split yang tidak stabil.',
            'li3' => 'Leaf murni (satu kelas) berhenti secara alami.',
            'p1' => 'Pohon yang lebih dangkal biasanya lebih baik dalam generalisasi, sedangkan pohon dalam bisa overfit noise lokal.',
        ],
        '4' => [
            'title' => '4) Alur Kerja Disarankan',
            'step1' => 'Tambahkan titik untuk kelas A dan B, atau muat pola demo.',
            'step2' => 'Latih dengan pengaturan max depth / min samples berbeda.',
            'step3' => 'Amati batas region, aturan teks pohon, dan log split.',
            'step4' => 'Bandingkan pohon sederhana vs kompleks untuk interpretabilitas dan kualitas fit.',
        ],
    ],
    'controls' => [
        'class_a' => 'Kelas A',
        'class_b' => 'Kelas B',
        'train' => 'Latih',
        'clear' => 'Bersihkan',
        'demo' => [
            'random_clusters' => 'Cluster Campuran Acak',
            'concentric' => 'Konsentris (Pusat vs Cincin)',
            'xor' => 'Pola XOR',
            'overlap' => 'Cluster Tumpang Tindih',
        ],
        'load_demo' => 'Muat Demo',
        'max_depth' => 'Maks Kedalaman:',
        'min_samples' => 'Min Sampel:',
        'show_regions' => 'Tampilkan Region',
        'hint' => 'Klik kanvas untuk menambah sampel di sel grid, lalu latih untuk menghasilkan aturan dan region.',
    ],
    'model' => [
        'title' => 'Info Model',
        'points' => 'Titik:',
        'last_split' => 'Skor Split Terakhir:',
        'points_a' => 'Titik A',
        'points_b' => 'Titik B',
    ],
    'tree_title' => 'Decision Tree (Teks)',
    'calc_title' => 'Log Perhitungan Split',
];
