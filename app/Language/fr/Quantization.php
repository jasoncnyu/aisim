<?php

return [
    'title' => 'Laboratoire de Quantization',
    'subtitle' => 'Compressez les poids en bas bits et visualisez le compromis précision.',
    'accordion' => [
        '1' => [
            'title' => '1) Pourquoi la quantization compte',
            'p1' => 'Les modèles modernes sont volumineux. La quantization réduit chaque poids de float32 à moins de bits (8, 4 ou 1), réduisant la taille et accélérant l’inférence.',
            'p2' => 'Le compromis clé est précision vs efficacité. Avec une bonne calibration, les modèles low-bit gardent la plupart des performances.',
        ],
        '2' => [
            'title' => '2) Modes de quantization',
            'li1_label' => 'Uniforme symétrique',
            'li1' => 'met à l’échelle autour de zéro ; simple et friendly hardware.',
            'li2_label' => 'Uniforme asymétrique',
            'li2' => 'décale l’intervalle pour mieux coller aux distributions non nulles.',
            'li3_label' => 'Plage dynamique (par ligne)',
            'li3' => 'utilise une échelle par ligne pour mieux représenter les matrices hétérogènes.',
            'li4_label' => 'Log / Binaire / Ternaire',
            'li4' => 'compression agressive pour l’efficacité, au prix de distorsion.',
        ],
        '3' => [
            'title' => '3) Comment utiliser ce labo',
            'step1' => 'Générez une matrice aléatoire ou réglez la densité.',
            'step2' => 'Sélectionnez un mode de quantization et une largeur de bits.',
            'step3' => 'Appliquez la quantization et inspectez MSE, PSNR et la heatmap d’erreur.',
        ],
    ],
    'generator' => [
        'title' => 'Générateur de matrice',
        'rows' => 'Lignes',
        'cols' => 'Colonnes',
        'density' => 'Densité (% non nul)',
        'current' => 'Actuel :',
        'generate' => 'Générer',
    ],
    'settings' => [
        'title' => 'Paramètres de quantization',
        'type' => 'Type de quantization',
        'int8_sym' => 'Uniforme symétrique (int8)',
        'uint8_asym' => 'Uniforme asymétrique (uint8)',
        'row_dynamic' => 'Plage dynamique (par ligne)',
        'log' => 'Quantization log',
        'binary' => 'Binaire (signe)',
        'ternary' => 'Ternaire (-1, 0, +1)',
        'bit_width' => 'Largeur de bits',
        'apply' => 'Appliquer la quantization',
        'reset' => 'Réinitialiser',
    ],
    'summary' => [
        'title' => 'Résumé',
        'dimensions' => 'Dimensions :',
        'value_range' => 'Plage de valeurs :',
        'quant_range' => 'Plage quantifiée :',
        'mse' => 'MSE :',
        'psnr' => 'PSNR (dB) :',
        'avg_error' => 'Moy. |erreur| :',
        'bitrate' => 'Bitrate :',
        'bits_per_value' => 'bits/valeur',
        'last_strategy' => 'Dernière stratégie :',
    ],
    'matrix' => [
        'title' => 'Matrice originale',
    ],
    'quantized' => [
        'title' => 'Matrice quantifiée (entiers)',
    ],
    'dequantized' => [
        'title' => 'Matrice déquantifiée (floats)',
    ],
    'error' => [
        'title' => 'Heatmap d’erreur (rouge = positif, bleu = négatif)',
    ],
    'json' => [
        'title' => 'Export JSON',
        'download' => 'Télécharger',
    ],
];
