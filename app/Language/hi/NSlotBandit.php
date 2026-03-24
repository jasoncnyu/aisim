<?php

return [
    'title' => 'N-Slot Bandit Lab',
    'subtitle' => 'Stochastic multi-armed bandit में exploration-exploitation strategies की तुलना करें।',
    'accordion' => [
        '1' => [
            'title' => '1) Problem Setup',
            'p1' => 'हर arm की एक unknown Bernoulli reward probability होती है। हर step पर agent एक arm चुनता है और reward 0 या 1 देखता है।',
        ],
        '2' => [
            'title' => '2) Algorithms Compared',
            'li1_label' => 'Epsilon-Greedy',
            'li1' => 'epsilon probability से random exploration।',
            'li2_label' => 'UCB1',
            'li2' => 'uncertain arms के लिए optimism bonus।',
            'li3_label' => 'Thompson Sampling',
            'li3' => 'Beta distributions से Bayesian posterior sampling।',
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
        'subtitle' => 'Manually edit करें या randomize करें, फिर Apply क्लिक करें।',
    ],
    'run_info' => [
        'title' => 'Run Info',
        'current_run' => 'Current run:',
        'step' => 'Step:',
        'avg_reward' => 'Avg reward:',
        'cum_regret' => 'Cum regret:',
    ],
];
