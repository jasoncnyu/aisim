<?php

return [
    'title' => 'K-Means-Clustering-Labor',
    'subtitle' => 'Interaktiver 2D-Clustering-Simulator mit Voronoi-Regionen, Zentroid-Updates und Inertia-Tracking.',
    'accordion' => [
        '1' => [
            'title' => '1) Was K-Means optimiert',
            'p1' => 'K-Means partitioniert Daten in K Cluster, indem die quadratische Distanz innerhalb der Cluster (Inertia) minimiert wird.',
            'equation' => '$$ J = \\sum_{i=1}^{N} \\min_{1 \\leq j \\leq K} \\left\\lVert x_i - \\mu_j \\right\\rVert^2 $$',
            'p2' => 'Jedes Sample wird dem nächsten Zentroid zugeordnet, dann werden Zentroiden als Mittel der zugeordneten Samples neu berechnet.',
        ],
        '2' => [
            'title' => '2) Lloyd-Iteration (Zuweisen dann Aktualisieren)',
            'p1' => 'Der Algorithmus wechselt zwischen zwei deterministischen Schritten:',
            'equation1' => '$$ c_i \\leftarrow \\arg\\min_j \\lVert x_i - \\mu_j \\rVert^2 $$',
            'equation2' => '$$ \\mu_j \\leftarrow \\frac{1}{|C_j|}\\sum_{x_i \\in C_j} x_i $$',
            'p2' => 'Inertia sinkt monoton bis zur Konvergenz zu einem lokalen Optimum.',
        ],
        '3' => [
            'title' => '3) Warum Initialisierung wichtig ist',
            'p1' => 'Zufällige Initialisierung ist einfach, kann aber mit schlechten Seeds starten.',
            'p2' => 'k-means++ verteilt initiale Zentroiden, was oft schnellere Konvergenz und geringere End-Inertia liefert.',
            'p3' => 'In Produktion mehrere Läufe mit unterschiedlichen Seeds verwenden, um lokale-Minima-Empfindlichkeit zu reduzieren.',
        ],
        '4' => [
            'title' => '4) Empfohlener Experiment-Workflow',
            'step1' => 'Demopunkte laden und Random vs k-means++ Initialisierung vergleichen.',
            'step2' => 'Unterschiedliche K-Werte testen und Regionsgrenzen sowie Clusterzahlen prüfen.',
            'step3' => 'Mit Schritt einen Zuweisung/Update-Zyklus ansehen.',
            'step4' => 'Bis zur Konvergenz laufen lassen und End-Inertia vergleichen.',
        ],
    ],
    'controls' => [
        'k_label' => 'K:',
        'init_label' => 'Init:',
        'init_random' => 'Zufällig',
        'init_plus' => 'k-means++',
        'region_density' => 'Regionsdichte:',
        'load_demo' => 'Demo laden',
        'init_centroids' => 'Zentroiden initialisieren',
        'step' => 'Schritt',
        'run' => 'Start',
        'stop' => 'Stopp',
        'clear' => 'Löschen',
        'hint' => 'Klicke irgendwo auf die Leinwand, um Punkte hinzuzufügen. Langes Drücken auf Touch-Geräten oder Rechtsklick entfernt den nächsten Punkt.',
    ],
    'status' => [
        'title' => 'Status',
        'points' => 'Punkte:',
        'k' => 'K:',
        'iteration' => 'Iteration:',
        'inertia' => 'Inertia:',
        'shift' => 'Zentroid-Verschiebung:',
    ],
    'inertia_title' => 'Inertia-Kurve',
    'summary_title' => 'Cluster-Zusammenfassung',
];
