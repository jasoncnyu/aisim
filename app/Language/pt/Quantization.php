<?php

return [
    'title' => 'Laboratório de Quantização',
    'subtitle' => 'Comprime pesos para formatos de poucos bits e visualiza o trade-off de precisão.',
    'accordion' => [
        '1' => [
            'title' => '1) Por que a quantização importa',
            'p1' => 'Modelos modernos são grandes e pesados. A quantização reduz cada peso de float32 para menos bits (8, 4 ou 1), reduzindo o modelo e acelerando a inferência.',
            'p2' => 'O trade-off central é precisão vs eficiência. Com calibração cuidadosa, modelos low-bit mantêm boa parte do desempenho.',
        ],
        '2' => [
            'title' => '2) Modos de quantização',
            'li1_label' => 'Uniforme simétrica',
            'li1' => 'escala pesos ao redor de zero; simples e amigável ao hardware.',
            'li2_label' => 'Uniforme assimétrica',
            'li2' => 'desloca o intervalo para ajustar distribuições não centradas em zero.',
            'li3_label' => 'Faixa dinâmica (por linha)',
            'li3' => 'usa escala por linha, melhorando fidelidade em matrizes heterogêneas.',
            'li4_label' => 'Log / Binária / Ternária',
            'li4' => 'compressão agressiva para eficiência extrema, com mais distorção.',
        ],
        '3' => [
            'title' => '3) Como usar este laboratório',
            'step1' => 'Gere uma matriz aleatória ou ajuste a densidade.',
            'step2' => 'Selecione modo de quantização e largura de bits.',
            'step3' => 'Aplique quantização e inspecione MSE, PSNR e o heatmap de erro.',
        ],
    ],
    'generator' => [
        'title' => 'Gerador de matriz',
        'rows' => 'Linhas',
        'cols' => 'Colunas',
        'density' => 'Densidade (% não zero)',
        'current' => 'Atual:',
        'generate' => 'Gerar',
    ],
    'settings' => [
        'title' => 'Configurações de quantização',
        'type' => 'Tipo de quantização',
        'int8_sym' => 'Uniforme simétrica (int8)',
        'uint8_asym' => 'Uniforme assimétrica (uint8)',
        'row_dynamic' => 'Faixa dinâmica (por linha)',
        'log' => 'Quantização log',
        'binary' => 'Binária (sinal)',
        'ternary' => 'Ternária (-1, 0, +1)',
        'bit_width' => 'Largura de bits',
        'apply' => 'Aplicar quantização',
        'reset' => 'Resetar',
    ],
    'summary' => [
        'title' => 'Resumo',
        'dimensions' => 'Dimensões:',
        'value_range' => 'Faixa de valores:',
        'quant_range' => 'Faixa quantizada:',
        'mse' => 'MSE:',
        'psnr' => 'PSNR (dB):',
        'avg_error' => 'Erro médio | |:',
        'bitrate' => 'Bitrate:',
        'bits_per_value' => 'bits/valor',
        'last_strategy' => 'Última estratégia:',
    ],
    'matrix' => [
        'title' => 'Matriz original',
    ],
    'quantized' => [
        'title' => 'Matriz quantizada (inteiros)',
    ],
    'dequantized' => [
        'title' => 'Matriz dequantizada (floats)',
    ],
    'error' => [
        'title' => 'Heatmap de erro (vermelho = positivo, azul = negativo)',
    ],
    'json' => [
        'title' => 'Exportação JSON',
        'download' => 'Baixar',
    ],
];
