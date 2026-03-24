<?php

return [
    'title' => 'Quantization Lab',
    'subtitle' => 'Ağırlıkları düşük bit formatlarına sıkıştır ve doğruluk/performans ödünlerini görselleştir.',
    'accordion' => [
        '1' => [
            'title' => '1) Quantization Neden Önemli',
            'p1' => 'Modern modeller büyük ve bellek açısından ağırdır. Quantization, her ağırlığı 32-bit float’tan daha az bite (genelde 8, 4 veya 1) indirerek modeli küçültür ve çıkarımı hızlandırır.',
            'p2' => 'Temel ödün, doğruluk ile verimlilik arasındadır. İyi kalibrasyonla düşük bitli modeller performansın çoğunu korurken donanımda daha hızlı çalışabilir.',
        ],
        '2' => [
            'title' => '2) Quantization Modları',
            'li1_label' => 'Uniform Symmetric',
            'li1' => 'ağırlıkları 0 etrafında ölçekler; basit ve donanım dostu.',
            'li2_label' => 'Uniform Asymmetric',
            'li2' => 'sıfırdan kaydırarak sıfır olmayan dağılımlara daha iyi uyar.',
            'li3_label' => 'Dynamic Range (satır başına)',
            'li3' => 'her satır için ayrı ölçek kullanır, heterojen matrislerde doğruluğu artırır.',
            'li4_label' => 'Log / Binary / Ternary',
            'li4' => 'aşırı verim için agresif sıkıştırma, fakat daha fazla bozulma.',
        ],
        '3' => [
            'title' => '3) Nasıl Kullanılır',
            'step1' => 'Rastgele bir matris üret veya yoğunluğunu ayarla.',
            'step2' => 'Bir quantization modu ve bit genişliği seç.',
            'step3' => 'Uygula ve MSE, PSNR ve hata ısı haritasını incele.',
        ],
    ],
    'generator' => [
        'title' => 'Matris Üretici',
        'rows' => 'Satır',
        'cols' => 'Sütun',
        'density' => 'Yoğunluk (sıfır olmayan %)',
        'current' => 'Mevcut:',
        'generate' => 'Üret',
    ],
    'settings' => [
        'title' => 'Quantization Ayarları',
        'type' => 'Quantization Türü',
        'int8_sym' => 'Uniform Symmetric (int8)',
        'uint8_asym' => 'Uniform Asymmetric (uint8)',
        'row_dynamic' => 'Dynamic Range (satır başına)',
        'log' => 'Log Quantization',
        'binary' => 'Binary (işaret)',
        'ternary' => 'Ternary (-1, 0, +1)',
        'bit_width' => 'Bit Genişliği',
        'apply' => 'Quantization Uygula',
        'reset' => 'Sıfırla',
    ],
    'summary' => [
        'title' => 'Özet',
        'dimensions' => 'Boyutlar:',
        'value_range' => 'Değer Aralığı:',
        'quant_range' => 'Quant Aralığı:',
        'mse' => 'MSE:',
        'psnr' => 'PSNR (dB):',
        'avg_error' => 'Ort |Hata|:',
        'bitrate' => 'Bitrate:',
        'bits_per_value' => 'bit/değer',
        'last_strategy' => 'Son Strateji:',
    ],
    'matrix' => [
        'title' => 'Orijinal Matris',
    ],
    'quantized' => [
        'title' => 'Quantize Matris (tamsayı)',
    ],
    'dequantized' => [
        'title' => 'Dequantize Matris (float)',
    ],
    'error' => [
        'title' => 'Hata Isı Haritası (kırmızı=pozitif, mavi=negatif)',
    ],
    'json' => [
        'title' => 'JSON Dışa Aktar',
        'download' => 'İndir',
    ],
];
