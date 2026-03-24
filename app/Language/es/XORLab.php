<?php

return [
    'title' => 'Laboratorio de red neuronal XOR',
    'subtitle' => 'Visualizacion de paso forward/backward para un MLP pequeno.',
    'accordion' => [
        '1' => [
            'title' => '1) Por que XOR es un demo clasico',
            'p1' => 'XOR no se resuelve con un separador lineal. El modelo debe aprender una superficie no lineal.',
            'p2' => 'Por eso XOR es el problema de juguete estandar para capas ocultas y activaciones no lineales.',
        ],
        '2' => [
            'title' => '2) Estructura de la red aqui',
            'p1' => 'El simulador usa un MLP compacto:',
            'structure' => 'Entrada(2) -> Oculta(4) -> Oculta(2) -> Salida(1)',
            'p2' => 'La salida usa sigmoid; la activacion oculta puede ser tanh o ReLU.',
        ],
        '3' => [
            'title' => '3) Dinamica de entrenamiento',
            'p1' => 'Cada paso toma un caso XOR, hace forward, calcula perdida y aplica backprop.',
            'equation1' => '$$ z^{(l)} = a^{(l-1)}W^{(l)} + b^{(l)}, \\quad a^{(l)} = f(z^{(l)}) $$',
            'equation2' => '$$ W \\leftarrow W - \\eta \\nabla_W L, \\quad b \\leftarrow b - \\eta \\nabla_b L $$',
        ],
        '4' => [
            'title' => '4) Como leer los visuales',
            'li1' => 'La curva de perdida muestra la convergencia por pasos.',
            'li2' => 'El panel de prediccion muestra la confianza en los cuatro inputs XOR.',
            'li3' => 'El panel de calculo registra los ultimos valores forward/backward.',
        ],
    ],
    'controls' => [
        'title' => 'Controles de entrenamiento',
        'learning_rate' => 'Tasa de aprendizaje',
        'sleep' => 'Espera (ms)',
        'activation' => 'Activacion',
        'step' => '+1 Paso',
        'auto_train' => 'Entrenar auto',
        'reset' => 'Reiniciar',
        'step_label' => 'Paso:',
        'loss_label' => 'Perdida:',
    ],
    'trace_title' => 'Traza forward/backward',
    'prediction_title' => 'Instantanea de prediccion',
    'prediction_hint' => 'Circulos mas grandes indican mayor probabilidad de clase 1.',
    'targets_title' => 'Objetivos XOR',
    'targets' => [
        'li1' => '(0,0) -> 0',
        'li2' => '(0,1) -> 1',
        'li3' => '(1,0) -> 1',
        'li4' => '(1,1) -> 0',
    ],
];
