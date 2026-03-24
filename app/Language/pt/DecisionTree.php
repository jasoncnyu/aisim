<?php

return [
    'title' => 'Laboratório Visual de Árvore de Decisão',
    'subtitle' => 'Simulador interativo de splits alinhados aos eixos para classificação binária.',
    'accordion' => [
        '1' => [
            'title' => '1) Como uma Árvore de Decisão Aprende',
            'p1' => 'Uma árvore de decisão divide os dados recursivamente em regiões menores. Neste simulador, cada split é alinhado aos eixos e usa x ou y com um limiar.',
            'p2' => 'Cada nó interno faz uma regra como x <= 22. Folhas retornam probabilidades de classe e um rótulo final.',
        ],
        '2' => [
            'title' => '2) Qualidade do Split: Impureza de Gini',
            'p1' => 'Para proporções de classe p_k, a impureza de Gini é:',
            'equation' => '$$ G = 1 - \\sum_k p_k^2 $$',
            'p2' => 'O modelo testa splits candidatos e escolhe o que minimiza a impureza ponderada dos nós filhos.',
        ],
        '3' => [
            'title' => '3) Critérios de Parada e Generalização',
            'li1' => 'Profundidade máxima limita a complexidade da árvore.',
            'li2' => 'Mínimo de amostras evita micro-splits instáveis.',
            'li3' => 'Folhas puras (uma única classe) param naturalmente.',
            'p1' => 'Árvores rasas geralmente generalizam melhor, enquanto árvores profundas podem superajustar ruído local.',
        ],
        '4' => [
            'title' => '4) Fluxo de Trabalho Sugerido',
            'step1' => 'Adicione pontos para classe A e classe B, ou carregue um padrão demo.',
            'step2' => 'Treine com diferentes configurações de profundidade máxima / mín. amostras.',
            'step3' => 'Observe fronteiras de região, regras em texto e logs de split.',
            'step4' => 'Compare árvores simples vs complexas quanto à interpretabilidade e qualidade de ajuste.',
        ],
    ],
    'controls' => [
        'class_a' => 'Classe A',
        'class_b' => 'Classe B',
        'train' => 'Treinar',
        'clear' => 'Limpar',
        'demo' => [
            'random_clusters' => 'Clusters Mistos Aleatórios',
            'concentric' => 'Concêntrico (Centro vs Anel)',
            'xor' => 'Padrão XOR',
            'overlap' => 'Clusters Sobrepostos',
        ],
        'load_demo' => 'Carregar Demo',
        'max_depth' => 'Profundidade Máx.:',
        'min_samples' => 'Mín. Amostras:',
        'show_regions' => 'Mostrar Regiões',
        'hint' => 'Clique no canvas para adicionar amostras nas células da grade e treine para gerar regras e regiões.',
    ],
    'model' => [
        'title' => 'Info do Modelo',
        'points' => 'Pontos:',
        'last_split' => 'Última Pontuação do Split:',
        'points_a' => 'Pontos A',
        'points_b' => 'Pontos B',
    ],
    'tree_title' => 'Árvore de Decisão (Texto)',
    'calc_title' => 'Log de Cálculo de Split',
];
