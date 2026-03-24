<?php

return [
    'title' => 'K-평균 클러스터링 실습',
    'subtitle' => 'Voronoi 영역, 중심 업데이트, 관성 추적을 포함한 2D 클러스터링 시뮬레이터.',
    'accordion' => [
        '1' => [
            'title' => '1) K-평균이 최적화하는 것',
            'p1' => 'K-평균은 K개의 클러스터로 데이터를 나누며, 클러스터 내 제곱거리(관성)를 최소화합니다.',
            'equation' => '$$ J = \\sum_{i=1}^{N} \\min_{1 \\leq j \\leq K} \\left\\lVert x_i - \\mu_j \\right\\rVert^2 $$',
            'p2' => '각 샘플을 가장 가까운 중심에 할당한 뒤, 할당된 샘플의 평균으로 중심을 갱신합니다.',
        ],
        '2' => [
            'title' => '2) Lloyd 반복(할당 후 업데이트)',
            'p1' => '알고리즘은 두 단계 사이를 번갈아 수행합니다:',
            'equation1' => '$$ c_i \\leftarrow \\arg\\min_j \\lVert x_i - \\mu_j \\rVert^2 $$',
            'equation2' => '$$ \\mu_j \\leftarrow \\frac{1}{|C_j|}\\sum_{x_i \\in C_j} x_i $$',
            'p2' => '관성은 수렴할 때까지 단조 감소합니다.',
        ],
        '3' => [
            'title' => '3) 초기화가 중요한 이유',
            'p1' => '랜덤 초기화는 간단하지만 나쁜 시드에서 시작할 수 있습니다.',
            'p2' => 'k-means++는 초기 중심을 퍼뜨려 더 빠른 수렴과 낮은 관성을 주는 경우가 많습니다.',
            'p3' => '실무에서는 여러 시드로 여러 번 실행해 지역 최소 민감도를 줄입니다.',
        ],
        '4' => [
            'title' => '4) 추천 실험 흐름',
            'step1' => '데모 포인트를 로드하고 Random vs k-means++ 초기화를 비교합니다.',
            'step2' => 'K를 바꿔 경계와 클러스터 수를 확인합니다.',
            'step3' => 'Step으로 한 번의 할당/업데이트 사이클을 확인합니다.',
            'step4' => '수렴까지 실행하고 최종 관성을 비교합니다.',
        ],
    ],
    'controls' => [
        'k_label' => 'K:',
        'init_label' => '초기화:',
        'init_random' => '랜덤',
        'init_plus' => 'k-means++',
        'region_density' => '영역 밀도:',
        'load_demo' => '데모 로드',
        'init_centroids' => '중심 초기화',
        'step' => '단계',
        'run' => '실행',
        'stop' => '중지',
        'clear' => '지우기',
        'hint' => '캔버스를 클릭해 점을 추가하세요. 터치 기기에서는 길게 누르거나 오른쪽 클릭으로 가장 가까운 점을 삭제합니다.',
    ],
    'status' => [
        'title' => '상태',
        'points' => '점 수:',
        'k' => 'K:',
        'iteration' => '반복:',
        'inertia' => '관성:',
        'shift' => '중심 이동:',
    ],
    'inertia_title' => '관성 곡선',
    'summary_title' => '클러스터 요약',
];
