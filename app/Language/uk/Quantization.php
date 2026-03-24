<?php

return [
    'title' => 'Лабораторія квантизації',
    'subtitle' => 'Стисніть ваги у low-bit формати та перегляньте компроміси точності.',
    'accordion' => [
        '1' => [
            'title' => '1) Чому квантизація важлива',
            'p1' => 'Сучасні моделі великі й важкі по памʼяті. Квантизація зменшує кожну вагу з 32-бітних float до меншої кількості бітів (часто 8, 4 або навіть 1), зменшуючи модель і прискорюючи inference.',
            'p2' => 'Основний trade-off — точність проти ефективності. За уважного калібрування low-bit моделі можуть зберегти більшість продуктивності та працювати швидше на масовому залізі.',
        ],
        '2' => [
            'title' => '2) Режими квантизації',
            'li1_label' => 'Uniform Symmetric',
            'li1' => 'масштабує ваги навколо нуля; просто і дружньо до заліза.',
            'li2_label' => 'Uniform Asymmetric',
            'li2' => 'зсуває діапазон, щоб краще відповідати ненульовим розподілам.',
            'li3_label' => 'Dynamic Range (per-row)',
            'li3' => 'окремий масштаб для кожного рядка, краща точність для неоднорідних матриць.',
            'li4_label' => 'Log / Binary / Ternary',
            'li4' => 'агресивна компресія для максимальної ефективності ціною спотворень.',
        ],
        '3' => [
            'title' => '3) Як користуватись лабораторією',
            'step1' => 'Згенеруйте випадкову матрицю або задайте її щільність.',
            'step2' => 'Оберіть режим квантизації та ширину в бітах.',
            'step3' => 'Застосуйте квантизацію і перегляньте MSE, PSNR та heatmap помилок.',
        ],
    ],
    'generator' => [
        'title' => 'Генератор матриці',
        'rows' => 'Rows',
        'cols' => 'Cols',
        'density' => 'Density (non-zero %)',
        'current' => 'Current:',
        'generate' => 'Generate',
    ],
    'settings' => [
        'title' => 'Налаштування квантизації',
        'type' => 'Quantization Type',
        'int8_sym' => 'Uniform Symmetric (int8)',
        'uint8_asym' => 'Uniform Asymmetric (uint8)',
        'row_dynamic' => 'Dynamic Range (per-row)',
        'log' => 'Log Quantization',
        'binary' => 'Binary (sign)',
        'ternary' => 'Ternary (-1, 0, +1)',
        'bit_width' => 'Bit Width',
        'apply' => 'Apply Quantization',
        'reset' => 'Reset',
    ],
    'summary' => [
        'title' => 'Підсумок',
        'dimensions' => 'Dimensions:',
        'value_range' => 'Value Range:',
        'quant_range' => 'Quant Range:',
        'mse' => 'MSE:',
        'psnr' => 'PSNR (dB):',
        'avg_error' => 'Avg |Error|:',
        'bitrate' => 'Bitrate:',
        'bits_per_value' => 'bits/value',
        'last_strategy' => 'Last Strategy:',
    ],
    'matrix' => [
        'title' => 'Оригінальна матриця',
    ],
    'quantized' => [
        'title' => 'Квантизована матриця (цілі числа)',
    ],
    'dequantized' => [
        'title' => 'Деквантизована матриця (float)',
    ],
    'error' => [
        'title' => 'Heatmap помилок (червоне = позитивне, синє = негативне)',
    ],
    'json' => [
        'title' => 'JSON Export',
        'download' => 'Download',
    ],
];
