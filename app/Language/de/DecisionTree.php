<?php

return [
    'title' => 'Entscheidungsbaum-Visual-Labor',
    'subtitle' => 'Interaktiver Simulator für achsenparallele Splits bei binärer Klassifikation.',
    'accordion' => [
        '1' => [
            'title' => '1) Wie ein Entscheidungsbaum lernt',
            'p1' => 'Ein Entscheidungsbaum teilt Daten rekursiv in kleinere Regionen. In diesem Simulator ist jeder Split achsenparallel und nutzt x oder y mit Schwellenwert.',
            'p2' => 'Jeder innere Knoten stellt eine Regel wie x <= 22. Blätter geben Klassenwahrscheinlichkeiten und ein finales Label aus.',
        ],
        '2' => [
            'title' => '2) Split-Qualität: Gini-Unreinheit',
            'p1' => 'Für Klassenanteile p_k gilt die Gini-Unreinheit:',
            'equation' => '$$ G = 1 - \\sum_k p_k^2 $$',
            'p2' => 'Das Modell testet Kandidaten-Splits und wählt den mit minimaler gewichteter Kinder-Unreinheit.',
        ],
        '3' => [
            'title' => '3) Stoppkriterien und Generalisierung',
            'li1' => 'Maximale Tiefe begrenzt die Baumkomplexität.',
            'li2' => 'Minimale Samples vermeiden instabile Mikro-Splits.',
            'li3' => 'Reine Blätter (eine Klasse) stoppen natürlich.',
            'p1' => 'Flachere Bäume generalisieren meist besser, während tiefe Bäume lokales Rauschen überanpassen können.',
        ],
        '4' => [
            'title' => '4) Empfohlener Workflow',
            'step1' => 'Punkte für Klasse A und B hinzufügen oder ein Demo-Muster laden.',
            'step2' => 'Mit unterschiedlichen Max-Tiefe / Min-Samples Einstellungen trainieren.',
            'step3' => 'Regionsgrenzen, Textregeln und Split-Logs beobachten.',
            'step4' => 'Einfache vs komplexe Bäume für Interpretierbarkeit und Fit-Qualität vergleichen.',
        ],
    ],
    'controls' => [
        'class_a' => 'Klasse A',
        'class_b' => 'Klasse B',
        'train' => 'Trainieren',
        'clear' => 'Löschen',
        'demo' => [
            'random_clusters' => 'Zufällige gemischte Cluster',
            'concentric' => 'Konzentrisch (Zentrum vs Ring)',
            'xor' => 'XOR-Muster',
            'overlap' => 'Überlappende Cluster',
        ],
        'load_demo' => 'Demo laden',
        'max_depth' => 'Max. Tiefe:',
        'min_samples' => 'Min. Samples:',
        'show_regions' => 'Regionen anzeigen',
        'hint' => 'Klicke auf die Leinwand, um Samples in Rasterzellen zu platzieren, und trainiere, um Regeln und Regionen zu erzeugen.',
    ],
    'model' => [
        'title' => 'Modellinfo',
        'points' => 'Punkte:',
        'last_split' => 'Letzter Split-Score:',
        'points_a' => 'Punkte A',
        'points_b' => 'Punkte B',
    ],
    'tree_title' => 'Entscheidungsbaum (Text)',
    'calc_title' => 'Split-Berechnungsprotokoll',
];
