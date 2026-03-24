<?php

return [
    'title' => 'XOR 신경망 실습',
    'subtitle' => '작은 MLP의 forward/backward 과정을 시각화합니다.',
    'accordion' => [
        '1' => [
            'title' => '1) XOR가 고전 데모인 이유',
            'p1' => 'XOR은 단일 선형 분리기로 풀 수 없습니다. 비선형 결정면이 필요합니다.',
            'p2' => '그래서 XOR은 은닉층과 비선형 활성화의 대표 장난감 문제입니다.',
        ],
        '2' => [
            'title' => '2) 사용한 네트워크 구조',
            'p1' => '시뮬레이터는 컴팩트한 MLP를 사용합니다:',
            'structure' => '입력(2) -> 은닉(4) -> 은닉(2) -> 출력(1)',
            'p2' => '출력은 sigmoid, 은닉 활성화는 tanh 또는 ReLU를 사용합니다.',
        ],
        '3' => [
            'title' => '3) 학습 동역학',
            'p1' => '각 단계는 XOR 케이스를 샘플링해 forward, 손실 계산, backprop 업데이트를 수행합니다.',
            'equation1' => '$$ z^{(l)} = a^{(l-1)}W^{(l)} + b^{(l)}, \\quad a^{(l)} = f(z^{(l)}) $$',
            'equation2' => '$$ W \\leftarrow W - \\eta \\nabla_W L, \\quad b \\leftarrow b - \\eta \\nabla_b L $$',
        ],
        '4' => [
            'title' => '4) 시각화 읽는 법',
            'li1' => '손실 차트는 학습 단계별 수렴 추이를 보여줍니다.',
            'li2' => '예측 패널은 네 가지 XOR 입력의 출력 확신도를 보여줍니다.',
            'li3' => '계산 패널은 최신 forward/backward 값을 기록합니다.',
        ],
    ],
    'controls' => [
        'title' => '학습 컨트롤',
        'learning_rate' => '학습률',
        'sleep' => '지연(ms)',
        'activation' => '활성화',
        'step' => '+1 단계',
        'auto_train' => '자동 학습',
        'reset' => '초기화',
        'step_label' => '단계:',
        'loss_label' => '손실:',
    ],
    'trace_title' => 'Forward/Backward 추적',
    'prediction_title' => '예측 스냅샷',
    'prediction_hint' => '원이 클수록 클래스 1 확률이 높습니다.',
    'targets_title' => 'XOR 타깃',
    'targets' => [
        'li1' => '(0,0) -> 0',
        'li2' => '(0,1) -> 1',
        'li3' => '(1,0) -> 1',
        'li4' => '(1,1) -> 0',
    ],
];

