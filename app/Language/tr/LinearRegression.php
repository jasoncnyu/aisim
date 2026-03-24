<?php

return [
    'title' => 'Doğrusal Regresyon Görselleştirme',
    'subtitle' => 'OLS, GD ve SGD için etkileşimli simülasyon.',
    'accordion' => [
        '1' => [
            'title' => '1) Doğrusal Regresyon Ne Çözer',
            'p1' => 'Doğrusal regresyon, giriş x ile çıkış y arasındaki doğrusal ilişkiyi tahmin eder.',
            'equation' => 'y = ax + b',
            'p2' => 'Burada a eğim, b kesişimdir. Bu simülatörde eklediğin her nokta bir eğitim örneğidir ve model en iyi a ve b’yi bulur.',
        ],
        '2' => [
            'title' => '2) Hata Fonksiyonu ve MSE Neden Kullanılır',
            'p1' => 'Model ortalama karesel hatayı (MSE) minimize eder:',
            'equation' => '$$ MSE(a,b) = \\frac{1}{n}\\sum_{i=1}^{n}(y_i-(ax_i+b))^2 $$',
            'p2' => 'Kare almak büyük hataları daha çok cezalandırır ve pürüzsüz bir optimizasyon hedefi sağlar. Daha düşük loss daha iyi uyum demektir.',
        ],
        '3' => [
            'title' => '3) OLS vs GD vs SGD',
            'ols' => 'Kapalı formül, tek sefer.',
            'gd' => 'Her epoch’ta tüm örnekleri kullanır, kararlı ama ağır.',
            'sgd' => 'Karıştırılmış tek örnek güncellemeleri, hızlı ama daha gürültülü.',
            'p1' => 'Aynı noktaları kullan ve yöntemlerin öğrenme eğrilerini karşılaştır.',
        ],
        '4' => [
            'title' => '4) Önerilen Öğrenme Akışı',
            'step1' => 'Noktaları ekle veya demo verisi yükle.',
            'step2' => 'Önce OLS çalıştırıp temel çizgiyi al.',
            'step3' => 'GD/SGD’ye geçip learning rate ve epoch’u ayarla.',
            'step4' => 'Test Mode ile gerçek ve tahmin değerlerini karşılaştır.',
        ],
    ],
    'controls' => [
        'add_point' => 'Nokta Ekle',
        'clear_points' => 'Noktaları Temizle',
        'load_demo' => 'Demo Verisi Yükle',
        'hint' => 'Nokta eklemek için tıkla. Bir noktayı kaldırmak için uzun bas.',
        'method' => 'Regresyon Yöntemi',
        'method_ols' => 'OLS',
        'method_gd' => 'Batch Gradient Descent',
        'method_sgd' => 'Stochastic Gradient Descent',
        'learning_rate' => 'Learning Rate',
        'epochs' => 'Epochs',
        'step_train' => 'Adım Adım Eğit',
        'auto_train' => 'Otomatik Eğit',
        'test_mode' => 'Test Mode',
    ],
    'loss_title' => 'Loss (MSE)',
    'model' => [
        'title' => 'Model',
        'points' => 'Noktalar:',
        'slope' => 'Eğim (a):',
        'intercept' => 'Kesişim (b):',
        'r2' => 'R2:',
        'last_loss' => 'Son Loss:',
    ],
    'notes' => [
        'title' => 'Yöntem Notları',
        'ols' => [
            'title' => 'OLS',
            'desc' => 'Kovaryans ve varyanstan kapalı form çözüm:',
            'formula' => '$$ a = \\frac{\\sum (x_i-\\bar{x})(y_i-\\bar{y})}{\\sum (x_i-\\bar{x})^2}, \\quad b = \\bar{y} - a\\bar{x} $$',
        ],
        'gd' => [
            'title' => 'Batch GD',
            'desc' => 'Tüm veri üzerinde gradyanlarla güncelleme:',
            'formula' => '$$ a \\leftarrow a - \\eta \\frac{\\partial MSE}{\\partial a}, \\quad b \\leftarrow b - \\eta \\frac{\\partial MSE}{\\partial b} $$',
        ],
        'sgd' => [
            'title' => 'SGD',
            'desc' => 'Karıştırılmış noktalarla örnek bazlı güncelleme:',
            'formula' => '$$ a \\leftarrow a - \\eta \\cdot 2(ax_j+b-y_j)x_j, \\quad b \\leftarrow b - \\eta \\cdot 2(ax_j+b-y_j) $$',
        ],
    ],
];
