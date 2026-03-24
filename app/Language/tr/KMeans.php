<?php

return [
    'title' => 'K-Means Kümeleme Lab',
    'subtitle' => 'Voronoi bölgeleri, merkez güncellemeleri ve ataleti takip eden 2D kümeleme simülatörü.',
    'accordion' => [
        '1' => [
            'title' => '1) K-Means Ne Optimize Eder',
            'p1' => 'K-Means veriyi K kümeye ayırır ve küme içi karesel uzaklığı (inertia) minimize eder.',
            'equation' => '$$ J = \\sum_{i=1}^{N} \\min_{1 \\leq j \\leq K} \\left\\lVert x_i - \\mu_j \\right\\rVert^2 $$',
            'p2' => 'Her örnek en yakın merkeze atanır, sonra merkezler atanmış örneklerin ortalamasıyla güncellenir.',
        ],
        '2' => [
            'title' => '2) Lloyd İterasyonu (Ata sonra Güncelle)',
            'p1' => 'Algoritma iki deterministik adım arasında gidip gelir:',
            'equation1' => '$$ c_i \\leftarrow \\arg\\min_j \\lVert x_i - \\mu_j \\rVert^2 $$',
            'equation2' => '$$ \\mu_j \\leftarrow \\frac{1}{|C_j|}\\sum_{x_i \\in C_j} x_i $$',
            'p2' => 'Atalet, yerel optimuma kadar tekdüze azalır.',
        ],
        '3' => [
            'title' => '3) Başlatma Neden Önemli',
            'p1' => 'Rastgele başlatma basittir ama kötü tohumlarla başlayabilir.',
            'p2' => 'k-means++ başlangıç merkezlerini yayar; genelde daha hızlı yakınsama ve daha düşük son atalet verir.',
            'p3' => 'Üretimde yerel minimum hassasiyetini azaltmak için farklı tohumlarla çoklu koşu kullanın.',
        ],
        '4' => [
            'title' => '4) Önerilen Deney Akışı',
            'step1' => 'Demo noktaları yükle, ardından Random vs k-means++ başlatmayı karşılaştır.',
            'step2' => 'Farklı K değerlerini dene ve bölge sınırları ile küme sayısını incele.',
            'step3' => 'Step ile her seferinde bir ata/güncelle döngüsünü incele.',
            'step4' => 'Yakınsamaya kadar çalıştır ve son atalet değerlerini karşılaştır.',
        ],
    ],
    'controls' => [
        'k_label' => 'K:',
        'init_label' => 'Başlatma:',
        'init_random' => 'Rastgele',
        'init_plus' => 'k-means++',
        'region_density' => 'Bölge Yoğunluğu:',
        'load_demo' => 'Demo Yükle',
        'init_centroids' => 'Merkezleri Başlat',
        'step' => 'Adım',
        'run' => 'Çalıştır',
        'stop' => 'Durdur',
        'clear' => 'Temizle',
        'hint' => 'Tuvalde herhangi bir yere tıklayıp nokta ekleyin. Dokunmatik cihazlarda uzun basın veya sağ tıkla en yakın noktayı silin.',
    ],
    'status' => [
        'title' => 'Durum',
        'points' => 'Noktalar:',
        'k' => 'K:',
        'iteration' => 'İterasyon:',
        'inertia' => 'Atalet:',
        'shift' => 'Merkez Kayması:',
    ],
    'inertia_title' => 'Atalet Eğrisi',
    'summary_title' => 'Küme Özeti',
];
