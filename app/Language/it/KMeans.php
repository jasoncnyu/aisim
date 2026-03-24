<?php

return [
    'title' => 'Laboratorio di clustering K-Means',
    'subtitle' => 'Simulatore interattivo 2D con regioni di Voronoi, aggiornamento dei centroidi e tracciamento dell inerzia.',
    'accordion' => [
        '1' => [
            'title' => '1) Cosa ottimizza K-Means',
            'p1' => 'K-Means partiziona i dati in K cluster minimizzando la distanza quadratica intra-cluster (inerzia).',
            'equation' => '$$ J = \\sum_{i=1}^{N} \\min_{1 \\leq j \\leq K} \\left\\lVert x_i - \\mu_j \\right\\rVert^2 $$',
            'p2' => 'Ogni campione e assegnato al centroide piu vicino, poi i centroidi sono ricalcolati come media dei campioni assegnati.',
        ],
        '2' => [
            'title' => '2) Iterazione di Lloyd (assegna poi aggiorna)',
            'p1' => 'L algoritmo alterna due passi deterministici:',
            'equation1' => '$$ c_i \\leftarrow \\arg\\min_j \\lVert x_i - \\mu_j \\rVert^2 $$',
            'equation2' => '$$ \\mu_j \\leftarrow \\frac{1}{|C_j|}\\sum_{x_i \\in C_j} x_i $$',
            'p2' => 'L inerzia diminuisce in modo monotono fino alla convergenza a un ottimo locale.',
        ],
        '3' => [
            'title' => '3) Perche l inizializzazione conta',
            'p1' => 'L inizializzazione casuale e semplice ma puo partire da semi scadenti.',
            'p2' => 'k-means++ distribuisce i centroidi iniziali, spesso ottenendo convergenza piu rapida e inerzia finale piu bassa.',
            'p3' => 'In produzione usa piu run con semi diversi per ridurre la sensibilita ai minimi locali.',
        ],
        '4' => [
            'title' => '4) Workflow di esperimento suggerito',
            'step1' => 'Carica punti demo, poi confronta Random vs k-means++.',
            'step2' => 'Prova diversi valori di K e osserva confini e dimensioni dei cluster.',
            'step3' => 'Usa Step per vedere un ciclo di assegnazione/aggiornamento alla volta.',
            'step4' => 'Esegui fino alla convergenza e confronta i valori finali di inerzia tra le impostazioni.',
        ],
    ],
    'controls' => [
        'k_label' => 'K:',
        'init_label' => 'Init:',
        'init_random' => 'Random',
        'init_plus' => 'k-means++',
        'region_density' => 'Densita regione:',
        'load_demo' => 'Carica demo',
        'init_centroids' => 'Inizializza centroidi',
        'step' => 'Step',
        'run' => 'Esegui',
        'stop' => 'Stop',
        'clear' => 'Cancella',
        'hint' => 'Clicca sulla canvas per aggiungere punti. Su touch fai pressione prolungata o clic destro per rimuovere il punto piu vicino.',
    ],
    'status' => [
        'title' => 'Stato',
        'points' => 'Punti:',
        'k' => 'K:',
        'iteration' => 'Iterazione:',
        'inertia' => 'Inerzia:',
        'shift' => 'Spostamento centroidi:',
    ],
    'inertia_title' => 'Curva di inerzia',
    'summary_title' => 'Riepilogo cluster',
];
