<?php

return [
    'title' => 'Laboratorio de K-Nearest Neighbors',
    'subtitle' => 'Clasificacion basada en instancias con regiones de decision interactivas, inspeccion de vecinos y votacion ponderada.',
    'accordion' => [
        '1' => [
            'title' => '1) Idea central de K-NN',
            'p1' => 'K-NN no aprende parametros globales. Predice usando las etiquetas de puntos de entrenamiento cercanos en el espacio de caracteristicas.',
            'p2' => 'Para un punto de consulta x, selecciona las K muestras mas cercanas y agrega sus etiquetas por voto mayoritario (o ponderado).',
            'equation' => '$$\\hat{y}(x)=\\arg\\max_c \\sum_{i\\in \\mathcal{N}_K(x)} w_i\\,\\mathbf{1}(y_i=c)$$',
        ],
        '2' => [
            'title' => '2) Efecto de K y ponderacion por distancia',
            'li1' => 'K pequeno: frontera muy flexible, sensible al ruido local.',
            'li2' => 'K grande: frontera mas suave, menor varianza, mayor sesgo potencial.',
            'li3' => 'Votacion ponderada (w=1/d) da mas influencia a vecinos muy cercanos.',
        ],
        '3' => [
            'title' => '3) Notas practicas',
            'p1' => 'Como K-NN depende de la distancia, el escalado de caracteristicas es critico. La estandarizacion suele mejorar la fiabilidad.',
            'p2' => 'El coste de prediccion crece con el tamano del conjunto, ya que hay que calcular distancias contra muchas muestras.',
            'p3' => 'Usa validacion para elegir K y evaluar robustez con clases ruidosas o solapadas.',
        ],
        '4' => [
            'title' => '4) Flujo de trabajo sugerido',
            'step1' => 'Carga una distribucion de demo (vertical, XOR, concentrica, solapada, aleatoria).',
            'step2' => 'Ajusta K y activa la votacion ponderada para comparar fronteras de decision.',
            'step3' => 'Activa el Modo de prueba y haz clic para inspeccionar vecinos y probabilidad de clase.',
            'step4' => 'Aumenta la densidad de region para ver mas detalle y luego bajala para renderizar mas rapido.',
        ],
    ],
    'controls' => [
        'class_a' => 'Clase A',
        'class_b' => 'Clase B',
        'test_mode' => 'Modo de prueba',
        'k_label' => 'K:',
        'weighted' => 'Ponderado (1/d)',
        'region_density' => 'Densidad de region:',
        'demo' => [
            'vertical' => 'Mixto vertical',
            'xor' => 'XOR (4 clusteres)',
            'concentric' => 'Concentrico (centro vs anillo)',
            'overlap' => 'Solapado (dificil)',
            'random' => 'Clusteres aleatorios',
        ],
        'load_demo' => 'Cargar demo',
        'refresh' => 'Actualizar',
        'clear' => 'Limpiar',
        'hint' => 'Haz clic para agregar muestras. En Modo de prueba, haz clic para clasificar un punto y ver sus vecinos mas cercanos.',
    ],
    'model' => [
        'title' => 'Informacion del modelo',
        'points' => 'Puntos:',
        'last_prob' => 'Ultima P(B):',
    ],
    'neighbors_title' => 'Vecinos mas cercanos',
];
