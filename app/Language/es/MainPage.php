<?php

return [
    'pageTitle' => 'Inicio',
    'tagline' => 'AI Simulator',
    'title' => 'Un Laboratorio Visual para Aprender IA',
    'description' => 'AI Simulator convierte matemáticas abstractas en experimentos interactivos. Desarrolla intuición entrenando modelos en tiempo real, observando curvas de pérdida y viendo cómo cambian las decisiones al ajustar parámetros.',
    'labels' => [
        'interactive_labs' => 'Laboratorios Interactivos',
        'live_training' => 'Entrenamiento en Vivo',
        'explainable_visuals' => 'Visuales Explicables',
        'guided_experiments' => 'Experimentos Guiados',
    ],
    'cta' => [
        'start_learning' => 'Comenzar a Aprender',
        'try_cnn_mnist' => 'Probar CNN MNIST',
    ],
    
    // How to Use Section
    'howToUse' => [
        'title' => 'Cómo Usar Esta Plataforma',
        'subtitle' => 'Un camino corto desde la curiosidad hacia la intuición confiada.',
        'steps' => [
            [
                'number' => '1',
                'label' => 'Paso',
                'title' => 'Elige un laboratorio',
                'description' => 'Elige un laboratorio y lee el concepto introductorio en la parte superior. Te dice qué intenta aprender el modelo.',
            ],
            [
                'number' => '2',
                'label' => 'Paso',
                'title' => 'Crea datos',
                'description' => 'Crea datos haciendo clic, cargando demostraciones o usando imágenes de muestra. La forma de los datos es lo principal.',
            ],
            [
                'number' => '3',
                'label' => 'Paso',
                'title' => 'Entrena y observa',
                'description' => 'Entrena y observa con paso o ejecución automática, luego mira la curva de pérdida y el comportamiento del modelo evolucionar.',
            ],
            [
                'number' => '4',
                'label' => 'Paso',
                'title' => 'Compara y reflexiona',
                'description' => 'Compara y reflexiona cambiando hiperparámetros o tipo de modelo para ver sesgo, varianza y sobreajuste.',
            ],
        ],
    ],
    
    // Learning Tracks Section
    'learningTracks' => [
        'title' => 'Caminos de Aprendizaje Principales',
        'machinelearning' => [
            'title' => 'Machine Learning',
            'description' => 'Comienza aquí para entender cómo los modelos aprenden de los datos. Verás cómo una curva simple se adapta a puntos, cómo los clasificadores dibujan límites y por qué la capacidad del modelo importa. Este camino se trata de construir intuición para funciones de pérdida, gradientes y geometría de datos.',
            'question' => '¿Úsalo para responder: ¿Por qué un modelo hace bajo ajuste o sobreajuste? ¿Cómo la distribución de datos reformula un límite de decisión?',
        ],
        'deeplearning' => [
            'title' => 'Deep Learning',
            'description' => 'Este camino escala la intuición de curvas a redes. Observa cómo las neuronas transforman entradas en representaciones, luego ve cómo los filtros convolucionales extraen características visuales. El enfoque está en cómo la profundidad y la no linealidad cambian lo que puede expresar un modelo.',
            'question' => '¿Úsalo para responder: ¿Cómo una CNN aprende bordes? ¿Por qué un modelo neuronal hace sobreajuste mientras la pérdida sigue mejorando?',
        ],
    ],
];
