<?php

return [
    'title' => 'Laboratoire de régression neuronale non linéaire',
    'subtitle' => 'Ajustez des courbes non linéaires avec un MLP et observez la divergence train/val en cas de surapprentissage.',
    'accordion' => [
        '1' => [
            'title' => '1) Formulation du modèle',
            'p1' => 'Contrairement à la régression linéaire y=ax+b, ce labo utilise des couches cachées pour apprendre un mapping non linéaire x → y.',
            'equation' => '$$\\hat{y}=W_L\\,\\phi(W_{L-1}\\phi(\\cdots\\phi(W_1x+b_1)\\cdots)+b_{L-1})+b_L$$',
            'p2' => 'Choisissez profondeur, largeur et activation pour contrôler la capacité.',
        ],
        '2' => [
            'title' => '2) Perte et signal de surapprentissage',
            'p1' => 'L’objectif est la MSE sur le sous-ensemble d’entraînement :',
            'equation' => '$$\\text{MSE}=\\frac{1}{n}\\sum_{i=1}^{n}(y_i-\\hat{y}_i)^2$$',
            'p2' => 'Le surapprentissage apparaît quand la perte train baisse tandis que la perte val stagne ou monte.',
        ],
    ],
    'controls' => [
        'add_point' => 'Ajouter un point',
        'test_mode' => 'Mode test',
        'clear' => 'Effacer',
        'demo' => [
            'sine' => 'Courbe sinus',
            'cubic' => 'Courbe cubique',
            'piecewise' => 'Courbe par morceaux',
        ],
        'load_demo' => 'Charger la démo',
        'hint' => 'Cliquez pour ajouter des échantillons. En mode test, cliquez en x pour voir y prédit et résidu.',
    ],
    'params' => [
        'hidden_layers' => 'Couches cachées',
        'units_per_layer' => 'Unités / couche',
        'activation' => 'Activation',
        'val_ratio' => 'Ratio de validation',
        'lr' => 'LR',
        'batch' => 'Batch',
        'epochs' => 'Époques',
        'l2_reg' => 'L2 Reg',
        'init_model' => 'Initialiser le modèle',
    ],
    'actions' => [
        'step' => 'Pas',
        'run' => 'Exécuter',
        'stop' => 'Stop',
    ],
    'status' => [
        'title' => 'Statut d’entraînement',
        'points' => 'Points :',
        'train_val' => 'Train / Val :',
        'epoch' => 'Époque :',
        'train_loss' => 'Perte train :',
        'val_loss' => 'Perte val :',
    ],
    'interpretation' => [
        'title' => 'Interprétation',
        'li1' => 'Points bleus : entraînement, orange : validation.',
        'li2' => 'Marqueur jaune en mode test : sortie prédite au x cliqué.',
        'li3' => 'Si train baisse et val monte, capacité trop élevée ou entraînement trop long.',
        'li4' => 'Essayez un L2 plus fort ou des couches plus petites.',
    ],
];
