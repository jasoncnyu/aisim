<?php

return [
    'title' => 'Laboratorio visivo di alberi decisionali',
    'subtitle' => 'Simulatore interattivo di split assiali per classificazione binaria.',
    'accordion' => [
        '1' => [
            'title' => '1) Come impara un albero decisionale',
            'p1' => 'Un albero decisionale divide ricorsivamente i dati in regioni piu piccole. In questo simulatore, ogni split e allineato agli assi e usa x o y con una soglia.',
            'p2' => 'Ogni nodo interno valuta una regola come x <= 22. Le foglie producono probabilita di classe e un etichetta finale.',
        ],
        '2' => [
            'title' => '2) Qualita dello split: impurita Gini',
            'p1' => 'Per proporzioni di classe p_k, l impurita Gini e:',
            'equation' => '$$ G = 1 - \\sum_k p_k^2 $$',
            'p2' => 'Il modello prova split candidati e sceglie quello che minimizza l impurita pesata dei figli.',
        ],
        '3' => [
            'title' => '3) Criteri di stop e generalizzazione',
            'li1' => 'La profondita massima limita la complessita.',
            'li2' => 'Il minimo di campioni evita micro-split instabili.',
            'li3' => 'Le foglie pure (tutta una classe) si fermano naturalmente.',
            'p1' => 'Alberi piu bassi generalizzano meglio, mentre alberi profondi possono overfittare il rumore locale.',
        ],
        '4' => [
            'title' => '4) Workflow suggerito',
            'step1' => 'Aggiungi punti per classe A e classe B o carica un pattern demo predefinito.',
            'step2' => 'Allena con diversi valori di max depth / min samples.',
            'step3' => 'Osserva confini delle regioni, regole testuali e log di split.',
            'step4' => 'Confronta alberi semplici vs complessi per interpretabilita e qualita del fit.',
        ],
    ],
    'controls' => [
        'class_a' => 'Classe A',
        'class_b' => 'Classe B',
        'train' => 'Allena',
        'clear' => 'Cancella',
        'demo' => [
            'random_clusters' => 'Cluster misti casuali',
            'concentric' => 'Concentrici (centro vs anello)',
            'xor' => 'Pattern XOR',
            'overlap' => 'Cluster sovrapposti',
        ],
        'load_demo' => 'Carica demo',
        'max_depth' => 'Profondita max:',
        'min_samples' => 'Campioni min:',
        'show_regions' => 'Mostra regioni',
        'hint' => 'Clicca sulla canvas per aggiungere campioni nelle celle della griglia, poi allena per generare regole di split e regioni decisionali.',
    ],
    'model' => [
        'title' => 'Info modello',
        'points' => 'Punti:',
        'last_split' => 'Score ultimo split:',
        'points_a' => 'Punti A',
        'points_b' => 'Punti B',
    ],
    'tree_title' => 'Albero decisionale (testo)',
    'calc_title' => 'Log calcolo split',
];
