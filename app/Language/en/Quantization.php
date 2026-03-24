<?php

return [
    'title' => 'Quantization Lab',
    'subtitle' => 'Compress weights into low-bit formats and visualize the accuracy trade-offs.',
    'accordion' => [
        '1' => [
            'title' => '1) Why Quantization Matters',
            'p1' => 'Modern models are large and memory-heavy. Quantization reduces each weight from 32-bit floats to fewer bits (often 8, 4, or even 1), shrinking the model and speeding up inference.',
            'p2' => 'The core trade-off is accuracy versus efficiency. With careful calibration, low-bit models can retain most performance while running faster on commodity hardware.',
        ],
        '2' => [
            'title' => '2) Quantization Modes',
            'li1_label' => 'Uniform Symmetric',
            'li1' => 'scales weights around zero; simple and hardware-friendly.',
            'li2_label' => 'Uniform Asymmetric',
            'li2' => 'shifts the range to better fit non-zero distributions.',
            'li3_label' => 'Dynamic Range (per-row)',
            'li3' => 'uses a separate scale for each row, improving fidelity on heterogeneous matrices.',
            'li4_label' => 'Log / Binary / Ternary',
            'li4' => 'aggressive compression for extreme efficiency, at the cost of distortion.',
        ],
        '3' => [
            'title' => '3) How to Use This Lab',
            'step1' => 'Generate a random matrix or set its density.',
            'step2' => 'Select a quantization mode and bit-width.',
            'step3' => 'Apply quantization and inspect MSE, PSNR, and the error heatmap.',
        ],
    ],
    'generator' => [
        'title' => 'Matrix Generator',
        'rows' => 'Rows',
        'cols' => 'Cols',
        'density' => 'Density (non-zero %)',
        'current' => 'Current:',
        'generate' => 'Generate',
    ],
    'settings' => [
        'title' => 'Quantization Settings',
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
        'title' => 'Summary',
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
        'title' => 'Original Matrix',
    ],
    'quantized' => [
        'title' => 'Quantized Matrix (integers)',
    ],
    'dequantized' => [
        'title' => 'Dequantized Matrix (floats)',
    ],
    'error' => [
        'title' => 'Error Heatmap (red = positive, blue = negative)',
    ],
    'json' => [
        'title' => 'JSON Export',
        'download' => 'Download',
    ],
];
