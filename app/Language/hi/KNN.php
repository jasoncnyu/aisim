<?php

return [
    'title' => 'K-Nearest Neighbors Lab',
    'subtitle' => 'Interactive decision regions, neighbor inspection और weighted voting के साथ instance-based classification।',
    'accordion' => [
        '1' => [
            'title' => '1) K-NN का core idea',
            'p1' => 'K-NN global model parameters नहीं सीखता। यह feature space में nearby training points के labels से prediction करता है।',
            'p2' => 'Query point x के लिए सबसे नज़दीकी K samples चुनें और उनकी labels को majority vote (या weighted vote) से aggregate करें।',
            'equation' => '$$\\hat{y}(x)=\\arg\\max_c \\sum_{i\\in \\mathcal{N}_K(x)} w_i\\,\\mathbf{1}(y_i=c)$$',
        ],
        '2' => [
            'title' => '2) K और distance weighting का असर',
            'li1' => 'छोटा K: boundary ज्यादा flexible, local noise के प्रति संवेदनशील।',
            'li2' => 'बड़ा K: boundary smoother, variance कम, bias ज्यादा हो सकता है।',
            'li3' => 'Weighted voting (w=1/d) बहुत पास वाले neighbors को ज्यादा महत्व देता है।',
        ],
        '3' => [
            'title' => '3) Practical Notes',
            'p1' => 'K-NN distance पर निर्भर है, इसलिए feature scaling real datasets में बहुत महत्वपूर्ण है। Standardization आमतौर पर reliability बढ़ाता है।',
            'p2' => 'Prediction cost dataset size के साथ बढ़ता है क्योंकि inference पर कई distances compute करनी होती हैं।',
            'p3' => 'Validation से K चुनें और noisy या overlapping class distributions पर robustness जांचें।',
        ],
        '4' => [
            'title' => '4) Suggested Workflow',
            'step1' => 'Demo distribution लोड करें (vertical, XOR, concentric, overlap, random)।',
            'step2' => 'K बदलें और weighted voting toggle कर boundary तुलना करें।',
            'step3' => 'Test Mode ऑन करें और nearest neighbors व class probability देखें।',
            'step4' => 'Region density बढ़ाकर finer boundaries देखें, फिर तेज rendering के लिए घटाएं।',
        ],
    ],
    'controls' => [
        'class_a' => 'Class A',
        'class_b' => 'Class B',
        'test_mode' => 'Test Mode',
        'k_label' => 'K:',
        'weighted' => 'Weighted (1/d)',
        'region_density' => 'Region Density:',
        'demo' => [
            'vertical' => 'Mixed Vertical',
            'xor' => 'XOR (4 Clusters)',
            'concentric' => 'Concentric (Center vs Ring)',
            'overlap' => 'Overlapping (Hard)',
            'random' => 'Random Clusters',
        ],
        'load_demo' => 'Load Demo',
        'refresh' => 'Refresh',
        'clear' => 'Clear',
        'hint' => 'Training samples जोड़ने के लिए क्लिक करें। Test Mode में query point classify करने और neighbors देखने के लिए क्लिक करें।',
    ],
    'model' => [
        'title' => 'Model Info',
        'points' => 'Points:',
        'last_prob' => 'Last Test P(B):',
    ],
    'neighbors_title' => 'Nearest Neighbors',
];
