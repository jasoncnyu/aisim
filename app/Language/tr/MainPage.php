<?php

return [
    'pageTitle' => 'Ana Sayfa',
    'tagline' => 'AI Simulator',
    'title' => 'Yapay Zekayı Öğrenmek İçin Görsel Laboratuvar',
    'description' => 'AI Simulator soyut matematiği etkileşimli deneylere dönüştürür. Modelleri gerçek zamanda eğiterek, loss eğrilerinin hareketini izleyerek ve parametreleri ayarlarken kararların nasıl değiştiğini görerek sezgini geliştir.',
    'labels' => [
        'interactive_labs' => 'Etkileşimli Lablar',
        'live_training' => 'Canlı Eğitim',
        'explainable_visuals' => 'Açıklanabilir Görseller',
        'guided_experiments' => 'Yönlendirmeli Deneyler',
    ],
    'cta' => [
        'start_learning' => 'Öğrenmeye Başla',
        'try_cnn_mnist' => 'CNN MNIST Dene',
    ],
    
    // How to Use Section
    'howToUse' => [
        'title' => 'Bu Platform Nasıl Kullanılır',
        'subtitle' => 'Meraktan sağlam bir sezgiye kısa bir yol.',
        'steps' => [
            [
                'number' => '1',
                'label' => 'Adım',
                'title' => 'Bir lab seç',
                'description' => 'Bir lab seç ve üstteki kavram özetini oku. Modelin neyi öğrenmeye çalıştığını söyler.',
            ],
            [
                'number' => '2',
                'label' => 'Adım',
                'title' => 'Veri oluştur',
                'description' => 'Tıklayarak, demoları yükleyerek veya örnek görselleri kullanarak veri oluştur. Veri şekli her şeyi belirler.',
            ],
            [
                'number' => '3',
                'label' => 'Adım',
                'title' => 'Eğit ve gözlemle',
                'description' => 'Adım adım veya otomatik çalıştırma ile eğit, sonra loss eğrisi ve model davranışının nasıl evrildiğini izle.',
            ],
            [
                'number' => '4',
                'label' => 'Adım',
                'title' => 'Karşılaştır ve değerlendir',
                'description' => 'Hiperparametreleri veya model türünü değiştirerek bias, variance ve overfitting’i gör.',
            ],
        ],
    ],
    
    // Learning Tracks Section
    'learningTracks' => [
        'title' => 'Çekirdek Öğrenme Yolları',
        'machinelearning' => [
            'title' => 'Machine Learning',
            'description' => 'Modellerin veriden nasıl öğrendiğini anlamak için buradan başla. Basit bir eğrinin noktalara nasıl uyduğunu, sınıflandırıcıların sınırları nasıl çizdiğini ve model kapasitesinin neden önemli olduğunu görürsün. Bu yol, loss fonksiyonları, gradyanlar ve veri geometrisi için sezgi oluşturur.',
            'question' => 'Cevaplamak için kullan: Model neden underfit veya overfit olur? Veri dağılımı karar sınırını nasıl yeniden şekillendirir?',
            'labs' => [
                'Doğrusal Regresyon',
                'Lojistik Regresyon',
                'Karar Ağacı',
                'K-Means',
                'K-NN',
                'SVM',
            ],
        ],
        'deeplearning' => [
            'title' => 'Deep Learning',
            'description' => 'Bu yol, sezgiyi eğrilerden ağlara taşır. Nöronların girdileri temsillere nasıl dönüştürdüğünü ve konvolüsyon filtrelerinin görsel özellikleri nasıl çıkardığını izle. Odak, derinlik ve doğrusal olmayanlığın modelin ifade gücünü nasıl değiştirdiğidir.',
            'question' => 'Cevaplamak için kullan: CNN kenarları nasıl öğrenir? Loss düşerken bir sinir ağı neden overfit olur?',
            'labs' => [
                'NN Regression',
                'CNN Binary',
                'CNN MNIST',
                'XOR Lab',
                'Tiny Web LLM',
            ],
        ],
        'reinforcement' => [
            'title' => 'Reinforcement Learning',
            'description' => 'Burada model, etiketli örnekler yerine ödüllerden öğrenen bir ajandır. Keşif vs. sömürü, seyrek ödüller ve çevre dinamiklerinin rolünü incelersin.',
            'question' => 'Cevaplamak için kullan: Ne zaman keşfetmek daha iyidir? Ödül yapısı davranışı nasıl şekillendirir?',
            'labs' => [
                'N-Slot Bandit',
                'Grid World',
            ],
        ],
    ],
    'quickStart' => [
        'title' => 'Hızlı Başlangıç İpuçları',
        'items' => [
            [
                'label' => 'ML’e yeni misin?',
                'text' => 'Doğrusal Regresyon ve Lojistik Regresyon ile başla, sonra Karar Ağaçlarıyla karşılaştır.',
            ],
            [
                'label' => 'Eğriler ilgini çekiyor mu?',
                'text' => 'NN Regression ile derinlik ve genişliğin uyumu nasıl değiştirdiğini gör.',
            ],
            [
                'label' => 'Görsel sezgi ister misin?',
                'text' => 'CNN MNIST’e geç ve sayıları çizerek çıkarımı test et.',
            ],
        ],
        'cta' => [
            'start_linear' => 'Doğrusal Regresyon ile Başla',
            'explore_nn' => 'NN Regression Keşfet',
        ],
    ],
];
