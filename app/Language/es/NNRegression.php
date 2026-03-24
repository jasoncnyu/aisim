<?php

return [
    'title' => 'Laboratorio de regresion neuronal no lineal',
    'subtitle' => 'Ajusta curvas no lineales con un perceptron multicapa y observa la divergencia train/val por sobreentrenamiento.',
    'accordion' => [
        '1' => [
            'title' => '1) Formulacion del modelo',
            'p1' => 'A diferencia de la regresion lineal y=ax+b, este laboratorio usa capas ocultas para aprender mapeos no lineales x ¡æ y.',
            'equation' => '$$\\hat{y}=W_L\\,\\phi(W_{L-1}\\phi(\\cdots\\phi(W_1x+b_1)\\cdots)+b_{L-1})+b_L$$',
            'p2' => 'Elige profundidad, ancho y activacion para controlar la capacidad.',
        ],
        '2' => [
            'title' => '2) Perdida y senal de sobreajuste',
            'p1' => 'El objetivo es el error cuadratico medio en el subconjunto de entrenamiento:',
            'equation' => '$$\\text{MSE}=\\frac{1}{n}\\sum_{i=1}^{n}(y_i-\\hat{y}_i)^2$$',
            'p2' => 'El sobreajuste aparece cuando la perdida de train baja pero la de validacion se estanca o sube.',
        ],
    ],
    'controls' => [
        'add_point' => 'Agregar punto',
        'test_mode' => 'Modo de prueba',
        'clear' => 'Limpiar',
        'demo' => [
            'sine' => 'Curva seno',
            'cubic' => 'Curva cubica',
            'piecewise' => 'Curva por tramos',
        ],
        'load_demo' => 'Cargar demo',
        'hint' => 'Haz clic para anadir muestras. En Modo de prueba, haz clic en x para ver y predicha y residuo.',
    ],
    'params' => [
        'hidden_layers' => 'Capas ocultas',
        'units_per_layer' => 'Unidades / capa',
        'activation' => 'Activacion',
        'val_ratio' => 'Ratio de validacion',
        'lr' => 'LR',
        'batch' => 'Batch',
        'epochs' => 'Epocas',
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
        'epoch' => 'Epoca:',
        'train_loss' => 'Perdida train:',
        'val_loss' => 'Perdida val:',
    ],
    'interpretation' => [
        'title' => 'Interpretacion',
        'li1' => 'Puntos azules: entrenamiento; naranjas: validacion.',
        'li2' => 'Marcador amarillo en Modo de prueba: salida predicha en x.',
        'li3' => 'Si baja train pero sube val, la capacidad es alta o el entrenamiento es largo.',
        'li4' => 'Prueba L2 mas fuerte o capas ocultas mas pequenas para reducir sobreajuste.',
    ],
];
