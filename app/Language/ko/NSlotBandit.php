<?php

return [
    'title' => 'N-슬롯 밴딧 실습',
    'subtitle' => '확률적 다중 밴딧에서 탐험-활용 전략을 비교합니다.',
    'accordion' => [
        '1' => [
            'title' => '1) 문제 설정',
            'p1' => '각 팔은 알려지지 않은 Bernoulli 보상 확률을 가집니다. 매 단계 에이전트가 하나의 팔을 선택해 0 또는 1 보상을 관찰합니다.',
        ],
        '2' => [
            'title' => '2) 비교 알고리즘',
            'li1_label' => 'Epsilon-Greedy',
            'li1' => 'epsilon 확률로 무작위 탐험.',
            'li2_label' => 'UCB1',
            'li2' => '불확실한 팔에 낙관적 보너스 부여.',
            'li3_label' => 'Thompson Sampling',
            'li3' => 'Beta 분포를 통한 베이지안 사후 샘플링.',
        ],
    ],
    'controls' => [
        'algorithm' => '알고리즘',
        'eps_greedy' => 'Epsilon-Greedy',
        'ucb1' => 'UCB1',
        'thompson' => 'Thompson Sampling',
        'arms' => '팔 (N)',
        'steps' => '스텝',
        'runs' => '실행 횟수',
        'epsilon' => '엡실론',
        'seed' => '시드',
        'optional' => '선택',
        'randomize' => '확률 랜덤화',
        'apply' => '적용',
        'run' => '실행',
        'step' => '단계',
        'stop' => '중지',
        'reset' => '초기화',
        'export_csv' => 'CSV 내보내기',
    ],
    'charts' => [
        'avg_reward' => '평균 보상',
        'cum_regret' => '누적 후회',
    ],
    'arms' => [
        'title' => '팔(실제 확률)',
        'subtitle' => '수동 편집 또는 랜덤화 후 적용을 클릭하세요.',
    ],
    'run_info' => [
        'title' => '실행 정보',
        'current_run' => '현재 실행:',
        'step' => '스텝:',
        'avg_reward' => '평균 보상:',
        'cum_regret' => '누적 후회:',
    ],
];
