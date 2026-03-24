<?php

return [
    'title' => 'Laboratorio de clustering K-Means',
    'subtitle' => 'Simulador interactivo 2D con regiones de Voronoi, actualizacion de centroides y seguimiento de inercia.',
    'accordion' => [
        '1' => [
            'title' => '1) Que optimiza K-Means',
            'p1' => 'K-Means divide los datos en K clusteres minimizando la distancia cuadratica intra?cluster (inercia).',
            'equation' => '$$ J = \\sum_{i=1}^{N} \\min_{1 \\leq j \\leq K} \\left\\lVert x_i - \\mu_j \\right\\rVert^2 $$',
            'p2' => 'Cada muestra se asigna al centroide mas cercano y luego los centroides se recalculan como la media de las muestras asignadas.',
        ],
        '2' => [
            'title' => '2) Iteracion de Lloyd (asignar y luego actualizar)',
            'p1' => 'El algoritmo alterna entre dos pasos deterministas:',
            'equation1' => '$$ c_i \\leftarrow \\arg\\min_j \\lVert x_i - \\mu_j \\rVert^2 $$',
            'equation2' => '$$ \\mu_j \\leftarrow \\frac{1}{|C_j|}\\sum_{x_i \\in C_j} x_i $$',
            'p2' => 'La inercia disminuye de forma monotona hasta converger a un optimo local.',
        ],
        '3' => [
            'title' => '3) Por que importa la inicializacion',
            'p1' => 'La inicializacion aleatoria es simple pero puede empezar con malas semillas.',
            'p2' => 'k-means++ separa los centroides iniciales y suele converger mas rapido con menor inercia final.',
            'p3' => 'Usa multiples ejecuciones con distintas semillas para reducir la sensibilidad a minimos locales.',
        ],
        '4' => [
            'title' => '4) Flujo de experimento sugerido',
            'step1' => 'Carga puntos de demo y compara Random vs k-means++.',
            'step2' => 'Prueba distintos valores de K y observa fronteras y conteos de clusteres.',
            'step3' => 'Usa Paso para inspeccionar un ciclo de asignar/actualizar.',
            'step4' => 'Ejecuta hasta convergencia y compara la inercia final entre configuraciones.',
        ],
    ],
    'controls' => [
        'k_label' => 'K:',
        'init_label' => 'Init:',
        'init_random' => 'Aleatorio',
        'init_plus' => 'k-means++',
        'region_density' => 'Densidad de region:',
        'load_demo' => 'Cargar demo',
        'init_centroids' => 'Inicializar centroides',
        'step' => 'Paso',
        'run' => 'Ejecutar',
        'stop' => 'Detener',
        'clear' => 'Limpiar',
        'hint' => 'Haz clic en el lienzo para anadir puntos. Manten pulsado en pantallas tactiles o clic derecho para eliminar el punto mas cercano.',
    ],
    'status' => [
        'title' => 'Estado',
        'points' => 'Puntos:',
        'k' => 'K:',
        'iteration' => 'Iteracion:',
        'inertia' => 'Inercia:',
        'shift' => 'Desplazamiento del centroide:',
    ],
    'inertia_title' => 'Curva de inercia',
    'summary_title' => 'Resumen de clusteres',
];
