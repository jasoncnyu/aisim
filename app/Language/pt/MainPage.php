<?php

return [
    'pageTitle' => 'Início',
    'tagline' => 'AI Simulator',
    'title' => 'Um Laboratório Visual para Aprender IA',
    'description' => 'AI Simulator transforma matemática abstrata em experimentos interativos. Desenvolva intuição treinando modelos em tempo real, observando curvas de perda se moverem e vendo como as decisões mudam quando você ajusta parâmetros.',
    'labels' => [
        'interactive_labs' => 'Laboratórios Interativos',
        'live_training' => 'Treinamento ao Vivo',
        'explainable_visuals' => 'Visuais Explicáveis',
        'guided_experiments' => 'Experimentos Guiados',
    ],
    'cta' => [
        'start_learning' => 'Começar a Aprender',
        'try_cnn_mnist' => 'Tente CNN MNIST',
    ],
    
    // How to Use Section
    'howToUse' => [
        'title' => 'Como Usar Esta Plataforma',
        'subtitle' => 'Um caminho curto da curiosidade para a intuição confiante.',
        'steps' => [
            [
                'number' => '1',
                'label' => 'Passo',
                'title' => 'Escolha um laboratório',
                'description' => 'Escolha um laboratório e leia o conceito introdutório no topo. Ele diz o que o modelo está tentando aprender.',
            ],
            [
                'number' => '2',
                'label' => 'Passo',
                'title' => 'Crie dados',
                'description' => 'Crie dados clicando, carregando demos ou usando imagens de exemplo. A forma dos dados guia tudo.',
            ],
            [
                'number' => '3',
                'label' => 'Passo',
                'title' => 'Treine e observe',
                'description' => 'Treine e observe com passo ou execução automática e veja a curva de perda e o comportamento do modelo evoluírem.',
            ],
            [
                'number' => '4',
                'label' => 'Passo',
                'title' => 'Compare e reflita',
                'description' => 'Compare e reflita mudando hiperparâmetros ou tipo de modelo para ver viés, variância e sobreajuste.',
            ],
        ],
    ],
    
    // Learning Tracks Section
    'learningTracks' => [
        'title' => 'Faixas de Aprendizagem Principais',
        'machinelearning' => [
            'title' => 'Machine Learning',
            'description' => 'Comece aqui para entender como os modelos aprendem com dados. Você verá como uma curva simples se ajusta aos pontos, como classificadores desenham limites e por que a capacidade do modelo importa. Esta faixa é sobre construir intuição para funções de perda, gradientes e geometria de dados.',
            'question' => 'Use-o para responder: Por que um modelo fica subajustado ou sobreajustado? Como a distribuição de dados reformula um limite de decisão?',
            'labs' => [
                'Regressão Linear',
                'Regressão Logística',
                'Árvore de Decisão',
                'K-Means',
                'K-NN',
                'SVM',
            ],
        ],
        'deeplearning' => [
            'title' => 'Deep Learning',
            'description' => 'Esta faixa escala a intuição de curvas para redes. Observe como os neurônios transformam entradas em representações, depois veja como os filtros convolucionais extraem características visuais. O foco está em como a profundidade e a não linearidade mudam o que um modelo pode expressar.',
            'question' => 'Use-o para responder: Como uma CNN aprende bordas? Por que um modelo neural sobreajusta enquanto a perda continua melhorando?',
            'labs' => [
                'Regressão NN',
                'CNN Binary',
                'CNN MNIST',
                'Laboratório XOR',
                'Tiny Web LLM',
            ],
        ],
        'reinforcement' => [
            'title' => 'Aprendizado por Reforço',
            'description' => 'Aqui o modelo é um agente que aprende com recompensas em vez de exemplos rotulados. Você vai explorar exploração vs. aproveitamento, recompensas esparsas e o papel da dinâmica do ambiente.',
            'question' => 'Use para responder: Quando é melhor explorar? Como a estrutura de recompensas molda o comportamento?',
            'labs' => [
                'Bandido de N braços',
                'Mundo em grade',
            ],
        ],
    ],
    'quickStart' => [
        'title' => 'Prompts de Início Rápido',
        'items' => [
            [
                'label' => 'Novo em ML?',
                'text' => 'Comece com Regressão Linear e Regressão Logística e depois compare com Árvores de Decisão.',
            ],
            [
                'label' => 'Curioso sobre curvas?',
                'text' => 'Use Regressão NN para ver como profundidade e largura mudam o ajuste.',
            ],
            [
                'label' => 'Quer intuição visual?',
                'text' => 'Vá para CNN MNIST e desenhe dígitos para testar a inferência.',
            ],
        ],
        'cta' => [
            'start_linear' => 'Começar com Regressão Linear',
            'explore_nn' => 'Explorar Regressão NN',
        ],
    ],
];
