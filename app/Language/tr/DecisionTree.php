<?php

return [
    'title' => 'Karar Ağacı Görsel Lab',
    'subtitle' => 'İkili sınıflandırma için eksen hizalı bölme simülatörü.',
    'accordion' => [
        '1' => [
            'title' => '1) Karar Ağacı Nasıl Öğrenir',
            'p1' => 'Karar ağacı veriyi daha küçük bölgelere özyinelemeli olarak böler. Bu simülatörde her bölme x veya y ekseninde bir eşik kullanır.',
            'p2' => 'Her iç düğüm x <= 22 gibi bir kural sorar. Yaprak düğümler sınıf olasılığı ve nihai etiketi verir.',
        ],
        '2' => [
            'title' => '2) Bölme Kalitesi: Gini Safsızlığı',
            'p1' => 'Sınıf oranları p_k için Gini safsızlığı:',
            'equation' => '$$ G = 1 - \\sum_k p_k^2 $$',
            'p2' => 'Model aday bölmeleri dener ve ağırlıklı çocuk safsızlığını en aza indireni seçer.',
        ],
        '3' => [
            'title' => '3) Durdurma Kriterleri ve Genelleme',
            'li1' => 'Maksimum derinlik ağaç karmaşıklığını sınırlar.',
            'li2' => 'Minimum örnek sayısı kararsız mikro bölmeleri önler.',
            'li3' => 'Saf yapraklar (tek sınıf) doğal olarak durur.',
            'p1' => 'Daha sığ ağaçlar genelde daha iyi geneller; daha derin ağaçlar yerel gürültüye overfit olabilir.',
        ],
        '4' => [
            'title' => '4) Önerilen İş Akışı',
            'step1' => 'Sınıf A ve B için noktalar ekle veya demo desen yükle.',
            'step2' => 'Farklı max depth / min samples ayarlarıyla eğit.',
            'step3' => 'Bölge sınırlarını, metin kurallarını ve bölme günlüklerini gözlemle.',
            'step4' => 'Yorumlanabilirlik ve uyum için basit vs karmaşık ağaçları karşılaştır.',
        ],
    ],
    'controls' => [
        'class_a' => 'Sınıf A',
        'class_b' => 'Sınıf B',
        'train' => 'Eğit',
        'clear' => 'Temizle',
        'demo' => [
            'random_clusters' => 'Rastgele Karışık Kümeler',
            'concentric' => 'Eşmerkezli (Merkez vs Halka)',
            'xor' => 'XOR Deseni',
            'overlap' => 'Örtüşen Kümeler',
        ],
        'load_demo' => 'Demo Yükle',
        'max_depth' => 'Maks Derinlik:',
        'min_samples' => 'Min Örnek:',
        'show_regions' => 'Bölgeleri Göster',
        'hint' => 'Tuvale tıklayarak hücrelere örnek ekle, sonra bölme kuralları ve karar bölgeleri için eğit.',
    ],
    'model' => [
        'title' => 'Model Bilgisi',
        'points' => 'Noktalar:',
        'last_split' => 'Son Bölme Skoru:',
        'points_a' => 'A Noktaları',
        'points_b' => 'B Noktaları',
    ],
    'tree_title' => 'Karar Ağacı (Metin)',
    'calc_title' => 'Bölme Hesabı Günlüğü',
];
