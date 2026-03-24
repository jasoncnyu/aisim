<?php

return [
    'title' => 'CNN 이진 분류 실습',
    'subtitle' => '필터/피처맵 시각화를 포함한 2클래스 이미지 분류용 CNN.',
    'accordion' => [
        '1' => [
            'title' => '1) 모델 아키텍처',
            'p1' => '이 페이지는 컴팩트한 CNN을 학습합니다: Conv(3x3) -> ReLU -> Flatten -> Dense -> ReLU -> Dense -> Softmax.',
            'p2' => '입력 이미지는 그레이스케일 32x32로 변환됩니다.',
            'p3' => '이진 라벨은 클래스 1/2 확률로 매핑됩니다.',
        ],
        '2' => [
            'title' => '2) 학습 목표',
            'p1' => '두 클래스에 대한 교차 엔트로피로 최적화합니다:',
            'equation' => '$$ L = -\\frac{1}{N}\\sum_{i=1}^{N}\\sum_{c=1}^{2} y_{ic}\\log(\\hat{y}_{ic}) $$',
            'p2' => '안정적 수렴을 원하면 낮은 LR, 빠른 학습을 원하면 높은 LR을 사용하세요.',
        ],
        '3' => [
            'title' => '3) 추천 워크플로',
            'step1' => '데모 고양이/개 이미지를 불러오거나 사용자 이미지를 업로드합니다.',
            'step2' => '가중치를 초기화하고 몇 에폭 실행하며 손실/정확도를 확인합니다.',
            'step3' => '필터 값과 피처맵을 확인해 첫 conv가 무엇을 잡는지 봅니다.',
            'step4' => '테스트 이미지를 업로드해 클래스 확률을 확인합니다.',
        ],
    ],
    'controls' => [
        'load_demo' => '데모 데이터 로드',
        'init_weights' => '가중치 초기화',
        'step' => '단계(1 에폭)',
        'run' => '실행',
        'stop' => '중지',
        'reset' => '초기화',
        'lr' => 'LR:',
        'epochs' => '에폭:',
        'batch' => '배치:',
    ],
    'metrics' => [
        'dataset' => '데이터셋:',
        'epoch' => '에폭:',
        'loss' => '손실:',
        'accuracy' => '정확도:',
    ],
    'training_images_title' => '학습 이미지',
    'class1_label' => '클래스 1 (라벨 0)',
    'class2_label' => '클래스 2 (라벨 1)',
    'upload_hint' => '업로드된 이미지는 학습 전에 32x32 그레이스케일로 변환됩니다.',
    'loading_images' => '이미지 로딩 중...',
    'conv_filters_title' => '합성곱 필터(실시간)',
    'prediction_title' => '예측',
    'predict_button' => '업로드 이미지 예측',
    'feature_maps_title' => '피처맵(합성곱 층)',
];

