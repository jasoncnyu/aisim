<?php

return [
    'title' => 'N-Slot Bandit Lab',
    'subtitle' => 'Compare exploration-exploitation strategies in a stochastic multi-armed bandit.',
    'accordion' => [
        '1' => [
            'title' => '1) Problem Setup',
            'p1' => 'Each arm has an unknown Bernoulli reward probability. At each step the agent chooses one arm and observes reward 0 or 1.',
        ],
        '2' => [
            'title' => '2) Algorithms Compared',
            'li1_label' => 'Epsilon-Greedy',
            'li1' => 'random exploration with probability epsilon.',
            'li2_label' => 'UCB1',
            'li2' => 'optimism bonus for uncertain arms.',
            'li3_label' => 'Thompson Sampling',
            'li3' => 'Bayesian posterior sampling via Beta distributions.',
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
        'subtitle' => 'Edit manually or randomize, then click Apply.',
    ],
    'run_info' => [
        'title' => 'Run Info',
        'current_run' => 'Current run:',
        'step' => 'Step:',
        'avg_reward' => 'Avg reward:',
        'cum_regret' => 'Cum regret:',
    ],
];
