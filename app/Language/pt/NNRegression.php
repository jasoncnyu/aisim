<?php

return [
    'title' => 'Laboratório de regressão neural não linear',
    'subtitle' => 'Ajuste curvas não lineares com um MLP e observe a divergência treino/val em sobreajuste.',
    'accordion' => [
        '1' => [
            'title' => '1) Formulação do modelo',
            'p1' => 'Ao contrário da regressão linear y=ax+b, este laboratório usa camadas ocultas para aprender mapeamentos não lineares x → y.',
            'equation' => '$$\\hat{y}=W_L\\,\\phi(W_{L-1}\\phi(\\cdots\\phi(W_1x+b_1)\\cdots)+b_{L-1})+b_L$$',
            'p2' => 'Escolha profundidade, largura e ativação para controlar a capacidade.',
        ],
        '2' => [
            'title' => '2) Perda e sinal de overfitting',
            'p1' => 'O objetivo é o MSE no subconjunto de treino:',
            'equation' => '$$\\text{MSE}=\\frac{1}{n}\\sum_{i=1}^{n}(y_i-\\hat{y}_i)^2$$',
            'p2' => 'Overfitting ocorre quando a perda de treino cai e a de validação estagna ou sobe.',
        ],
    ],
    'controls' => [
        'add_point' => 'Adicionar ponto',
        'test_mode' => 'Modo de teste',
        'clear' => 'Limpar',
        'demo' => [
            'sine' => 'Curva seno',
            'cubic' => 'Curva cúbica',
            'piecewise' => 'Curva por partes',
        ],
        'load_demo' => 'Carregar demo',
        'hint' => 'Clique para adicionar amostras. No modo de teste, clique em x para ver y prevista e resíduo.',
    ],
    'params' => [
        'hidden_layers' => 'Camadas ocultas',
        'units_per_layer' => 'Unidades / camada',
        'activation' => 'Ativação',
        'val_ratio' => 'Taxa de validação',
        'lr' => 'LR',
        'batch' => 'Batch',
        'epochs' => 'Épocas',
        'l2_reg' => 'L2 Reg',
        'init_model' => 'Inicializar modelo',
    ],
    'actions' => [
        'step' => 'Passo',
        'run' => 'Executar',
        'stop' => 'Parar',
    ],
    'status' => [
        'title' => 'Status de treino',
        'points' => 'Pontos:',
        'train_val' => 'Treino / Val:',
        'epoch' => 'Época:',
        'train_loss' => 'Perda treino:',
        'val_loss' => 'Perda val:',
    ],
    'interpretation' => [
        'title' => 'Interpretação',
        'li1' => 'Pontos azuis: treino; laranja: validação.',
        'li2' => 'Marcador amarelo no modo de teste: saída prevista em x.',
        'li3' => 'Se treino cai e validação sobe, a capacidade é alta ou o treino é longo.',
        'li4' => 'Tente L2 maior ou camadas menores para reduzir overfitting.',
    ],
];

