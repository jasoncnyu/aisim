<?php

return [
    'title' => 'Laboratoire CNN binaire',
    'subtitle' => 'Petit CNN pour classification à deux classes avec visualisation des filtres et feature maps.',
    'accordion' => [
        '1' => [
            'title' => '1) Architecture du modèle',
            'p1' => 'Cette page entraîne un CNN compact : Conv(3x3) -> ReLU -> Flatten -> Dense -> ReLU -> Dense -> Softmax.',
            'p2' => 'Les images sont converties en niveaux de gris et redimensionnées en 32x32.',
            'p3' => 'Les labels binaires sont mappés sur les probabilités des classes 1 et 2.',
        ],
        '2' => [
            'title' => '2) Objectif d’apprentissage',
            'p1' => 'Le réseau est optimisé par entropie croisée sur deux classes :',
            'equation' => '$$ L = -\\frac{1}{N}\\sum_{i=1}^{N}\\sum_{c=1}^{2} y_{ic}\\log(\\hat{y}_{ic}) $$',
            'p2' => 'LR faible = plus stable, LR élevé = plus rapide mais plus bruyant.',
        ],
        '3' => [
            'title' => '3) Flux suggéré',
            'step1' => 'Chargez des images démo chat/chien ou importez vos fichiers.',
            'step2' => 'Initialisez les poids, lancez quelques époques et surveillez perte/précision.',
            'step3' => 'Inspectez les filtres et feature maps pour comprendre la première conv.',
            'step4' => 'Importez une image test et regardez les probabilités.',
        ],
    ],
    'controls' => [
        'load_demo' => 'Charger données démo',
        'init_weights' => 'Init poids',
        'step' => 'Pas (1 époque)',
        'run' => 'Exécuter',
        'stop' => 'Stop',
        'reset' => 'Réinitialiser',
        'lr' => 'LR:',
        'epochs' => 'Époques:',
        'batch' => 'Batch:',
    ],
    'metrics' => [
        'dataset' => 'Dataset:',
        'epoch' => 'Époque:',
        'loss' => 'Perte:',
        'accuracy' => 'Précision:',
    ],
    'training_images_title' => 'Images d’entraînement',
    'class1_label' => 'Classe 1 (label 0)',
        'class2_label' => 'Classe 2 (label 1)',
    'upload_hint' => 'Les images sont redimensionnées en 32x32 en niveaux de gris.',
    'loading_images' => 'Chargement des images...',
    'conv_filters_title' => 'Filtres conv (temps réel)',
    'prediction_title' => 'Prédiction',
    'predict_button' => 'Prédire l’image importée',
    'feature_maps_title' => 'Feature maps (couche conv)',
];

