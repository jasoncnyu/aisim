<?php

return [
    'title' => 'Lojistik Regresyon Görsel Lab',
    'subtitle' => 'Sigmoid sınır öğrenimiyle ikili sınıflandırma simülasyonu.',
    'accordion' => [
        '1' => [
            'title' => '1) Lojistik Regresyon Ne Yapar',
            'p1' => 'Lojistik regresyon, ikili hedefler için sınıf üyeliği olasılığını tahmin eder.',
            'equation' => '$$ \\hat{y} = \\sigma(z), \\quad z = mx + b, \\quad \\sigma(z)=\\frac{1}{1+e^{-z}} $$',
            'p2' => 'Model 0 ile 1 arasında değer üretir. 0.5 gibi bir eşik, olasılığı sınıf etiketine çevirir.',
        ],
        '2' => [
            'title' => '2) Amaç Fonksiyonu (Binary Cross-Entropy)',
            'p1' => 'Eğitim hedefi negatif log-olabilirliği minimize eder:',
            'equation' => '$$ L(m,b)=-\\frac{1}{n}\\sum_{i=1}^{n}\\left[y_i\\log(\\hat{y_i})+(1-y_i)\\log(1-\\hat{y_i})\\right] $$',
            'p2' => 'Bu loss, kendinden emin yanlış tahminleri ağır cezalandırır ve olasılık kalibrasyonunu iyileştirir.',
        ],
        '3' => [
            'title' => '3) Gradyan Güncellemeleri',
            'p1' => 'Tek özellikli lojistik regresyon için batch gradyanlar:',
            'equation1' => '$$ \\frac{\\partial L}{\\partial m}=\\frac{1}{n}\\sum(\\hat{y_i}-y_i)x_i,\\quad \\frac{\\partial L}{\\partial b}=\\frac{1}{n}\\sum(\\hat{y_i}-y_i) $$',
            'equation2' => '$$ m \\leftarrow m-\\eta\\frac{\\partial L}{\\partial m},\\quad b \\leftarrow b-\\eta\\frac{\\partial L}{\\partial b} $$',
            'p2' => 'Daha düşük learning rate daha kararlı; daha yüksek rate daha hızlı yakınsar ama salınım yapabilir.',
        ],
        '4' => [
            'title' => '4) Pratik İş Akışı',
            'step1' => 'Sınıf noktalarını elle ekle (alt bant sınıf 0, üst bant sınıf 1) veya rastgele veri yükle.',
            'step2' => 'Auto Train ile eğit ve loss düşüşünü izle.',
            'step3' => 'Step ile her iterasyondaki davranışı incele.',
            'step4' => 'Test Mode’u etkinleştirip herhangi bir girişte tahmin olasılığını incele.',
        ],
    ],
    'controls' => [
        'generate_data' => 'Örnek Veri Üret',
        'auto_train' => 'Otomatik Eğit',
        'step' => 'Adım',
        'test_mode' => 'Test Mode',
        'reset' => 'Sıfırla',
        'learning_rate' => 'LR:',
        'hint' => 'Nokta eklemek için tuvale tıkla. y=0 yakınındaki noktalar sınıf 0, y=1 yakınındaki noktalar sınıf 1’dir.',
    ],
    'loss_title' => 'Loss Eğrisi',
    'interpretation' => [
        'title' => 'Yorumlama Rehberi',
        'li1' => 'Sarı S-eğrisi öğrenilen olasılık fonksiyonudur.',
        'li2' => 'Kırmızı noktalar sınıf 1, camgöbeği noktalar sınıf 0’dır.',
        'li3' => 'Ortadaki geçiş bölgesi karar sınırını yaklaşıklar.',
        'li4' => 'Loss azalması sınıflandırma güveninin arttığını gösterir.',
    ],
];
