<?php

return [
    'title' => 'XOR Sinir Ağı Lab',
    'subtitle' => 'Küçük bir MLP için ileri/geri geçiş görselleştirmesi.',
    'accordion' => [
        '1' => [
            'title' => '1) XOR Neden Klasik Bir Demo',
            'p1' => 'XOR tek bir doğrusal ayırıcıyla çözülemez. Modelin doğrusal olmayan bir karar yüzeyi öğrenmesi gerekir.',
            'p2' => 'Bu yüzden XOR, gizli katmanları ve doğrusal olmayan aktivasyonları göstermek için standart oyuncak problemdir.',
        ],
        '2' => [
            'title' => '2) Kullanılan Ağ Yapısı',
            'p1' => 'Simülatör kompakt bir MLP kullanır:',
            'structure' => 'Input(2) -> Hidden(4) -> Hidden(2) -> Output(1)',
            'p2' => 'Çıkış aktivasyonu ikili olasılık için sigmoid; gizli aktivasyon tanh veya ReLU olabilir.',
        ],
        '3' => [
            'title' => '3) Eğitim Dinamikleri',
            'p1' => 'Her adım bir XOR vakası örnekler, forward çalıştırır, loss hesaplar ve backprop güncellemesi uygular.',
            'equation1' => '$$ z^{(l)} = a^{(l-1)}W^{(l)} + b^{(l)}, \\quad a^{(l)} = f(z^{(l)}) $$',
            'equation2' => '$$ W \\leftarrow W - \\eta \\nabla_W L, \\quad b \\leftarrow b - \\eta \\nabla_b L $$',
        ],
        '4' => [
            'title' => '4) Görselleri Nasıl Okuruz',
            'li1' => 'Loss grafiği eğitim adımlarında yakınsama trendini gösterir.',
            'li2' => 'Tahmin paneli dört XOR girdisi için çıktı güvenini gösterir.',
            'li3' => 'Hesaplama paneli en yeni forward/backward değerlerini kaydeder.',
        ],
    ],
    'controls' => [
        'title' => 'Eğitim Kontrolleri',
        'learning_rate' => 'Learning Rate',
        'sleep' => 'Bekleme (ms)',
        'activation' => 'Aktivasyon',
        'step' => '+1 Adım',
        'auto_train' => 'Otomatik Eğit',
        'reset' => 'Sıfırla',
        'step_label' => 'Adım:',
        'loss_label' => 'Loss:',
    ],
    'trace_title' => 'Forward/Backward İz',
    'prediction_title' => 'Tahmin Anlık Görünüm',
    'prediction_hint' => 'Daha büyük daireler, sınıf 1’e yakın daha yüksek olasılık demektir.',
    'targets_title' => 'XOR Hedefleri',
    'targets' => [
        'li1' => '(0,0) -> 0',
        'li2' => '(0,1) -> 1',
        'li3' => '(1,0) -> 1',
        'li4' => '(1,1) -> 0',
    ],
];
