<?php

return [
    'title' => 'Tiny Web LLM 실습',
    'subtitle' => '브라우저에서 작은 next-token 모델을 학습하고 텍스트를 생성합니다.',
    'accordion' => [
        '1' => [
            'title' => '1) 이 시뮬레이터가 가르치는 것',
            'p1' => '토큰화, 컨텍스트 윈도, 로짓, 소프트맥스, 그래디언트 업데이트 등 언어 모델의 핵심을 보여줍니다.',
            'p2' => '의도적으로 작고 교육용입니다. 손실을 확인하고 Greedy, Sampling, Top-k를 비교하세요.',
        ],
        '2' => [
            'title' => '2) 모델 설계',
            'p1' => '토큰은 공백으로 분리된 단어입니다. 모델은 컨텍스트 토큰 임베딩을 평균내어 로짓으로 투영합니다.',
            'equation' => '$$ h = \\frac{1}{K}\\sum E(t_i),\\quad z = W^Th + b,\\quad p = softmax(z) $$',
            'p2' => '학습은 토큰별 교차엔트로피와 단순 SGD 업데이트를 사용합니다.',
        ],
    ],
    'train' => [
        'title' => '1) 학습 코퍼스',
        'load_demo' => '데모 불러오기:',
    ],
    'hyper' => [
        'title' => '2) 하이퍼파라미터',
        'embed' => '임베딩 크기',
        'context' => '컨텍스트 길이',
        'epochs' => '에폭',
        'lr' => '학습률',
        'train_embeddings' => '임베딩 학습',
    ],
    'run' => [
        'title' => '3) 학습 실행',
        'start' => '학습 시작',
        'stop' => '중지',
    ],
    'generate' => [
        'title' => '4) 텍스트 생성',
        'prompt' => '프롬프트',
        'tokens' => '토큰',
        'temperature' => '온도',
        'greedy' => 'Greedy',
        'sampling' => 'Sampling',
        'topk' => 'Top-k',
        'generate' => '생성',
    ],
];
