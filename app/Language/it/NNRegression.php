<?php

return [
    'title' => 'Laboratorio di regressione neurale non lineare',
    'subtitle' => 'Adatta curve non lineari con un percettrone multistrato, poi osserva la divergenza train/validation in overtraining.',
    'accordion' => [
        '1' => [
            'title' => '1) Formulazione del modello',
            'p1' => 'A differenza della regressione lineare y=ax+b, questo laboratorio usa strati nascosti per apprendere mappature non lineari x -> y.',
            'equation' => '$$\\hat{y}=W_L\\,\\phi(W_{L-1}\\phi(\\cdots\\phi(W_1x+b_1)\\cdots)+b_{L-1})+b_L$$',
            'p2' => 'Scegli profondita, larghezza e attivazione per controllare la capacita del modello.',
        ],
        '2' => [
            'title' => '2) Loss e segnale di overfitting',
            'p1' => 'L obiettivo e l errore quadratico medio sul sottoinsieme di training:',
            'equation' => '$$\\text{MSE}=\\frac{1}{n}\\sum_{i=1}^{n}(y_i-\\hat{y}_i)^2$$',
            'p2' => 'L overfitting appare quando la loss di training continua a scendere mentre la loss di validation si appiattisce o aumenta.',
        ],
    ],
    'controls' => [
        'add_point' => 'Aggiungi punto',
        'test_mode' => 'Test Mode',
        'clear' => 'Cancella',
        'demo' => [
            'sine' => 'Curva seno',
            'cubic' => 'Curva cubica',
            'piecewise' => 'Curva a tratti',
        ],
        'load_demo' => 'Carica demo',
        'hint' => 'Clicca per aggiungere campioni. In Test Mode, clicca una posizione x per vedere y predetto e residuo.',
    ],
    'params' => [
        'hidden_layers' => 'Strati nascosti',
        'units_per_layer' => 'Unita / strato',
        'activation' => 'Attivazione',
        'val_ratio' => 'Rapporto di validation',
        'lr' => 'LR',
        'batch' => 'Batch',
        'epochs' => 'Epoche',
        'l2_reg' => 'L2 Reg',
        'init_model' => 'Inizializza modello',
    ],
    'actions' => [
        'step' => 'Step',
        'run' => 'Esegui',
        'stop' => 'Stop',
    ],
    'status' => [
        'title' => 'Stato del training',
        'points' => 'Punti:',
        'train_val' => 'Train / Val:',
        'epoch' => 'Epoca:',
        'train_loss' => 'Loss train:',
        'val_loss' => 'Loss val:',
    ],
    'interpretation' => [
        'title' => 'Interpretazione',
        'li1' => 'Punti blu: training, punti arancioni: validation.',
        'li2' => 'Marcatore giallo in Test Mode: output predetto per la x cliccata.',
        'li3' => 'Se la loss train scende ma la loss val sale, la capacita e troppo alta o il training e troppo lungo.',
        'li4' => 'Prova una L2 piu forte o strati nascosti piu piccoli per ridurre l overfitting.',
    ],
];
