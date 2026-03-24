<?php

return [
    'title' => 'Laboratorio de Cuantización',
    'subtitle' => 'Comprime pesos a formatos de pocos bits y visualiza el trade-off de precisión.',
    'accordion' => [
        '1' => [
            'title' => '1) Por qué importa la cuantización',
            'p1' => 'Los modelos modernos son grandes y pesados en memoria. La cuantización reduce cada peso de float32 a menos bits (8, 4 o incluso 1), reduciendo tamaño y acelerando inferencia.',
            'p2' => 'El trade-off clave es precisión vs eficiencia. Con buena calibración, modelos de pocos bits conservan gran parte del rendimiento.',
        ],
        '2' => [
            'title' => '2) Modos de cuantización',
            'li1_label' => 'Uniforme simétrica',
            'li1' => 'escala los pesos alrededor de cero; simple y amigable al hardware.',
            'li2_label' => 'Uniforme asimétrica',
            'li2' => 'desplaza el rango para ajustar distribuciones no centradas en cero.',
            'li3_label' => 'Rango dinámico (por fila)',
            'li3' => 'usa una escala por fila, mejorando fidelidad en matrices heterogéneas.',
            'li4_label' => 'Log / Binaria / Ternaria',
            'li4' => 'compresión agresiva para máxima eficiencia, con más distorsión.',
        ],
        '3' => [
            'title' => '3) Cómo usar este laboratorio',
            'step1' => 'Genera una matriz aleatoria o ajusta su densidad.',
            'step2' => 'Selecciona modo de cuantización y ancho de bits.',
            'step3' => 'Aplica cuantización e inspecciona MSE, PSNR y el mapa de error.',
        ],
    ],
    'generator' => [
        'title' => 'Generador de matriz',
        'rows' => 'Filas',
        'cols' => 'Columnas',
        'density' => 'Densidad (% no cero)',
        'current' => 'Actual:',
        'generate' => 'Generar',
    ],
    'settings' => [
        'title' => 'Ajustes de cuantización',
        'type' => 'Tipo de cuantización',
        'int8_sym' => 'Uniforme simétrica (int8)',
        'uint8_asym' => 'Uniforme asimétrica (uint8)',
        'row_dynamic' => 'Rango dinámico (por fila)',
        'log' => 'Cuantización log',
        'binary' => 'Binaria (signo)',
        'ternary' => 'Ternaria (-1, 0, +1)',
        'bit_width' => 'Ancho de bits',
        'apply' => 'Aplicar cuantización',
        'reset' => 'Reiniciar',
    ],
    'summary' => [
        'title' => 'Resumen',
        'dimensions' => 'Dimensiones:',
        'value_range' => 'Rango de valores:',
        'quant_range' => 'Rango cuantizado:',
        'mse' => 'MSE:',
        'psnr' => 'PSNR (dB):',
        'avg_error' => 'Error promedio | |:',
        'bitrate' => 'Bitrate:',
        'bits_per_value' => 'bits/valor',
        'last_strategy' => 'Última estrategia:',
    ],
    'matrix' => [
        'title' => 'Matriz original',
    ],
    'quantized' => [
        'title' => 'Matriz cuantizada (enteros)',
    ],
    'dequantized' => [
        'title' => 'Matriz de-cuantizada (floats)',
    ],
    'error' => [
        'title' => 'Mapa de error (rojo = positivo, azul = negativo)',
    ],
    'json' => [
        'title' => 'Exportación JSON',
        'download' => 'Descargar',
    ],
];
