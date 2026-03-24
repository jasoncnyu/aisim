<?php

return [
    'title' => 'Laboratoire de regression neuronale non lineaire',
    'subtitle' => 'Ajustez des courbes non lineaires avec un MLP et observez la divergence train/val en cas de surapprentissage.',
    'accordion' => [
        '1' => [
            'title' => '1) Formulation du modele',
            'p1' => 'Contrairement a la regression lineaire y=ax+b, ce labo utilise des couches cachees pour apprendre une mapping non lineaire x ¡æ y.',
            'equation' => '$$\\hat{y}=W_L\\,\\phi(W_{L-1}\\phi(\\cdots\\phi(W_1x+b_1)\\cdots)+b_{L-1})+b_L$$',
            'p2' => 'Choisissez profondeur, largeur et activation pour controler la capacite.',
        ],
        '2' => [
            'title' => '2) Perte et signal de surapprentissage',
            'p1' => 'L¡¯objectif est la MSE sur le sous-ensemble d¡¯entrainement :',
            'equation' => '$$\\text{MSE}=\\frac{1}{n}\\sum_{i=1}^{n}(y_i-\\hat{y}_i)^2$$',
            'p2' => 'Le surapprentissage apparait quand la perte train baisse tandis que la perte val stagne ou monte.',
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
        'load_demo' => 'Charger la demo',
        'hint' => 'Cliquez pour ajouter des echantillons. En mode test, cliquez en x pour voir y predit et residu.',
    ],
    'params' => [
        'hidden_layers' => 'Couches cachees',
        'units_per_layer' => 'Unites / couche',
        'activation' => 'Activation',
        'val_ratio' => 'Ratio de validation',
        'lr' => 'LR',
        'batch' => 'Batch',
        'epochs' => 'Epoques',
        'l2_reg' => 'L2 Reg',
        'init_model' => 'Initialiser le modele',
    ],
    'actions' => [
        'step' => 'Pas',
        'run' => 'Executer',
        'stop' => 'Stop',
    ],
    'status' => [
        'title' => 'Statut d¡¯entrainement',
        'points' => 'Points :',
        'train_val' => 'Train / Val :',
        'epoch' => 'Epoque :',
        'train_loss' => 'Perte train :',
        'val_loss' => 'Perte val :',
    ],
    'interpretation' => [
        'title' => 'Interpretation',
        'li1' => 'Points bleus : entrainement, orange : validation.',
        'li2' => 'Marqueur jaune en mode test : sortie predite au x clique.',
        'li3' => 'Si train baisse et val monte, capacite trop elevee ou entrainement trop long.',
        'li4' => 'Essayez un L2 plus fort ou des couches plus petites.',
    ],
];
