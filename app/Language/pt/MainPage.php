<?php

return [
    'pageTitle' => 'Início',
    'tagline' => 'AI Simulator',
    'title' => 'Um Laboratório Visual para Aprender IA',
    'description' => 'AI Simulator transforma matemática abstrata em experimentos interactivos. Desenvolva intuição treinando modelos em tempo real, observando curvas de perda se movimentarem e vendo como as decisões mudam quando você ajusta parâmetros.',
    'labels' => [
        'interactive_labs' => 'Laboratórios Interactivos',
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
                'description' => 'Escolha um laboratório e leia a cartilha de conceitos no topo. Diz o que o modelo está tentando aprender.',
            ],
            [
                'number' => '2',
                'label' => 'Passo',
                'title' => 'Crie dados',
                'description' => 'Crie dados clicando, carregando demonstrações ou usando imagens de exemplo. A forma dos dados impulsiona tudo.',
            ],
            [
                'number' => '3',
                'label' => 'Passo',
                'title' => 'Treinar e observar',
                'description' => 'Treine e observe com passo ou execução automática, depois observe a curva de perda e o comportamento do modelo evoluir.',
            ],
            [
                'number' => '4',
                'label' => 'Passo',
                'title' => 'Comparar e refletir',
                'description' => 'Compare e reflita alterando hiperparâmetros ou tipo de modelo para ver viés, variância e sobreajuste.',
            ],
        ],
    ],
    
    // Learning Tracks Section
    'learningTracks' => [
        'title' => 'Faixas de Aprendizagem Principais',
        'machinelearning' => [
            'title' => 'Machine Learning',
            'description' => 'Comece aqui para entender como os modelos aprendem com dados. Você verá como uma curva simples se ajusta aos pontos, como classificadores desenham limites e por que a capacidade do modelo é importante. Esta faixa é sobre construir intuição para funções de perda, gradientes e geometria de dados.',
            'question' => 'Use-o para responder: Por que um modelo fica abaixo ou acima do ajuste? Como a distribuição de dados reformula um limite de decisão?',
            'reinforcement' => [
            'title' => 'Aprendizado por Refor?o',
            'description' => 'Aqui o modelo ? um agente que aprende com recompensas em vez de exemplos rotulados. Voc? vai explorar explora??o vs. aproveitamento, recompensas esparsas e o papel da din?mica do ambiente.',
            'question' => 'Use para responder: Quando ? melhor explorar? Como a estrutura de recompensas molda o comportamento?',
            'labs' => [
                'Bandido de N bra?os',
                'Mundo em grade',
            ],
        ],
    ],
        'deeplearning' => [
            'title' => 'Deep Learning',
            'description' => 'Esta faixa escala a intuição de curvas para redes. Observe como os neurônios transformam entradas em representações, depois veja como os filtros convolucionais extraem características visuais. O foco está em como a profundidade e a não linearidade mudam o que um modelo pode expressar.',
            'question' => 'Use-o para responder: Como uma CNN aprende bordas? Por que um modelo neural fica acima do ajuste enquanto a perda continua melhorando?',

            'labs' => [
                'Regress?o NN',
                'CNN Binary',
                'CNN MNIST',
                'Laborat?rio XOR',
                'Tiny Web LLM',
            ],
        ],
    ],
    'quickStart' => [
        'title' => 'Prompts de In?cio R?pido',
        'items' => [
            [
                'label' => 'Novo em ML?',
                'text' => 'Comece com Regress?o Linear e Regress?o Log?stica e depois compare com ?rvores de Decis?o.',
            ],
            [
                'label' => 'Curioso sobre curvas?',
                'text' => 'Use Regress?o NN para ver como profundidade e largura mudam o ajuste.',
            ],
            [
                'label' => 'Quer intui??o visual?',
                'text' => 'V? para CNN MNIST e desenhe d?gitos para testar a infer?ncia.',
            ],
        ],
        'cta' => [
            'start_linear' => 'Come?ar com Regress?o Linear',
            'explore_nn' => 'Explorar Regress?o NN',
        ],
    ],
];
