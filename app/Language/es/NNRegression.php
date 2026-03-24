<?php

return [
    'title' => 'Laboratorio de regresión neuronal no lineal',
    'subtitle' => 'Ajusta curvas no lineales con un perceptrón multicapa y observa la divergencia train/val por sobreentrenamiento.',
    'accordion' => [
        '1' => [
            'title' => '1) Formulación del modelo',
            'p1' => 'A diferencia de la regresión lineal y=ax+b, este laboratorio usa capas ocultas para aprender mapeos no lineales x → y.',
            'equation' => '$$\\hat{y}=W_L\\,\\phi(W_{L-1}\\phi(\\cdots\\phi(W_1x+b_1)\\cdots)+b_{L-1})+b_L$$',
            'p2' => 'Elige profundidad, ancho y activación para controlar la capacidad.',
        ],
        '2' => [
            'title' => '2) Pérdida y señal de sobreajuste',
            'p1' => 'El objetivo es el error cuadrático medio en el subconjunto de entrenamiento:',
            'equation' => '$$\\text{MSE}=\\frac{1}{n}\\sum_{i=1}^{n}(y_i-\\hat{y}_i)^2$$',
            'p2' => 'El sobreajuste aparece cuando la pérdida de train baja pero la de validación se estanca o sube.',
        ],
    ],
    'controls' => [
        'add_point' => 'Agregar punto',
        'test_mode' => 'Modo de prueba',
        'clear' => 'Limpiar',
        'demo' => [
            'sine' => 'Curva seno',
            'cubic' => 'Curva cúbica',
            'piecewise' => 'Curva por tramos',
        ],
        'load_demo' => 'Cargar demo',
        'hint' => 'Haz clic para añadir muestras. En Modo de prueba, haz clic en x para ver y predicha y residuo.',
    ],
    'params' => [
        'hidden_layers' => 'Capas ocultas',
        'units_per_layer' => 'Unidades / capa',
        'activation' => 'Activación',
        'val_ratio' => 'Ratio de validación',
        'lr' => 'LR',
        'batch' => 'Batch',
        'epochs' => 'Épocas',
        'l2_reg' => 'L2 Reg',
        'init_model' => 'Inicializar modelo',
    ],
    'actions' => [
        'step' => 'Paso',
        'run' => 'Ejecutar',
        'stop' => 'Detener',
    ],
    'status' => [
        'title' => 'Estado de entrenamiento',
        'points' => 'Puntos:',
        'train_val' => 'Train / Val:',
        'epoch' => 'Época:',
        'train_loss' => 'Pérdida train:',
        'val_loss' => 'Pérdida val:',
    ],
    'interpretation' => [
        'title' => 'Interpretación',
        'li1' => 'Puntos azules: entrenamiento; naranjas: validación.',
        'li2' => 'Marcador amarillo en Modo de prueba: salida predicha en x.',
        'li3' => 'Si baja train pero sube val, la capacidad es alta o el entrenamiento es largo.',
        'li4' => 'Prueba L2 más fuerte o capas ocultas más pequeñas para reducir sobreajuste.',
    ],
];

