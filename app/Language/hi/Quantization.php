<?php

return [
    'title' => 'Quantization Lab',
    'subtitle' => 'Weights को low-bit formats में compress करें और accuracy trade-offs देखें।',
    'accordion' => [
        '1' => [
            'title' => '1) Quantization क्यों जरूरी है',
            'p1' => 'Modern models बड़े और memory-heavy होते हैं। Quantization हर weight को 32-bit float से कम bits (अक्सर 8, 4 या 1) में बदलकर model छोटा और inference तेज करता है।',
            'p2' => 'मुख्य trade-off accuracy बनाम efficiency है। सही calibration से low-bit models अधिकतर performance बनाए रखते हैं और commodity hardware पर तेज चलते हैं।',
        ],
        '2' => [
            'title' => '2) Quantization Modes',
            'li1_label' => 'Uniform Symmetric',
            'li1' => 'weights को zero के आसपास scale करता है; सरल और hardware-friendly।',
            'li2_label' => 'Uniform Asymmetric',
            'li2' => 'range को shift करता है ताकि non-zero distributions फिट हों।',
            'li3_label' => 'Dynamic Range (per-row)',
            'li3' => 'हर row के लिए अलग scale, heterogeneous matrices पर बेहतर fidelity।',
            'li4_label' => 'Log / Binary / Ternary',
            'li4' => 'बहुत aggressive compression, extreme efficiency के बदले distortion।',
        ],
        '3' => [
            'title' => '3) How to Use This Lab',
            'step1' => 'Random matrix generate करें या density सेट करें।',
            'step2' => 'Quantization mode और bit-width चुनें।',
            'step3' => 'Quantization लागू करें और MSE, PSNR और error heatmap देखें।',
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
