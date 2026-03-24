<?php

return [
    'title' => 'Laboratório N-Slot Bandit',
    'subtitle' => 'Compare estratégias de exploração-exploração em um bandit estocástico multi-braço.',
    'accordion' => [
        '1' => [
            'title' => '1) Configuração do problema',
            'p1' => 'Cada braço tem uma probabilidade Bernoulli desconhecida. A cada passo o agente escolhe um braço e observa recompensa 0 ou 1.',
        ],
        '2' => [
            'title' => '2) Algoritmos comparados',
            'li1_label' => 'Epsilon-Greedy',
            'li1' => 'exploração aleatória com probabilidade epsilon.',
            'li2_label' => 'UCB1',
            'li2' => 'bônus de otimismo para braços incertos.',
            'li3_label' => 'Thompson Sampling',
            'li3' => 'amostragem bayesiana posterior via distribuições Beta.',
        ],
    ],
    'controls' => [
        'algorithm' => 'Algoritmo',
        'eps_greedy' => 'Epsilon-Greedy',
        'ucb1' => 'UCB1',
        'thompson' => 'Thompson Sampling',
        'arms' => 'Braços (N)',
        'steps' => 'Passos',
        'runs' => 'Execuções',
        'epsilon' => 'Epsilon',
        'seed' => 'Seed',
        'optional' => 'opcional',
        'randomize' => 'Randomizar probabilidades',
        'apply' => 'Aplicar',
        'run' => 'Executar',
        'step' => 'Passo',
        'stop' => 'Parar',
        'reset' => 'Resetar',
        'export_csv' => 'Exportar CSV',
    ],
    'charts' => [
        'avg_reward' => 'Recompensa média',
        'cum_regret' => 'Arrependimento acumulado',
    ],
    'arms' => [
        'title' => 'Braços (probabilidades reais)',
        'subtitle' => 'Edite manualmente ou randomize e depois clique em Aplicar.',
    ],
    'run_info' => [
        'title' => 'Info da execução',
        'current_run' => 'Execução atual:',
        'step' => 'Passo:',
        'avg_reward' => 'Recomp. média:',
        'cum_regret' => 'Arrepend. acum.:',
    ],
];
