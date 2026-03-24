<?php

return [
    'title' => 'Laboratorio CNN binario',
    'subtitle' => 'CNN pequena para classificacao de duas classes com visualizacao de filtros e feature maps.',
    'accordion' => [
        '1' => [
            'title' => '1) Arquitetura do modelo',
            'p1' => 'Esta pagina treina uma CNN compacta: Conv(3x3) -> ReLU -> Flatten -> Dense -> ReLU -> Dense -> Softmax.',
            'p2' => 'Imagens sao convertidas para tons de cinza e redimensionadas para 32x32.',
            'p3' => 'Rotulos binarios sao mapeados para probabilidades de classe 1 e 2.',
        ],
        '2' => [
            'title' => '2) Objetivo de aprendizagem',
            'p1' => 'A rede e otimizada com entropia cruzada em duas classes:',
            'equation' => '$$ L = -\\frac{1}{N}\\sum_{i=1}^{N}\\sum_{c=1}^{2} y_{ic}\\log(\\hat{y}_{ic}) $$',
            'p2' => 'LR menor e mais estavel; LR maior e mais rapido porem mais ruidoso.',
        ],
        '3' => [
            'title' => '3) Fluxo sugerido',
            'step1' => 'Carregue imagens demo de gato/cao ou envie arquivos personalizados.',
            'step2' => 'Inicialize pesos, rode algumas epocas e monitore perda e acuracia.',
            'step3' => 'Confira filtros e feature maps para entender a primeira conv.',
            'step4' => 'Envie uma imagem de teste e inspecione probabilidades.',
        ],
    ],
    'controls' => [
        'load_demo' => 'Carregar dados demo',
        'init_weights' => 'Inicializar pesos',
        'step' => 'Passo (1 epoca)',
        'run' => 'Executar',
        'stop' => 'Parar',
        'reset' => 'Reset',
        'lr' => 'LR:',
        'epochs' => 'Epocas:',
        'batch' => 'Batch:',
    ],
    'metrics' => [
        'dataset' => 'Dataset:',
        'epoch' => 'Epoca:',
        'loss' => 'Perda:',
        'accuracy' => 'Acuracia:',
    ],
    'training_images_title' => 'Imagens de treino',
    'class1_label' => 'Classe 1 (label 0)',
    'class2_label' => 'Classe 2 (label 1)',
    'upload_hint' => 'Imagens sao redimensionadas para 32x32 em tons de cinza antes do treino.',
    'loading_images' => 'Carregando imagens...',
    'conv_filters_title' => 'Filtros conv (tempo real)',
    'prediction_title' => 'Predicao',
    'predict_button' => 'Prever imagem enviada',
    'feature_maps_title' => 'Feature maps (camada conv)',
];
