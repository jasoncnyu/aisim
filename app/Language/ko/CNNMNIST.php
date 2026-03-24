<?php

return [
    'title' => 'CNN MNIST 실습',
    'subtitle' => '10개 숫자 클래스로 CNN을 학습하고, 숫자를 그려 실시간 추론합니다.',
    'accordion' => [
        '1' => [
            'title' => '1) 데이터셋 로딩 정책',
            'p1' => '데모 샘플은 0..9 클래스로 패키징됩니다. 기본 로드는 클래스당 10장(총 100장)입니다.',
            'p2' => '클래스당 +10 추가로 20, 30, 40, 50까지 확장(최대 500장).',
            'p3' => '빠른 실험과 클래스 균형을 위해 설계되었습니다.',
        ],
        '2' => [
            'title' => '2) 10클래스 CNN 목표',
            'p1' => '모델은 10-way softmax 분포를 출력합니다.',
            'equation' => '$$\\hat{y}_c = \\frac{e^{z_c}}{\\sum_{k=0}^{9} e^{z_k}}, \\quad L = -\\frac{1}{N}\\sum_i\\sum_{c=0}^{9} y_{ic}\\log(\\hat{y}_{ic})$$',
            'p2' => '학습률, 배치 크기, 옵티마이저, 아키텍처를 조절해 속도/안정성을 균형화하세요.',
        ],
    ],
    'controls' => [
        'load_base' => '클래스당 10장 로드',
        'add_10' => '클래스당 +10 추가',
        'clear_data' => '데이터 지우기',
        'loaded_per_class' => '클래스당 로드:',
        'init_weights' => '가중치 초기화',
        'step' => '단계(1 에폭)',
        'run' => '실행',
        'stop' => '중지',
        'lr' => 'LR:',
        'epochs' => '에폭:',
        'batch' => '배치:',
        'optimizer' => '옵티마이저:',
        'momentum' => '모멘텀:',
        'conv_filters' => 'Conv 필터:',
        'hidden_units' => '은닉 유닛:',
        'apply_arch' => '아키텍처 적용',
        'clear' => '지우기',
        'predict' => '예측',
    ],
    'metrics' => [
        'dataset' => '데이터셋:',
        'epoch' => '에폭:',
        'loss' => '손실:',
        'accuracy' => '정확도:',
    ],
    'demo_samples_title' => '데모 샘플',
    'loading_images' => '숫자 이미지 로딩 중...',
    'draw_title' => '그리기 및 예측',
    'confusion_title' => '혼동 행렬',
];

