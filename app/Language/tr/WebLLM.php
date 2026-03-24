<?php

return [
    'title' => 'Tiny Web LLM Lab',
    'subtitle' => 'Tarayıcıda küçük bir sonraki-token modeli eğit ve metin üret.',
    'accordion' => [
        '1' => [
            'title' => '1) Bu Simülatör Ne Öğretir',
            'p1' => 'Bu sayfa dil modellemenin temel mekaniklerini gösterir: tokenization, context window, logits, softmax ve gradyan tabanlı güncellemeler.',
            'p2' => 'Bilerek küçük ve eğitseldir. Eğitim loss’unu görebilir ve Greedy, Sampling, Top-k gibi çözümleme stratejilerini karşılaştırabilirsin.',
        ],
        '2' => [
            'title' => '2) Model Tasarımı',
            'p1' => 'Tokenlar boşluklara göre ayrılan kelimelerdir. Model, mevcut bağlamdaki token embedding’lerinin ortalamasını alır ve sözlük logits’lerine projeksiyon yapar.',
            'equation' => '$$ h = \\frac{1}{K}\\sum E(t_i),\\quad z = W^Th + b,\\quad p = softmax(z) $$',
            'p2' => 'Eğitim, token başına cross-entropy ve basit SGD güncellemeleriyle yapılır.',
        ],
    ],
    'train' => [
        'title' => '1) Eğitim Korpusu',
        'load_demo' => 'Demo yükle:',
    ],
    'hyper' => [
        'title' => '2) Hiperparametreler',
        'embed' => 'Embedding Boyutu',
        'context' => 'Bağlam Uzunluğu',
        'epochs' => 'Epochs',
        'lr' => 'Learning Rate',
        'train_embeddings' => 'Embeddingleri Eğit',
    ],
    'run' => [
        'title' => '3) Eğitim Çalışması',
        'start' => 'Eğitimi Başlat',
        'stop' => 'Durdur',
    ],
    'generate' => [
        'title' => '4) Metin Üretimi',
        'prompt' => 'Prompt',
        'tokens' => 'Tokens',
        'temperature' => 'Temperature',
        'greedy' => 'Greedy',
        'sampling' => 'Sampling',
        'topk' => 'Top-k',
        'generate' => 'Üret',
    ],
];
