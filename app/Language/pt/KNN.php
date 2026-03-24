<?php

return [
    'title' => 'Laboratório K-Nearest Neighbors',
    'subtitle' => 'Classificação baseada em instâncias com regiões de decisão interativas, inspeção de vizinhos e votação ponderada.',
    'accordion' => [
        '1' => [
            'title' => '1) Ideia Central do K-NN',
            'p1' => 'O K-NN não aprende parâmetros globais do modelo. Ele prevê usando os rótulos de pontos de treino próximos no espaço de atributos.',
            'p2' => 'Para um ponto de consulta x, selecione as K amostras mais próximas e agregue seus rótulos por maioria (ou votação ponderada).',
            'equation' => '$$\\hat{y}(x)=\\arg\\max_c \\sum_{i\\in \\mathcal{N}_K(x)} w_i\\,\\mathbf{1}(y_i=c)$$',
        ],
        '2' => [
            'title' => '2) Efeito de K e da Ponderação por Distância',
            'li1' => 'K pequeno: fronteira muito flexível, sensível a ruído local.',
            'li2' => 'K grande: fronteira mais suave, menor variância, possivelmente maior viés.',
            'li3' => 'Votação ponderada (w=1/d) dá mais influência a vizinhos muito próximos.',
        ],
        '3' => [
            'title' => '3) Observações Práticas',
            'p1' => 'Como o K-NN depende de distância, o escalonamento de atributos é crítico em dados reais. Padronização geralmente melhora a confiabilidade.',
            'p2' => 'O custo de predição cresce com o tamanho do dataset, pois as distâncias devem ser calculadas contra muitas amostras no momento da inferência.',
            'p3' => 'Use validação para escolher K e avaliar robustez sob distribuições ruidosas ou sobrepostas.',
        ],
        '4' => [
            'title' => '4) Fluxo de Trabalho Sugerido',
            'step1' => 'Carregue uma distribuição demo (vertical, XOR, concêntrica, sobreposição, aleatória).',
            'step2' => 'Ajuste K e alterne a votação ponderada para comparar fronteiras.',
            'step3' => 'Ative o Modo Teste e clique para inspecionar vizinhos mais próximos e probabilidade de classe.',
            'step4' => 'Aumente a densidade da região para ver mais detalhes e depois reduza para renderização mais rápida.',
        ],
    ],
    'controls' => [
        'class_a' => 'Classe A',
        'class_b' => 'Classe B',
        'test_mode' => 'Modo Teste',
        'k_label' => 'K:',
        'weighted' => 'Ponderado (1/d)',
        'region_density' => 'Densidade da Região:',
        'demo' => [
            'vertical' => 'Vertical Misturado',
            'xor' => 'XOR (4 Clusters)',
            'concentric' => 'Concêntrico (Centro vs Anel)',
            'overlap' => 'Sobreposição (Difícil)',
            'random' => 'Clusters Aleatórios',
        ],
        'load_demo' => 'Carregar Demo',
        'refresh' => 'Atualizar',
        'clear' => 'Limpar',
        'hint' => 'Clique para adicionar amostras de treino. No Modo Teste, clique para classificar um ponto e inspecionar os vizinhos.',
    ],
    'model' => [
        'title' => 'Info do Modelo',
        'points' => 'Pontos:',
        'last_prob' => 'Último Teste P(B):',
    ],
    'neighbors_title' => 'Vizinhos Mais Próximos',
];
