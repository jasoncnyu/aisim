<?php

return [
    'title' => 'Laboratório de Clusterização K-Means',
    'subtitle' => 'Simulador interativo 2D de clusterização com regiões de Voronoi, atualização de centróides e acompanhamento de inércia.',
    'accordion' => [
        '1' => [
            'title' => '1) O que o K-Means Otimiza',
            'p1' => 'O K-Means particiona os dados em K clusters minimizando a distância quadrática intra-cluster (inércia).',
            'equation' => '$$ J = \\sum_{i=1}^{N} \\min_{1 \\leq j \\leq K} \\left\\lVert x_i - \\mu_j \\right\\rVert^2 $$',
            'p2' => 'Cada amostra é atribuída ao centróide mais próximo e depois os centróides são recomputados como a média das amostras atribuídas.',
        ],
        '2' => [
            'title' => '2) Iteração de Lloyd (Atribuir e Atualizar)',
            'p1' => 'O algoritmo alterna entre dois passos determinísticos:',
            'equation1' => '$$ c_i \\leftarrow \\arg\\min_j \\lVert x_i - \\mu_j \\rVert^2 $$',
            'equation2' => '$$ \\mu_j \\leftarrow \\frac{1}{|C_j|}\\sum_{x_i \\in C_j} x_i $$',
            'p2' => 'A inércia diminui monotonicamente até convergir para um ótimo local.',
        ],
        '3' => [
            'title' => '3) Por que a Inicialização Importa',
            'p1' => 'Inicialização aleatória é simples, mas pode começar com sementes ruins.',
            'p2' => 'k-means++ distribui centróides iniciais, muitas vezes gerando convergência mais rápida e menor inércia final.',
            'p3' => 'Em produção, use múltiplas execuções com sementes diferentes para reduzir a sensibilidade a mínimos locais.',
        ],
        '4' => [
            'title' => '4) Fluxo de Experimento Sugerido',
            'step1' => 'Carregue pontos demo e compare inicialização Aleatória vs k-means++.',
            'step2' => 'Teste diferentes valores de K e inspecione fronteiras e contagens de clusters.',
            'step3' => 'Use Passo para ver um ciclo de atribuição/atualização por vez.',
            'step4' => 'Execute até a convergência e compare a inércia final entre configurações.',
        ],
    ],
    'controls' => [
        'k_label' => 'K:',
        'init_label' => 'Init:',
        'init_random' => 'Aleatório',
        'init_plus' => 'k-means++',
        'region_density' => 'Densidade da Região:',
        'load_demo' => 'Carregar Demo',
        'init_centroids' => 'Iniciar Centróides',
        'step' => 'Passo',
        'run' => 'Executar',
        'stop' => 'Parar',
        'clear' => 'Limpar',
        'hint' => 'Clique em qualquer lugar do canvas para adicionar pontos. Pressione e segure em dispositivos touch ou clique com o botão direito para remover o ponto mais próximo.',
    ],
    'status' => [
        'title' => 'Status',
        'points' => 'Pontos:',
        'k' => 'K:',
        'iteration' => 'Iteração:',
        'inertia' => 'Inércia:',
        'shift' => 'Deslocamento do Centróide:',
    ],
    'inertia_title' => 'Curva de Inércia',
    'summary_title' => 'Resumo dos Clusters',
];
