<?php

return [
    'title' => 'Doğrusal Olmayan Sinirsel Regresyon Lab',
    'subtitle' => 'Çok katmanlı algılayıcı ile doğrusal olmayan eğrileri uydur ve aşırı eğitimde train/validation ayrışmasını gözlemle.',
    'accordion' => [
        '1' => [
            'title' => '1) Model Formülasyonu',
            'p1' => 'Doğrusal regresyon y=ax+b’den farklı olarak bu lab, doğrusal olmayan eşlemeler öğrenmek için gizli katmanlar kullanır x → y.',
            'equation' => '$$\\hat{y}=W_L\\,\\phi(W_{L-1}\\phi(\\cdots\\phi(W_1x+b_1)\\cdots)+b_{L-1})+b_L$$',
            'p2' => 'Derinlik, genişlik ve aktivasyon seçerek model kapasitesini kontrol et.',
        ],
        '2' => [
            'title' => '2) Loss ve Overfitting Sinyali',
            'p1' => 'Amaç, eğitim alt kümesinde ortalama karesel hatadır:',
            'equation' => '$$\\text{MSE}=\\frac{1}{n}\\sum_{i=1}^{n}(y_i-\\hat{y}_i)^2$$',
            'p2' => 'Train loss düşerken validation loss düzleşir veya yükselirse overfitting oluşur.',
        ],
    ],
    'controls' => [
        'add_point' => 'Nokta Ekle',
        'test_mode' => 'Test Mode',
        'clear' => 'Temizle',
        'demo' => [
            'sine' => 'Sinüs Eğrisi',
            'cubic' => 'Kübik Eğri',
            'piecewise' => 'Parçalı Eğri',
        ],
        'load_demo' => 'Demo Yükle',
        'hint' => 'Örnek eklemek için tıkla. Test Mode’da x konumuna tıklayarak tahmin y ve artık değerini incele.',
    ],
    'params' => [
        'hidden_layers' => 'Gizli Katmanlar',
        'units_per_layer' => 'Birim / Katman',
        'activation' => 'Aktivasyon',
        'val_ratio' => 'Validation Oranı',
        'lr' => 'LR',
        'batch' => 'Batch',
        'epochs' => 'Epochs',
        'l2_reg' => 'L2 Reg',
        'init_model' => 'Modeli Başlat',
    ],
    'actions' => [
        'step' => 'Adım',
        'run' => 'Çalıştır',
        'stop' => 'Durdur',
    ],
    'status' => [
        'title' => 'Eğitim Durumu',
        'points' => 'Noktalar:',
        'train_val' => 'Train / Val:',
        'epoch' => 'Epoch:',
        'train_loss' => 'Train Loss:',
        'val_loss' => 'Val Loss:',
    ],
    'interpretation' => [
        'title' => 'Yorumlama',
        'li1' => 'Mavi noktalar: eğitim alt kümesi, turuncu noktalar: doğrulama alt kümesi.',
        'li2' => 'Test Mode’daki sarı işaret: tıklanan x’te tahmin çıktı.',
        'li3' => 'Train loss düşüp val loss yükselirse kapasite çok yüksek ya da eğitim çok uzundur.',
        'li4' => 'Overfitting’i azaltmak için daha güçlü L2 regularization veya daha küçük gizli katmanlar dene.',
    ],
];
