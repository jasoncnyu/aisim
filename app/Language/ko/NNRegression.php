<?php

return [
    'title' => '비선형 신경 회귀 실습',
    'subtitle' => '다층 퍼셉트론으로 비선형 곡선을 맞추고 과적합 시 train/val 분기를 관찰합니다.',
    'accordion' => [
        '1' => [
            'title' => '1) 모델 수식',
            'p1' => '선형 회귀 y=ax+b와 달리, 은닉층으로 비선형 매핑 x → y를 학습합니다.',
            'equation' => '$$\\hat{y}=W_L\\,\\phi(W_{L-1}\\phi(\\cdots\\phi(W_1x+b_1)\\cdots)+b_{L-1})+b_L$$',
            'p2' => '깊이, 너비, 활성화를 선택해 모델 용량을 조절합니다.',
        ],
        '2' => [
            'title' => '2) 손실과 과적합 신호',
            'p1' => '목표는 학습 서브셋의 평균제곱오차(MSE)입니다:',
            'equation' => '$$\\text{MSE}=\\frac{1}{n}\\sum_{i=1}^{n}(y_i-\\hat{y}_i)^2$$',
            'p2' => 'train 손실은 감소하지만 val 손실이 정체/상승하면 과적합입니다.',
        ],
    ],
    'controls' => [
        'add_point' => '점 추가',
        'test_mode' => '테스트 모드',
        'clear' => '지우기',
        'demo' => [
            'sine' => '사인 곡선',
            'cubic' => '삼차 곡선',
            'piecewise' => '구간별 곡선',
        ],
        'load_demo' => '데모 로드',
        'hint' => '클릭해서 샘플을 추가합니다. 테스트 모드에서는 x 위치를 클릭해 예측 y와 잔차를 확인합니다.',
    ],
    'params' => [
        'hidden_layers' => '은닉층',
        'units_per_layer' => '층당 유닛 수',
        'activation' => '활성화',
        'val_ratio' => '검증 비율',
        'lr' => 'LR',
        'batch' => '배치',
        'epochs' => '에폭',
        'l2_reg' => 'L2 규제',
        'init_model' => '모델 초기화',
    ],
    'actions' => [
        'step' => '단계',
        'run' => '실행',
        'stop' => '중지',
    ],
    'status' => [
        'title' => '학습 상태',
        'points' => '점 수:',
        'train_val' => 'Train / Val:',
        'epoch' => '에폭:',
        'train_loss' => 'Train 손실:',
        'val_loss' => 'Val 손실:',
    ],
    'interpretation' => [
        'title' => '해석',
        'li1' => '파란 점: 학습, 주황 점: 검증.',
        'li2' => '테스트 모드의 노란 마커: 클릭한 x의 예측 출력.',
        'li3' => 'train 손실이 내려가고 val 손실이 오르면 과적합입니다.',
        'li4' => 'L2 규제를 높이거나 은닉층을 줄여 과적합을 완화하세요.',
    ],
];

