<?php

return [
    'title' => 'Laboratoire N-Slot Bandit',
    'subtitle' => 'Comparez les stratégies exploration-exploitation dans un bandit multi-bras stochastique.',
    'accordion' => [
        '1' => [
            'title' => '1) Mise en place du problème',
            'p1' => 'Chaque bras a une probabilité Bernoulli inconnue. À chaque étape, l’agent choisit un bras et observe une récompense 0 ou 1.',
        ],
        '2' => [
            'title' => '2) Algorithmes comparés',
            'li1_label' => 'Epsilon-Greedy',
            'li1' => 'exploration aléatoire avec probabilité epsilon.',
            'li2_label' => 'UCB1',
            'li2' => 'bonus d’optimisme pour les bras incertains.',
            'li3_label' => 'Thompson Sampling',
            'li3' => 'échantillonnage bayésien via des distributions Beta.',
        ],
    ],
    'controls' => [
        'algorithm' => 'Algorithme',
        'eps_greedy' => 'Epsilon-Greedy',
        'ucb1' => 'UCB1',
        'thompson' => 'Thompson Sampling',
        'arms' => 'Bras (N)',
        'steps' => 'Pas',
        'runs' => 'Exécutions',
        'epsilon' => 'Epsilon',
        'seed' => 'Seed',
        'optional' => 'optionnel',
        'randomize' => 'Randomiser les probas',
        'apply' => 'Appliquer',
        'run' => 'Exécuter',
        'step' => 'Étape',
        'stop' => 'Stop',
        'reset' => 'Réinitialiser',
        'export_csv' => 'Exporter CSV',
    ],
    'charts' => [
        'avg_reward' => 'Récompense moyenne',
        'cum_regret' => 'Regret cumulé',
    ],
    'arms' => [
        'title' => 'Bras (probabilités réelles)',
        'subtitle' => 'Modifiez à la main ou randomisez puis cliquez sur Appliquer.',
    ],
    'run_info' => [
        'title' => 'Info d’exécution',
        'current_run' => 'Exécution en cours :',
        'step' => 'Pas :',
        'avg_reward' => 'Récompense moy. :',
        'cum_regret' => 'Regret cumulé :',
    ],
];
