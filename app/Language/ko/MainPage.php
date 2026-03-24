<?php

return [
    'pageTitle' => '홈',
    'tagline' => 'AI Simulator',
    'title' => 'AI를 배우기 위한 시각적 랩',
    'description' => 'AI Simulator는 추상적인 수학을 대화형 실험으로 변환합니다. 실시간에서 모델을 훈련하고, 손실 곡선이 움직이는 것을 보며, 매개변수를 조정할 때 결정이 어떻게 바뀌는지를 보면서 직관을 구축합니다.',
    'labels' => [
        'interactive_labs' => '대화형 랩',
        'live_training' => '실시간 훈련',
        'explainable_visuals' => '설명 가능한 시각화',
        'guided_experiments' => '가이드 실험',
    ],
    'cta' => [
        'start_learning' => '학습 시작',
        'try_cnn_mnist' => 'CNN MNIST 시도',
    ],
    
    // How to Use Section
    'howToUse' => [
        'title' => '이 플랫폼 사용 방법',
        'subtitle' => '호기심에서 자신감 있는 직관으로 가는 짧은 경로.',
        'steps' => [
            [
                'number' => '1',
                'label' => '단계',
                'title' => '랩 선택',
                'description' => '랩을 선택하고 맨 위의 개념 입문서를 읽으세요. 모델이 배우려는 것을 알려줍니다.',
            ],
            [
                'number' => '2',
                'label' => '단계',
                'title' => '데이터 만들기',
                'description' => '클릭, 데모 로드 또는 샘플 이미지를 사용하여 데이터를 만드세요. 데이터 형태가 모든 것을 주도합니다.',
            ],
            [
                'number' => '3',
                'label' => '단계',
                'title' => '훈련 및 관찰',
                'description' => '단계 또는 자동 실행으로 훈련하고 관찰한 후 손실 곡선과 모델 동작이 진화하는 것을 보세요.',
            ],
            [
                'number' => '4',
                'label' => '단계',
                'title' => '비교 및 반영',
                'description' => '하이퍼파라미터 또는 모델 유형을 변경하여 편향, 분산 및 과적합을 확인합니다.',
            ],
        ],
    ],
    
    // Learning Tracks Section
    'learningTracks' => [
        'title' => '핵심 학습 경로',
        'machinelearning' => [
            'title' => 'Machine Learning',
            'description' => '모델이 데이터에서 배우는 방식을 이해하기 위해 여기서 시작합니다. 간단한 곡선이 포인트에 어떻게 적응하는지, 분류기가 경계를 그리는 방법, 그리고 모델 용량이 왜 중요한지 볼 것입니다. 이 경로는 손실 함수, 그래디언트 및 데이터 기하학에 대한 직관을 구축하는 것입니다.',
            'question' => '답변하기 위해 사용하세요: 모델이 과소 적합 또는 과적합하는 이유는? 데이터 분포는 결정 경계를 어떻게 재형성합니까?',
            'reinforcement' => [
            'title' => '????',
            'description' => '??? ??? ??? ??? ??? ?????? ???? ???????. ?? vs ??, ?? ??, ?? ???? ??? ?????.',
            'question' => '?? ?? ?? ?????: ?? ??? ? ???? ?? ??? ??? ??? ??????',
            'labs' => [
                'N-?? ??',
                '??? ??',
            ],
        ],
    ],
        'deeplearning' => [
            'title' => 'Deep Learning',
            'description' => '이 경로는 곡선에서 네트워크로 직관을 확대합니다. 뉴런이 입력을 표현으로 변환하는 방식을 관찰하고, 합성곱 필터가 시각적 특징을 추출하는 방식을 봅니다. 초점은 깊이와 비선형성이 모델이 표현할 수 있는 것을 어떻게 변경하는지에 있습니다.',
            'question' => '답변하기 위해 사용하세요: CNN은 가장자리를 어떻게 배웁니까? 손실이 계속 개선되는 동안 신경 모델이 과적합하는 이유는?',

            'labs' => [
                'NN ??',
                'CNN Binary',
                'CNN MNIST',
                'XOR ???',
                'Tiny Web LLM',
            ],
        ],
    ],
    'quickStart' => [
        'title' => '?? ?? ????',
        'items' => [
            [
                'label' => 'ML? ??????',
                'text' => '?? ??? ???? ??? ??? ? ?? ??? ?????.',
            ],
            [
                'label' => '??? ??????',
                'text' => 'NN ??? ??? ??? ??? ??? ???? ?????.',
            ],
            [
                'label' => '??? ??? ??????',
                'text' => 'CNN MNIST? ??? ??? ?? ??? ??????.',
            ],
        ],
        'cta' => [
            'start_linear' => '?? ???? ??',
            'explore_nn' => 'NN ?? ????',
        ],
    ],
];
