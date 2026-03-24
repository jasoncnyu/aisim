<?php

return [
    'title' => 'Laboratorio de regressao neural nao linear',
    'subtitle' => 'Ajuste curvas nao lineares com um MLP e observe a divergencia treino/val em sobreajuste.',
    'accordion' => [
        '1' => [
            'title' => '1) Formulacao do modelo',
            'p1' => 'Ao contrario da regressao linear y=ax+b, este laboratorio usa camadas ocultas para aprender mapeamentos nao lineares x ¡æ y.',
            'equation' => '$$\\hat{y}=W_L\\,\\phi(W_{L-1}\\phi(\\cdots\\phi(W_1x+b_1)\\cdots)+b_{L-1})+b_L$$',
            'p2' => 'Escolha profundidade, largura e ativacao para controlar a capacidade.',
        ],
        '2' => [
            'title' => '2) Perda e sinal de overfitting',
            'p1' => 'O objetivo e o MSE no subconjunto de treino:',
            'equation' => '$$\\text{MSE}=\\frac{1}{n}\\sum_{i=1}^{n}(y_i-\\hat{y}_i)^2$$',
            'p2' => 'Overfitting ocorre quando a perda de treino cai e a de validacao estagna ou sobe.',
        ],
    ],
    'controls' => [
        'add_point' => 'Adicionar ponto',
        'test_mode' => 'Modo de teste',
        'clear' => 'Limpar',
        'demo' => [
            'sine' => 'Curva seno',
            'cubic' => 'Curva cubica',
            'piecewise' => 'Curva por partes',
        ],
        'load_demo' => 'Carregar demo',
        'hint' => 'Clique para adicionar amostras. No modo de teste, clique em x para ver y prevista e residuo.',
    ],
    'params' => [
        'hidden_layers' => 'Camadas ocultas',
        'units_per_layer' => 'Unidades / camada',
        'activation' => 'Ativacao',
        'val_ratio' => 'Taxa de validacao',
        'lr' => 'LR',
        'batch' => 'Batch',
        'epochs' => 'Epocas',
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
        'epoch' => 'Epoca:',
        'train_loss' => 'Perda treino:',
        'val_loss' => 'Perda val:',
    ],
    'interpretation' => [
        'title' => 'Interpretacao',
        'li1' => 'Pontos azuis: treino; laranja: validacao.',
        'li2' => 'Marcador amarelo no modo de teste: saida prevista em x.',
        'li3' => 'Se treino cai e validacao sobe, a capacidade e alta ou o treino e longo.',
        'li4' => 'Tente L2 maior ou camadas menores para reduzir overfitting.',
    ],
];
