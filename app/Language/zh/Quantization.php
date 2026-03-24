<?php

return [
    'title' => '量化实验',
    'subtitle' => '将权重量化为低比特格式并可视化准确率权衡。',
    'accordion' => [
        '1' => [
            'title' => '1) 为什么量化重要',
            'p1' => '现代模型体积大且占内存。量化将权重从 32 位浮点降到更少位数（常见 8、4 甚至 1），缩小模型并加速推理。',
            'p2' => '核心权衡是准确率与效率。经过校准，低比特模型仍可保留大部分性能。',
        ],
        '2' => [
            'title' => '2) 量化模式',
            'li1_label' => '均匀对称',
            'li1' => '围绕 0 缩放，简单且硬件友好。',
            'li2_label' => '均匀非对称',
            'li2' => '平移范围以适配非零分布。',
            'li3_label' => '动态范围（按行）',
            'li3' => '每行使用独立尺度，提高异质矩阵保真度。',
            'li4_label' => '对数 / 二值 / 三值',
            'li4' => '极端压缩以换取效率，但失真更大。',
        ],
        '3' => [
            'title' => '3) 如何使用本实验',
            'step1' => '生成随机矩阵或设置密度。',
            'step2' => '选择量化模式和比特宽度。',
            'step3' => '应用量化并查看 MSE、PSNR 与误差热图。',
        ],
    ],
    'generator' => [
        'title' => '矩阵生成器',
        'rows' => '行',
        'cols' => '列',
        'density' => '密度(非零 %)',
        'current' => '当前:',
        'generate' => '生成',
    ],
    'settings' => [
        'title' => '量化设置',
        'type' => '量化类型',
        'int8_sym' => '均匀对称 (int8)',
        'uint8_asym' => '均匀非对称 (uint8)',
        'row_dynamic' => '动态范围（按行）',
        'log' => '对数量化',
        'binary' => '二值（符号）',
        'ternary' => '三值 (-1, 0, +1)',
        'bit_width' => '比特宽度',
        'apply' => '应用量化',
        'reset' => '重置',
    ],
    'summary' => [
        'title' => '摘要',
        'dimensions' => '维度:',
        'value_range' => '数值范围:',
        'quant_range' => '量化范围:',
        'mse' => 'MSE:',
        'psnr' => 'PSNR (dB):',
        'avg_error' => '平均 |误差|:',
        'bitrate' => '码率:',
        'bits_per_value' => '比特/值',
        'last_strategy' => '最后策略:',
    ],
    'matrix' => [
        'title' => '原始矩阵',
    ],
    'quantized' => [
        'title' => '量化矩阵（整数）',
    ],
    'dequantized' => [
        'title' => '反量化矩阵（浮点）',
    ],
    'error' => [
        'title' => '误差热图（红=正，蓝=负）',
    ],
    'json' => [
        'title' => 'JSON 导出',
        'download' => '下载',
    ],
];
