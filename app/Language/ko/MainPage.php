<?php

return [
    'pageTitle' => '홈',
    'tagline' => 'AI Simulator',
    'title' => 'AI를 배우기 위한 시각적 실습실',
    'description' => 'AI Simulator는 추상적인 수학을 상호작용형 실험으로 바꿉니다. 실시간으로 모델을 학습하고, 손실 곡선의 변화를 보며, 파라미터를 조정할 때 결정이 어떻게 달라지는지 확인하며 직관을 쌓아보세요.',
    'labels' => [
        'interactive_labs' => '상호작용형 실습',
        'live_training' => '실시간 학습',
        'explainable_visuals' => '설명 가능한 시각화',
        'guided_experiments' => '가이드 실험',
    ],
    'cta' => [
        'start_learning' => '학습 시작',
        'try_cnn_mnist' => 'CNN MNIST 체험',
    ],
    
    // How to Use Section
    'howToUse' => [
        'title' => '플랫폼 사용 방법',
        'subtitle' => '호기심에서 확신 있는 직관으로 가는 짧은 경로.',
        'steps' => [
            [
                'number' => '1',
                'label' => '단계',
                'title' => '실험 선택',
                'description' => '실험을 선택하고 상단의 개념 요약을 읽어보세요. 모델이 무엇을 배우려는지 알려줍니다.',
            ],
            [
                'number' => '2',
                'label' => '단계',
                'title' => '데이터 생성',
                'description' => '클릭, 데모 로드, 샘플 이미지를 이용해 데이터를 만드세요. 데이터 형태가 모든 것을 좌우합니다.',
            ],
            [
                'number' => '3',
                'label' => '단계',
                'title' => '학습 및 관찰',
                'description' => '단계 또는 자동 실행으로 학습한 뒤 손실 곡선과 모델 행동이 어떻게 변하는지 관찰하세요.',
            ],
            [
                'number' => '4',
                'label' => '단계',
                'title' => '비교 및 성찰',
                'description' => '하이퍼파라미터나 모델 종류를 바꿔 편향, 분산, 과적합을 확인합니다.',
            ],
        ],
    ],
    
    // Learning Tracks Section
    'learningTracks' => [
        'title' => '핵심 학습 경로',
        'machinelearning' => [
            'title' => '머신러닝',
            'description' => '모델이 데이터에서 어떻게 학습하는지 이해하려면 여기서 시작하세요. 단순한 곡선이 점에 맞춰 휘는 과정, 분류기가 경계를 그리는 방식, 모델 용량의 중요성을 확인할 수 있습니다. 손실 함수, 그라디언트, 데이터 기하에 대한 직관을 만드는 경로입니다.',
            'question' => '답을 얻기 위해 사용하세요: 왜 모델은 과소적합 또는 과적합이 되는가? 데이터 분포는 결정 경계를 어떻게 바꾸는가?',
            'labs' => [
                '선형 회귀',
                '로지스틱 회귀',
                '결정 트리',
                'K-Means',
                'K-NN',
                'SVM',
            ],
        ],
        'deeplearning' => [
            'title' => '딥러닝',
            'description' => '이 경로는 곡선에서 네트워크로 직관을 확장합니다. 뉴런이 입력을 표현으로 변환하는 과정과, 합성곱 필터가 시각적 특징을 추출하는 과정을 관찰합니다. 깊이와 비선형성이 모델 표현력을 어떻게 바꾸는지가 핵심입니다.',
            'question' => '답을 얻기 위해 사용하세요: CNN은 어떻게 에지를 학습하는가? 손실이 계속 개선되는데도 과적합이 되는 이유는 무엇인가?',
            'labs' => [
                'NN 회귀',
                'CNN Binary',
                'CNN MNIST',
                'XOR 실험실',
                'Tiny Web LLM',
            ],
        ],
        'reinforcement' => [
            'title' => '강화학습',
            'description' => '여기서 모델은 라벨된 예시가 아니라 보상으로부터 학습하는 에이전트입니다. 탐험 vs 활용, 희소 보상, 환경 동역학의 역할을 살펴봅니다.',
            'question' => '답을 얻기 위해 사용하세요: 언제 탐험이 더 나은가? 보상 구조는 행동을 어떻게 형성하는가?',
            'labs' => [
                'N-슬롯 밴딧',
                '그리드 월드',
            ],
        ],
    ],
    'quickStart' => [
        'title' => '빠른 시작 프롬프트',
        'items' => [
            [
                'label' => 'ML이 처음인가요?',
                'text' => '선형 회귀와 로지스틱 회귀로 시작한 뒤 결정 트리와 비교하세요.',
            ],
            [
                'label' => '곡선이 궁금한가요?',
                'text' => 'NN 회귀로 깊이와 너비가 적합을 어떻게 바꾸는지 확인하세요.',
            ],
            [
                'label' => '시각적 직관이 필요하나요?',
                'text' => 'CNN MNIST로 이동해 숫자를 그려 추론을 테스트하세요.',
            ],
        ],
        'cta' => [
            'start_linear' => '선형 회귀부터 시작',
            'explore_nn' => 'NN 회귀 살펴보기',
        ],
    ],
];
