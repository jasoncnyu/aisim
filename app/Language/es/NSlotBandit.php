<?php

return [
    'title' => 'Laboratorio N-Slot Bandit',
    'subtitle' => 'Compara estrategias de exploración-explotación en un bandido multi-brazo estocástico.',
    'accordion' => [
        '1' => [
            'title' => '1) Planteamiento del problema',
            'p1' => 'Cada brazo tiene una probabilidad de recompensa Bernoulli desconocida. En cada paso el agente elige un brazo y observa recompensa 0 o 1.',
        ],
        '2' => [
            'title' => '2) Algoritmos comparados',
            'li1_label' => 'Epsilon-Greedy',
            'li1' => 'exploración aleatoria con probabilidad epsilon.',
            'li2_label' => 'UCB1',
            'li2' => 'bono de optimismo para brazos inciertos.',
            'li3_label' => 'Thompson Sampling',
            'li3' => 'muestreo bayesiano posterior con distribuciones Beta.',
        ],
    ],
    'controls' => [
        'algorithm' => 'Algoritmo',
        'eps_greedy' => 'Epsilon-Greedy',
        'ucb1' => 'UCB1',
        'thompson' => 'Thompson Sampling',
        'arms' => 'Brazos (N)',
        'steps' => 'Pasos',
        'runs' => 'Corridas',
        'epsilon' => 'Epsilon',
        'seed' => 'Semilla',
        'optional' => 'opcional',
        'randomize' => 'Aleatorizar probabilidades',
        'apply' => 'Aplicar',
        'run' => 'Ejecutar',
        'step' => 'Paso',
        'stop' => 'Detener',
        'reset' => 'Reiniciar',
        'export_csv' => 'Exportar CSV',
    ],
    'charts' => [
        'avg_reward' => 'Recompensa promedio',
        'cum_regret' => 'Arrepentimiento acumulado',
    ],
    'arms' => [
        'title' => 'Brazos (probabilidades reales)',
        'subtitle' => 'Edita manualmente o aleatoriza y luego haz clic en Aplicar.',
    ],
    'run_info' => [
        'title' => 'Info de ejecución',
        'current_run' => 'Corrida actual:',
        'step' => 'Paso:',
        'avg_reward' => 'Recompensa prom.:',
        'cum_regret' => 'Arrepent. acum.:',
    ],
];
