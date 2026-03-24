<?php

return [
    'title' => 'Laboratorio CNN binario',
    'subtitle' => 'CNN pequena para clasificacion de dos clases con visualizacion de filtros y mapas de caracteristicas.',
    'accordion' => [
        '1' => [
            'title' => '1) Arquitectura del modelo',
            'p1' => 'Esta pagina entrena una CNN compacta: Conv(3x3) -> ReLU -> Flatten -> Dense -> ReLU -> Dense -> Softmax.',
            'p2' => 'Las imagenes se convierten a escala de grises y se redimensionan a 32x32.',
            'p3' => 'Las etiquetas binarias se mapean a probabilidades de clase 1 y clase 2.',
        ],
        '2' => [
            'title' => '2) Objetivo de aprendizaje',
            'p1' => 'La red se optimiza con entropia cruzada en dos clases:',
            'equation' => '$$ L = -\\frac{1}{N}\\sum_{i=1}^{N}\\sum_{c=1}^{2} y_{ic}\\log(\\hat{y}_{ic}) $$',
            'p2' => 'Usa LR baja para estabilidad o LR alta para rapidez con mas ruido.',
        ],
        '3' => [
            'title' => '3) Flujo sugerido',
            'step1' => 'Carga imagenes demo de gato/perro o sube archivos personalizados.',
            'step2' => 'Inicializa pesos, corre epocas y monitorea perdida y precision.',
            'step3' => 'Revisa filtros y mapas para entender la primera conv.',
            'step4' => 'Sube una imagen de prueba y revisa probabilidades.',
        ],
    ],
    'controls' => [
        'load_demo' => 'Cargar datos demo',
        'init_weights' => 'Inicializar pesos',
        'step' => 'Paso (1 epoca)',
        'run' => 'Ejecutar',
        'stop' => 'Detener',
        'reset' => 'Reiniciar',
        'lr' => 'LR:',
        'epochs' => 'Epocas:',
        'batch' => 'Batch:',
    ],
    'metrics' => [
        'dataset' => 'Dataset:',
        'epoch' => 'Epoca:',
        'loss' => 'Perdida:',
        'accuracy' => 'Precision:',
    ],
    'training_images_title' => 'Imagenes de entrenamiento',
    'class1_label' => 'Clase 1 (label 0)',
    'class2_label' => 'Clase 2 (label 1)',
    'upload_hint' => 'Las imagenes se redimensionan a 32x32 en grises antes de entrenar.',
    'loading_images' => 'Cargando imagenes...',
    'conv_filters_title' => 'Filtros conv (tiempo real)',
    'prediction_title' => 'Prediccion',
    'predict_button' => 'Predecir imagen subida',
    'feature_maps_title' => 'Mapas de caracteristicas (capa conv)',
];
