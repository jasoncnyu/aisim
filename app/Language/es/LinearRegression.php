<?php

return [
    'title' => 'Visualizacion de regresion lineal',
    'subtitle' => 'Simulacion interactiva para OLS, GD y SGD.',
    'accordion' => [
        '1' => [
            'title' => '1) Que resuelve la regresion lineal',
            'p1' => 'La regresion lineal estima una relacion de linea recta entre una entrada x y una salida y.',
            'equation' => 'y = ax + b',
            'p2' => 'Aqui, a es la pendiente y b es el intercepto. En este simulador, cada punto que agregas es una muestra de entrenamiento y el modelo encuentra los mejores a y b.',
        ],
        '2' => [
            'title' => '2) Funcion de error y por que se usa MSE',
            'p1' => 'El modelo minimiza el error cuadratico medio (MSE):',
            'equation' => '$$ MSE(a,b) = \\frac{1}{n}\\sum_{i=1}^{n}(y_i-(ax_i+b))^2 $$',
            'p2' => 'Elevar al cuadrado penaliza mas los errores grandes y ofrece un objetivo suave. Menor perdida significa mejor ajuste.',
        ],
        '3' => [
            'title' => '3) OLS vs GD vs SGD',
            'ols' => 'Formula cerrada y de una sola vez.',
            'gd' => 'Usa todas las muestras por epoca, estable pero mas pesado.',
            'sgd' => 'Usa actualizaciones de una sola muestra barajada, mas rapido pero mas ruidoso.',
            'p1' => 'Usa los mismos puntos y compara las curvas de aprendizaje de cada metodo.',
        ],
        '4' => [
            'title' => '4) Flujo de aprendizaje sugerido',
            'step1' => 'Agrega puntos o carga datos de demostracion.',
            'step2' => 'Ejecuta OLS primero para obtener una linea base.',
            'step3' => 'Cambia a GD/SGD y ajusta la tasa de aprendizaje y las epocas.',
            'step4' => 'Usa el Modo de prueba para inspeccionar valores reales vs predichos.',
        ],
    ],
    'controls' => [
        'add_point' => 'Agregar punto',
        'clear_points' => 'Borrar puntos',
        'load_demo' => 'Cargar datos de demo',
        'hint' => 'Haz clic para agregar puntos. Manten presionado un punto para eliminarlo.',
        'method' => 'Metodo de regresion',
        'method_ols' => 'OLS',
        'method_gd' => 'Descenso de gradiente por lotes',
        'method_sgd' => 'Descenso de gradiente estocastico',
        'learning_rate' => 'Tasa de aprendizaje',
        'epochs' => 'Epocas',
        'step_train' => 'Entrenamiento paso a paso',
        'auto_train' => 'Entrenamiento automatico',
        'test_mode' => 'Modo de prueba',
    ],
    'loss_title' => 'Perdida (MSE)',
    'model' => [
        'title' => 'Modelo',
        'points' => 'Puntos:',
        'slope' => 'Pendiente (a):',
        'intercept' => 'Intercepto (b):',
        'r2' => 'R2:',
        'last_loss' => 'Ultima perdida:',
    ],
    'notes' => [
        'title' => 'Notas del metodo',
        'ols' => [
            'title' => 'OLS',
            'desc' => 'Solucion en forma cerrada a partir de covarianza y varianza:',
            'formula' => '$$ a = \\frac{\\sum (x_i-\\bar{x})(y_i-\\bar{y})}{\\sum (x_i-\\bar{x})^2}, \\quad b = \\bar{y} - a\\bar{x} $$',
        ],
        'gd' => [
            'title' => 'Batch GD',
            'desc' => 'Actualiza usando gradientes sobre todo el conjunto de datos:',
            'formula' => '$$ a \\leftarrow a - \\eta \\frac{\\partial MSE}{\\partial a}, \\quad b \\leftarrow b - \\eta \\frac{\\partial MSE}{\\partial b} $$',
        ],
        'sgd' => [
            'title' => 'SGD',
            'desc' => 'Actualizaciones por muestra con puntos mezclados:',
            'formula' => '$$ a \\leftarrow a - \\eta \\cdot 2(ax_j+b-y_j)x_j, \\quad b \\leftarrow b - \\eta \\cdot 2(ax_j+b-y_j) $$',
        ],
    ],
];
