<?php

return [
    'title' => 'Laboratorio K-Nearest Neighbors',
    'subtitle' => 'Classificazione basata su istanze con regioni decisionali interattive, ispezione dei vicini e voto pesato.',
    'accordion' => [
        '1' => [
            'title' => '1) Idea base di K-NN',
            'p1' => 'K-NN non apprende parametri globali del modello. Predice usando le etichette dei punti di training vicini nello spazio delle feature.',
            'p2' => 'Per un punto di query x, seleziona i K campioni piu vicini e aggrega le etichette con voto di maggioranza (o voto pesato).',
            'equation' => '$$\\hat{y}(x)=\\arg\\max_c \\sum_{i\\in \\mathcal{N}_K(x)} w_i\\,\\mathbf{1}(y_i=c)$$',
        ],
        '2' => [
            'title' => '2) Effetto di K e del peso della distanza',
            'li1' => 'K piccolo: confine molto flessibile, sensibile al rumore locale.',
            'li2' => 'K grande: confine piu liscio, varianza piu bassa, bias potenzialmente piu alto.',
            'li3' => 'Il voto pesato (w=1/d) da piu influenza ai vicini molto vicini.',
        ],
        '3' => [
            'title' => '3) Note pratiche',
            'p1' => 'Poiche K-NN si basa sulla distanza, la scalatura delle feature e critica nei dataset reali. La standardizzazione di solito migliora l affidabilita.',
            'p2' => 'Il costo di predizione cresce con la dimensione del dataset, perche a inference time vanno calcolate molte distanze.',
            'p3' => 'Usa la validation per scegliere K e valutare la robustezza con distribuzioni rumorose o classi sovrapposte.',
        ],
        '4' => [
            'title' => '4) Workflow suggerito',
            'step1' => 'Carica una distribuzione demo (verticale, XOR, concentrica, overlap, casuale).',
            'step2' => 'Regola K e abilita/disabilita il voto pesato per confrontare i confini decisionali.',
            'step3' => 'Abilita Test Mode e clicca per vedere i vicini piu prossimi e la probabilita di classe.',
            'step4' => 'Aumenta la densita delle regioni per dettagli piu fini, poi riducila per un rendering piu veloce.',
        ],
    ],
    'controls' => [
        'class_a' => 'Classe A',
        'class_b' => 'Classe B',
        'test_mode' => 'Test Mode',
        'k_label' => 'K:',
        'weighted' => 'Pesato (1/d)',
        'region_density' => 'Densita regione:',
        'demo' => [
            'vertical' => 'Verticale mista',
            'xor' => 'XOR (4 cluster)',
            'concentric' => 'Concentrici (centro vs anello)',
            'overlap' => 'Sovrapposti (difficile)',
            'random' => 'Cluster casuali',
        ],
        'load_demo' => 'Carica demo',
        'refresh' => 'Aggiorna',
        'clear' => 'Cancella',
        'hint' => 'Clicca per aggiungere campioni di training. In Test Mode, clicca per classificare un punto e ispezionare i vicini piu prossimi.',
    ],
    'model' => [
        'title' => 'Info modello',
        'points' => 'Punti:',
        'last_prob' => 'Ultimo test P(B):',
    ],
    'neighbors_title' => 'Vicini piu prossimi',
];
