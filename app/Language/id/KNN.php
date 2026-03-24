<?php

return [
    'title' => 'Lab K-Nearest Neighbors',
    'subtitle' => 'Klasifikasi berbasis instance dengan region keputusan interaktif, inspeksi tetangga, dan voting berbobot.',
    'accordion' => [
        '1' => [
            'title' => '1) Ide Inti K-NN',
            'p1' => 'K-NN tidak belajar parameter global model. Prediksi dilakukan dengan label titik training terdekat di ruang fitur.',
            'p2' => 'Untuk titik query x, pilih K sampel terdekat lalu gabungkan label dengan voting mayoritas (atau berbobot).',
            'equation' => '$$\\hat{y}(x)=\\arg\\max_c \\sum_{i\\in \\mathcal{N}_K(x)} w_i\\,\\mathbf{1}(y_i=c)$$',
        ],
        '2' => [
            'title' => '2) Efek K dan Bobot Jarak',
            'li1' => 'K kecil: batas sangat fleksibel, sensitif terhadap noise lokal.',
            'li2' => 'K besar: batas lebih halus, varians lebih rendah, bias bisa lebih tinggi.',
            'li3' => 'Voting berbobot (w=1/d) memberi pengaruh lebih besar ke tetangga yang sangat dekat.',
        ],
        '3' => [
            'title' => '3) Catatan Praktis',
            'p1' => 'Karena K-NN bergantung pada jarak, skala fitur sangat penting pada data nyata. Standardisasi biasanya meningkatkan reliabilitas.',
            'p2' => 'Biaya prediksi meningkat seiring ukuran dataset karena jarak harus dihitung terhadap banyak sampel saat inferensi.',
            'p3' => 'Gunakan validasi untuk memilih K dan menilai ketahanan terhadap noise atau distribusi kelas yang saling tumpang tindih.',
        ],
        '4' => [
            'title' => '4) Alur Kerja Disarankan',
            'step1' => 'Muat distribusi demo (vertikal, XOR, konsentris, overlap, acak).',
            'step2' => 'Sesuaikan K dan toggle voting berbobot untuk membandingkan batas keputusan.',
            'step3' => 'Aktifkan Mode Uji dan klik untuk melihat tetangga terdekat serta probabilitas kelas.',
            'step4' => 'Naikkan kepadatan region untuk detail yang lebih halus, lalu turunkan untuk render lebih cepat.',
        ],
    ],
    'controls' => [
        'class_a' => 'Kelas A',
        'class_b' => 'Kelas B',
        'test_mode' => 'Mode Uji',
        'k_label' => 'K:',
        'weighted' => 'Berbobot (1/d)',
        'region_density' => 'Kepadatan Region:',
        'demo' => [
            'vertical' => 'Vertikal Campur',
            'xor' => 'XOR (4 Cluster)',
            'concentric' => 'Konsentris (Pusat vs Cincin)',
            'overlap' => 'Tumpang Tindih (Sulit)',
            'random' => 'Cluster Acak',
        ],
        'load_demo' => 'Muat Demo',
        'refresh' => 'Segarkan',
        'clear' => 'Bersihkan',
        'hint' => 'Klik untuk menambah sampel training. Di Mode Uji, klik untuk mengklasifikasikan titik dan memeriksa tetangganya.',
    ],
    'model' => [
        'title' => 'Info Model',
        'points' => 'Titik:',
        'last_prob' => 'Tes Terakhir P(B):',
    ],
    'neighbors_title' => 'Tetangga Terdekat',
];
