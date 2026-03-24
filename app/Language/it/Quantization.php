<?php

return [
    'title' => 'Laboratorio di quantizzazione',
    'subtitle' => 'Comprimi i pesi in formati a pochi bit e visualizza i trade-off di accuratezza.',
    'accordion' => [
        '1' => [
            'title' => '1) Perche la quantizzazione conta',
            'p1' => 'I modelli moderni sono grandi e pesanti in memoria. La quantizzazione riduce ogni peso da float a 32 bit a meno bit (spesso 8, 4 o anche 1), riducendo il modello e accelerando l inference.',
            'p2' => 'Il trade-off centrale e accuratezza vs efficienza. Con una buona calibrazione, modelli low-bit possono mantenere gran parte delle prestazioni e girare piu veloci su hardware comune.',
        ],
        '2' => [
            'title' => '2) Modalita di quantizzazione',
            'li1_label' => 'Uniforme simmetrica',
            'li1' => 'scala i pesi attorno allo zero; semplice e adatta all hardware.',
            'li2_label' => 'Uniforme asimmetrica',
            'li2' => 'sposta l intervallo per adattarsi meglio a distribuzioni non centrate.',
            'li3_label' => 'Dynamic range (per-row)',
            'li3' => 'usa una scala separata per ogni riga, migliorando la fedelta su matrici eterogenee.',
            'li4_label' => 'Log / Binaria / Ternaria',
            'li4' => 'compressione aggressiva per massima efficienza, con piu distorsione.',
        ],
        '3' => [
            'title' => '3) Come usare questo laboratorio',
            'step1' => 'Genera una matrice casuale o imposta la densita.',
            'step2' => 'Seleziona una modalita di quantizzazione e la larghezza in bit.',
            'step3' => 'Applica la quantizzazione e ispeziona MSE, PSNR e la heatmap degli errori.',
        ],
    ],
    'generator' => [
        'title' => 'Generatore di matrice',
        'rows' => 'Righe',
        'cols' => 'Colonne',
        'density' => 'Densita (non-zero %)',
        'current' => 'Corrente:',
        'generate' => 'Genera',
    ],
    'settings' => [
        'title' => 'Impostazioni di quantizzazione',
        'type' => 'Tipo di quantizzazione',
        'int8_sym' => 'Uniforme simmetrica (int8)',
        'uint8_asym' => 'Uniforme asimmetrica (uint8)',
        'row_dynamic' => 'Dynamic range (per-row)',
        'log' => 'Quantizzazione log',
        'binary' => 'Binaria (segno)',
        'ternary' => 'Ternaria (-1, 0, +1)',
        'bit_width' => 'Larghezza in bit',
        'apply' => 'Applica quantizzazione',
        'reset' => 'Reset',
    ],
    'summary' => [
        'title' => 'Riepilogo',
        'dimensions' => 'Dimensioni:',
        'value_range' => 'Intervallo valori:',
        'quant_range' => 'Intervallo quant:',
        'mse' => 'MSE:',
        'psnr' => 'PSNR (dB):',
        'avg_error' => 'Errore medio |Error|:',
        'bitrate' => 'Bitrate:',
        'bits_per_value' => 'bit/valore',
        'last_strategy' => 'Ultima strategia:',
    ],
    'matrix' => [
        'title' => 'Matrice originale',
    ],
    'quantized' => [
        'title' => 'Matrice quantizzata (interi)',
    ],
    'dequantized' => [
        'title' => 'Matrice dequantizzata (float)',
    ],
    'error' => [
        'title' => 'Heatmap errori (rosso = positivo, blu = negativo)',
    ],
    'json' => [
        'title' => 'Esportazione JSON',
        'download' => 'Download',
    ],
];
