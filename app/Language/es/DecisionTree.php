<?php

return [
    'title' => 'Laboratorio visual de arboles de decision',
    'subtitle' => 'Simulador interactivo de particiones alineadas a ejes para clasificacion binaria.',
    'accordion' => [
        '1' => [
            'title' => '1) Como aprende un arbol de decision',
            'p1' => 'Un arbol de decision divide los datos de forma recursiva en regiones. Aqui cada division es alineada a ejes y usa x o y con un umbral.',
            'p2' => 'Cada nodo interno plantea una regla como x <= 22. Las hojas producen probabilidades y una etiqueta final.',
        ],
        '2' => [
            'title' => '2) Calidad del split: impureza Gini',
            'p1' => 'Para proporciones de clase p_k, la impureza Gini es:',
            'equation' => '$$ G = 1 - \\sum_k p_k^2 $$',
            'p2' => 'El modelo prueba divisiones candidatas y elige la que minimiza la impureza ponderada de los hijos.',
        ],
        '3' => [
            'title' => '3) Criterios de parada y generalizacion',
            'li1' => 'Profundidad maxima limita la complejidad del arbol.',
            'li2' => 'Minimo de muestras evita micro?divisiones inestables.',
            'li3' => 'Hojas puras (una sola clase) se detienen naturalmente.',
            'p1' => 'Arboles mas someros suelen generalizar mejor; arboles mas profundos pueden sobreajustar.',
        ],
        '4' => [
            'title' => '4) Flujo de trabajo sugerido',
            'step1' => 'Agrega puntos de clase A y B, o carga un patron de demo.',
            'step2' => 'Entrena con distintos valores de profundidad maxima / minimo de muestras.',
            'step3' => 'Observa fronteras, reglas textuales y registros de split.',
            'step4' => 'Compara arboles simples vs complejos en interpretabilidad y calidad de ajuste.',
        ],
    ],
    'controls' => [
        'class_a' => 'Clase A',
        'class_b' => 'Clase B',
        'train' => 'Entrenar',
        'clear' => 'Limpiar',
        'demo' => [
            'random_clusters' => 'Clusteres mixtos aleatorios',
            'concentric' => 'Concentrico (centro vs anillo)',
            'xor' => 'Patron XOR',
            'overlap' => 'Clusteres solapados',
        ],
        'load_demo' => 'Cargar demo',
        'max_depth' => 'Profundidad max.:',
        'min_samples' => 'Min. muestras:',
        'show_regions' => 'Mostrar regiones',
        'hint' => 'Haz clic en el lienzo para anadir muestras en celdas y luego entrena para generar reglas y regiones.',
    ],
    'model' => [
        'title' => 'Informacion del modelo',
        'points' => 'Puntos:',
        'last_split' => 'Ultima puntuacion de split:',
        'points_a' => 'Puntos A',
        'points_b' => 'Puntos B',
    ],
    'tree_title' => 'Arbol de decision (texto)',
    'calc_title' => 'Registro de calculo de splits',
];
