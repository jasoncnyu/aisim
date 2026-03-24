<?php

return [
    'title' => 'N-Slot-Bandit-Labor',
    'subtitle' => 'Vergleiche Exploration/Exploitation in einem stochastischen Multi-Armed Bandit.',
    'accordion' => [
        '1' => [
            'title' => '1) Problemaufbau',
            'p1' => 'Jeder Arm hat eine unbekannte Bernoulli-Belohnungswahrscheinlichkeit. In jedem Schritt wählt der Agent einen Arm und beobachtet 0 oder 1.',
        ],
        '2' => [
            'title' => '2) Verglichene Algorithmen',
            'li1_label' => 'Epsilon-Greedy',
            'li1' => 'zufällige Exploration mit Wahrscheinlichkeit epsilon.',
            'li2_label' => 'UCB1',
            'li2' => 'Optimismus-Bonus für unsichere Arme.',
            'li3_label' => 'Thompson Sampling',
            'li3' => 'Bayesisches Posterior-Sampling via Beta-Verteilungen.',
        ],
    ],
    'controls' => [
        'algorithm' => 'Algorithmus',
        'eps_greedy' => 'Epsilon-Greedy',
        'ucb1' => 'UCB1',
        'thompson' => 'Thompson Sampling',
        'arms' => 'Arme (N)',
        'steps' => 'Schritte',
        'runs' => 'Runs',
        'epsilon' => 'Epsilon',
        'seed' => 'Seed',
        'optional' => 'optional',
        'randomize' => 'Wahrscheinlichkeiten randomisieren',
        'apply' => 'Anwenden',
        'run' => 'Start',
        'step' => 'Schritt',
        'stop' => 'Stopp',
        'reset' => 'Zurücksetzen',
        'export_csv' => 'CSV exportieren',
    ],
    'charts' => [
        'avg_reward' => 'Durchschnittliche Belohnung',
        'cum_regret' => 'Kumulierter Regret',
    ],
    'arms' => [
        'title' => 'Arme (wahre Wahrscheinlichkeiten)',
        'subtitle' => 'Manuell bearbeiten oder randomisieren, dann Anwenden klicken.',
    ],
    'run_info' => [
        'title' => 'Laufinfo',
        'current_run' => 'Aktueller Run:',
        'step' => 'Schritt:',
        'avg_reward' => 'Durchschn. Belohnung:',
        'cum_regret' => 'Kum. Regret:',
    ],
];
