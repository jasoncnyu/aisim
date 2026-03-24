<?php

return [
    'title' => 'Laboratorio N-Slot Bandit',
    'subtitle' => 'Confronta strategie di esplorazione-sfruttamento in un bandit multi-armed stocastico.',
    'accordion' => [
        '1' => [
            'title' => '1) Setup del problema',
            'p1' => 'Ogni braccio ha una probabilita di ricompensa Bernoulli sconosciuta. A ogni step l agente sceglie un braccio e osserva ricompensa 0 o 1.',
        ],
        '2' => [
            'title' => '2) Algoritmi confrontati',
            'li1_label' => 'Epsilon-Greedy',
            'li1' => 'esplorazione casuale con probabilita epsilon.',
            'li2_label' => 'UCB1',
            'li2' => 'bonus di ottimismo per bracci incerti.',
            'li3_label' => 'Thompson Sampling',
            'li3' => 'campionamento Bayesiano del posteriore tramite distribuzioni Beta.',
        ],
    ],
    'controls' => [
        'algorithm' => 'Algoritmo',
        'eps_greedy' => 'Epsilon-Greedy',
        'ucb1' => 'UCB1',
        'thompson' => 'Thompson Sampling',
        'arms' => 'Bracci (N)',
        'steps' => 'Step',
        'runs' => 'Run',
        'epsilon' => 'Epsilon',
        'seed' => 'Seed',
        'optional' => 'opzionale',
        'randomize' => 'Randomizza probabilita',
        'apply' => 'Applica',
        'run' => 'Esegui',
        'step' => 'Step',
        'stop' => 'Stop',
        'reset' => 'Reset',
        'export_csv' => 'Esporta CSV',
    ],
    'charts' => [
        'avg_reward' => 'Ricompensa media',
        'cum_regret' => 'Regret cumulativo',
    ],
    'arms' => [
        'title' => 'Bracci (probabilita reali)',
        'subtitle' => 'Modifica manualmente o randomizza, poi clicca Applica.',
    ],
    'run_info' => [
        'title' => 'Info run',
        'current_run' => 'Run corrente:',
        'step' => 'Step:',
        'avg_reward' => 'Ricompensa media:',
        'cum_regret' => 'Regret cumulativo:',
    ],
];
