<?php

return [
    'title' => 'CNN İkili Lab',
    'subtitle' => 'Filtre ve feature-map görselleştirmeli iki sınıflı görüntü sınıflandırma için küçük CNN.',
    'accordion' => [
        '1' => [
            'title' => '1) Model Mimarisi',
            'p1' => 'Bu sayfa kompakt bir CNN eğitir: Conv(3x3) -> ReLU -> Flatten -> Dense -> ReLU -> Dense -> Softmax.',
            'p2' => 'Girdi görselleri gri tonlamaya çevrilir ve 32x32’e yeniden boyutlanır; böylece her örnek konvolüsyon öncesi 1024 boyutlu vektördür.',
            'p3' => 'İkili etiketler sınıf olasılıklarına eşlenir: P(sınıf 1) ve P(sınıf 2).',
        ],
        '2' => [
            'title' => '2) Öğrenme Amacı',
            'p1' => 'Ağ iki sınıf üzerinde çapraz-entropi ile optimize edilir:',
            'equation' => '$$ L = -\\frac{1}{N}\\sum_{i=1}^{N}\\sum_{c=1}^{2} y_{ic}\\log(\\hat{y}_{ic}) $$',
            'p2' => 'Daha düşük learning rate daha kararlı; daha yüksek learning rate daha hızlı ama daha gürültülü güncellemeler sağlar.',
        ],
        '3' => [
            'title' => '3) Önerilen İş Akışı',
            'step1' => 'Demo kedi/köpek görsellerini yükle veya her sınıfa kendi dosyalarını yükle.',
            'step2' => 'Ağırlıkları başlat, birkaç epoch çalıştır ve loss ile accuracy’yi izle.',
            'step3' => 'İlk conv katmanının ne yakaladığını anlamak için filtreleri ve feature map’leri incele.',
            'step4' => 'Bir test görseli yükle ve sınıf olasılıklarını incele.',
        ],
    ],
    'controls' => [
        'load_demo' => 'Demo Verisi Yükle',
        'init_weights' => 'Ağırlıkları Başlat',
        'step' => 'Adım (1 Epoch)',
        'run' => 'Çalıştır',
        'stop' => 'Durdur',
        'reset' => 'Sıfırla',
        'lr' => 'LR:',
        'epochs' => 'Epochs:',
        'batch' => 'Batch:',
    ],
    'metrics' => [
        'dataset' => 'Dataset:',
        'epoch' => 'Epoch:',
        'loss' => 'Loss:',
        'accuracy' => 'Accuracy:',
    ],
    'training_images_title' => 'Eğitim Görselleri',
    'class1_label' => 'Sınıf 1 (etiket 0)',
    'class2_label' => 'Sınıf 2 (etiket 1)',
    'upload_hint' => 'Yüklenen görseller eğitimden önce 32x32 gri tonlamaya yeniden boyutlandırılır.',
    'loading_images' => 'Görseller yükleniyor...',
    'conv_filters_title' => 'Conv Filtreleri (Canlı)',
    'prediction_title' => 'Tahmin',
    'predict_button' => 'Yüklenen Görseli Tahmin Et',
    'feature_maps_title' => 'Feature Map’ler (Conv Katmanı)',
];
