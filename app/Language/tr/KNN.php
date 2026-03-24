<?php

return [
    'title' => 'K-En Yakın Komşu Lab',
    'subtitle' => 'Etkileşimli karar bölgeleri, komşu inceleme ve ağırlıklı oylama ile örnek tabanlı sınıflandırma.',
    'accordion' => [
        '1' => [
            'title' => '1) K-NN’in Temel Fikri',
            'p1' => 'K-NN küresel model parametreleri öğrenmez. Özellik uzayındaki yakın eğitim noktalarının etiketleriyle tahmin yapar.',
            'p2' => 'Sorgu noktası x için en yakın K örnek seçilir ve etiketler çoğunluk oyu (veya ağırlıklı oy) ile birleştirilir.',
            'equation' => '$$\\hat{y}(x)=\\arg\\max_c \\sum_{i\\in \\mathcal{N}_K(x)} w_i\\,\\mathbf{1}(y_i=c)$$',
        ],
        '2' => [
            'title' => '2) K ve Mesafe Ağırlığının Etkisi',
            'li1' => 'K küçük: sınır esnek ama yerel gürültüye duyarlı.',
            'li2' => 'K büyük: sınır daha pürüzsüz, varyans düşük, bias artabilir.',
            'li3' => 'Ağırlıklı oylama (w=1/d) çok yakın komşulara daha fazla etki verir.',
        ],
        '3' => [
            'title' => '3) Pratik Notlar',
            'p1' => 'K-NN mesafeye dayandığı için özellik ölçekleme kritik önem taşır. Standartlaştırma genelde güvenilirliği artırır.',
            'p2' => 'Tahmin maliyeti veri büyüdükçe artar; çünkü çıkarımda birçok örnekle mesafe hesaplanır.',
            'p3' => 'K değerini doğrulama ile seç ve gürültülü/örtüşen dağılımlarda sağlamlığı değerlendir.',
        ],
        '4' => [
            'title' => '4) Önerilen İş Akışı',
            'step1' => 'Demo dağılımı yükle (dikey, XOR, eşmerkezli, örtüşen, rastgele).',
            'step2' => 'K’yı ayarla ve ağırlıklı oylamayı aç/kapatıp sınırları karşılaştır.',
            'step3' => 'Test Mode’u aç ve tıklayarak en yakın komşuları ve sınıf olasılığını incele.',
            'step4' => 'Daha ince sınır için bölge yoğunluğunu artır, sonra hızlı çizim için düşür.',
        ],
    ],
    'controls' => [
        'class_a' => 'Sınıf A',
        'class_b' => 'Sınıf B',
        'test_mode' => 'Test Mode',
        'k_label' => 'K:',
        'weighted' => 'Ağırlıklı (1/d)',
        'region_density' => 'Bölge Yoğunluğu:',
        'demo' => [
            'vertical' => 'Dikey Karışık',
            'xor' => 'XOR (4 Küme)',
            'concentric' => 'Eşmerkezli (Merkez vs Halka)',
            'overlap' => 'Örtüşen (Zor)',
            'random' => 'Rastgele Kümeler',
        ],
        'load_demo' => 'Demo Yükle',
        'refresh' => 'Yenile',
        'clear' => 'Temizle',
        'hint' => 'Eğitim örnekleri eklemek için tıkla. Test Mode’da tıklayarak sorgu noktasını sınıflandır ve en yakın komşuları incele.',
    ],
    'model' => [
        'title' => 'Model Bilgisi',
        'points' => 'Noktalar:',
        'last_prob' => 'Son Test P(B):',
    ],
    'neighbors_title' => 'En Yakın Komşular',
];
