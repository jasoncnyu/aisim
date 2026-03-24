<?php

return [
    'title' => '선형 회귀 시각화',
    'subtitle' => 'OLS, GD, SGD를 위한 인터랙티브 시뮬레이션.',
    'accordion' => [
        '1' => [
            'title' => '1) 선형 회귀가 해결하는 것',
            'p1' => '선형 회귀는 입력 x와 출력 y 사이의 직선 관계를 추정합니다.',
            'equation' => 'y = ax + b',
            'p2' => '여기서 a는 기울기, b는 절편입니다. 이 시뮬레이터에서는 추가한 각 점이 학습 샘플이며 모델이 가장 잘 맞는 a와 b를 찾습니다.',
        ],
        '2' => [
            'title' => '2) 오차 함수와 MSE를 쓰는 이유',
            'p1' => '모델은 평균제곱오차(MSE)를 최소화합니다:',
            'equation' => '$$ MSE(a,b) = \\frac{1}{n}\\sum_{i=1}^{n}(y_i-(ax_i+b))^2 $$',
            'p2' => '제곱은 큰 오차를 더 강하게 벌하고, 매끄러운 최적화 목표를 제공합니다. 손실이 낮을수록 더 잘 맞습니다.',
        ],
        '3' => [
            'title' => '3) OLS vs GD vs SGD',
            'ols' => '폐형식 해, 한 번에 계산.',
            'gd' => '에폭마다 모든 샘플 사용, 안정적이지만 무거움.',
            'sgd' => '셔플된 단일 샘플 업데이트, 빠르지만 노이즈가 큼.',
            'p1' => '같은 점으로 각 방법의 학습 곡선을 비교해 보세요.',
        ],
        '4' => [
            'title' => '4) 추천 학습 흐름',
            'step1' => '점 추가 또는 데모 데이터 로드.',
            'step2' => '먼저 OLS로 기준선을 얻기.',
            'step3' => 'GD/SGD로 전환해 학습률과 에폭 조정.',
            'step4' => '테스트 모드로 실제값과 예측값 확인.',
        ],
    ],
    'controls' => [
        'add_point' => '점 추가',
        'clear_points' => '점 삭제',
        'load_demo' => '데모 데이터 불러오기',
        'hint' => '클릭해서 점을 추가하세요. 점을 길게 눌러 삭제할 수 있습니다.',
        'method' => '회귀 방법',
        'method_ols' => 'OLS',
        'method_gd' => '배치 경사하강법',
        'method_sgd' => '확률적 경사하강법',
        'learning_rate' => '학습률',
        'epochs' => '에폭',
        'step_train' => '단계 학습',
        'auto_train' => '자동 학습',
        'test_mode' => '테스트 모드',
    ],
    'loss_title' => '손실(MSE)',
    'model' => [
        'title' => '모델',
        'points' => '점 수:',
        'slope' => '기울기(a):',
        'intercept' => '절편(b):',
        'r2' => 'R2:',
        'last_loss' => '최근 손실:',
    ],
    'notes' => [
        'title' => '방법 노트',
        'ols' => [
            'title' => 'OLS',
            'desc' => '공분산과 분산에서 구한 폐형식 해:',
            'formula' => '$$ a = \\frac{\\sum (x_i-\\bar{x})(y_i-\\bar{y})}{\\sum (x_i-\\bar{x})^2}, \\quad b = \\bar{y} - a\\bar{x} $$',
        ],
        'gd' => [
            'title' => 'Batch GD',
            'desc' => '전체 데이터셋의 그래디언트로 업데이트:',
            'formula' => '$$ a \\leftarrow a - \\eta \\frac{\\partial MSE}{\\partial a}, \\quad b \\leftarrow b - \\eta \\frac{\\partial MSE}{\\partial b} $$',
        ],
        'sgd' => [
            'title' => 'SGD',
            'desc' => '셔플된 점에 대해 샘플 단위로 업데이트:',
            'formula' => '$$ a \\leftarrow a - \\eta \\cdot 2(ax_j+b-y_j)x_j, \\quad b \\leftarrow b - \\eta \\cdot 2(ax_j+b-y_j) $$',
        ],
    ],
];

