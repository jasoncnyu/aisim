<?php

return [
    'title' => 'Лабораторія N-Slot Bandit',
    'subtitle' => 'Порівняйте стратегії exploration-exploitation у стохастичному multi-armed bandit.',
    'accordion' => [
        '1' => [
            'title' => '1) Постановка задачі',
            'p1' => 'Кожна рука має невідому ймовірність винагороди Бернуллі. На кожному кроці агент обирає руку і спостерігає винагороду 0 або 1.',
        ],
        '2' => [
            'title' => '2) Порівнювані алгоритми',
            'li1_label' => 'Epsilon-Greedy',
            'li1' => 'випадкове дослідження з ймовірністю epsilon.',
            'li2_label' => 'UCB1',
            'li2' => 'бонус оптимізму для невизначених рук.',
            'li3_label' => 'Thompson Sampling',
            'li3' => 'байєсівське вибіркове семплювання через Beta-розподіли.',
        ],
    ],
    'controls' => [
        'algorithm' => 'Algorithm',
        'eps_greedy' => 'Epsilon-Greedy',
        'ucb1' => 'UCB1',
        'thompson' => 'Thompson Sampling',
        'arms' => 'Arms (N)',
        'steps' => 'Steps',
        'runs' => 'Runs',
        'epsilon' => 'Epsilon',
        'seed' => 'Seed',
        'optional' => 'optional',
        'randomize' => 'Randomize Probs',
        'apply' => 'Apply',
        'run' => 'Run',
        'step' => 'Step',
        'stop' => 'Stop',
        'reset' => 'Reset',
        'export_csv' => 'Export CSV',
    ],
    'charts' => [
        'avg_reward' => 'Average Reward',
        'cum_regret' => 'Cumulative Regret',
    ],
    'arms' => [
        'title' => 'Arms (True Probabilities)',
        'subtitle' => 'Редагуйте вручну або randomize, потім натисніть Apply.',
    ],
    'run_info' => [
        'title' => 'Run Info',
        'current_run' => 'Current run:',
        'step' => 'Step:',
        'avg_reward' => 'Avg reward:',
        'cum_regret' => 'Cum regret:',
    ],
];
