<?php

return [
    'title' => 'N-Slot Bandit Lab',
    'subtitle' => 'Stokastik çok kollu banditte keşif-sömürü stratejilerini karşılaştır.',
    'accordion' => [
        '1' => [
            'title' => '1) Problem Kurulumu',
            'p1' => 'Her kolun bilinmeyen Bernoulli ödül olasılığı vardır. Her adımda ajan bir kol seçer ve 0 veya 1 ödülü gözlemler.',
        ],
        '2' => [
            'title' => '2) Karşılaştırılan Algoritmalar',
            'li1_label' => 'Epsilon-Greedy',
            'li1' => 'epsilon olasılıkla rastgele keşif.',
            'li2_label' => 'UCB1',
            'li2' => 'belirsiz kollar için iyimserlik bonusu.',
            'li3_label' => 'Thompson Sampling',
            'li3' => 'Beta dağılımlarıyla Bayesçi posterior örnekleme.',
        ],
    ],
    'controls' => [
        'algorithm' => 'Algoritma',
        'eps_greedy' => 'Epsilon-Greedy',
        'ucb1' => 'UCB1',
        'thompson' => 'Thompson Sampling',
        'arms' => 'Kollar (N)',
        'steps' => 'Adımlar',
        'runs' => 'Koşular',
        'epsilon' => 'Epsilon',
        'seed' => 'Seed',
        'optional' => 'opsiyonel',
        'randomize' => 'Olasılıkları Rastgeleleştir',
        'apply' => 'Uygula',
        'run' => 'Çalıştır',
        'step' => 'Adım',
        'stop' => 'Durdur',
        'reset' => 'Sıfırla',
        'export_csv' => 'CSV Dışa Aktar',
    ],
    'charts' => [
        'avg_reward' => 'Ortalama Ödül',
        'cum_regret' => 'Birikimli Pişmanlık',
    ],
    'arms' => [
        'title' => 'Kollar (Gerçek Olasılıklar)',
        'subtitle' => 'Elle düzenle veya rastgeleleştir, sonra Uygula’ya tıkla.',
    ],
    'run_info' => [
        'title' => 'Koşu Bilgisi',
        'current_run' => 'Mevcut koşu:',
        'step' => 'Adım:',
        'avg_reward' => 'Ort ödül:',
        'cum_regret' => 'Birikimli pişmanlık:',
    ],
];
