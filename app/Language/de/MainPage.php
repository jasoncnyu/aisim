<?php

return [
    'pageTitle' => 'Startseite',
    'tagline' => 'AI Simulator',
    'title' => 'Ein visuelles Labor zum Erlernen von KI',
    'description' => 'AI Simulator wandelt abstrakte Mathematik in interaktive Experimente um. Bauen Sie Intuition auf, indem Sie Modelle in Echtzeit trainieren, Verlustskurven beobachten und sehen, wie sich Entscheidungen beim Anpassen von Parametern ändern.',
    'labels' => [
        'interactive_labs' => 'Interaktive Labore',
        'live_training' => 'Live-Training',
        'explainable_visuals' => 'Erklärbare Visuelle',
        'guided_experiments' => 'Geführte Experimente',
    ],
    'cta' => [
        'start_learning' => 'Mit dem Lernen beginnen',
        'try_cnn_mnist' => 'CNN MNIST versuchen',
    ],
    
    // How to Use Section
    'howToUse' => [
        'title' => 'So verwenden Sie diese Plattform',
        'subtitle' => 'Ein kurzer Weg von Neugier zu selbstbewusster Intuition.',
        'steps' => [
            [
                'number' => '1',
                'label' => 'Schritt',
                'title' => 'Wählen Sie ein Labor',
                'description' => 'Wählen Sie ein Labor aus und lesen Sie die konzeptionelle Grundierung oben. Es sagt Ihnen, was das Modell lernen soll.',
            ],
            [
                'number' => '2',
                'label' => 'Schritt',
                'title' => 'Erstellen Sie Daten',
                'description' => 'Erstellen Sie Daten durch Klicken, Laden von Demos oder Verwenden von Beispielbildern. Die Datenform treibt alles voran.',
            ],
            [
                'number' => '3',
                'label' => 'Schritt',
                'title' => 'Trainieren und beobachten',
                'description' => 'Trainieren und beobachten Sie mit Schritt- oder Automatikbetrieb, beobachten Sie dann die Verlustskurve und das sich entwickelnde Modellverhalten.',
            ],
            [
                'number' => '4',
                'label' => 'Schritt',
                'title' => 'Vergleichen und reflektieren',
                'description' => 'Vergleichen und reflektieren Sie, indem Sie Hyperparameter oder Modelltyp ändern, um Bias, Varianz und Überanpassung zu sehen.',
            ],
        ],
    ],
    
    // Learning Tracks Section
    'learningTracks' => [
        'title' => 'Kern-Lernpfade',
        'machinelearning' => [
            'title' => 'Machine Learning',
            'description' => 'Beginnen Sie hier, um zu verstehen, wie Modelle aus Daten lernen. Sie werden sehen, wie sich eine einfache Kurve an Punkte anpasst, wie Klassifizierer Grenzen ziehen und warum die Modellkapazität wichtig ist. Dieser Pfad befasst sich mit dem Aufbau von Intuition für Verlustfunktionen, Gradienten und Datengeometrie.',
            'question' => 'Verwenden Sie es, um zu antworten: Warum passt sich ein Modell über- oder unteran? Wie formt eine Datenverteilung eine Entscheidungsgrenze neu?',
            'reinforcement' => [
            'title' => 'Best?rkendes Lernen',
            'description' => 'Hier ist das Modell ein Agent, der aus Belohnungen statt aus gelabelten Beispielen lernt. Du erkundest Exploration vs. Exploitation, sp?rliche Belohnungen und die Rolle der Umweltdynamik.',
            'question' => 'Nutze es, um zu beantworten: Wann ist Erkunden besser? Wie pr?gt die Belohnungsstruktur das Verhalten?',
            'labs' => [
                'N-Slot-Bandit',
                'Gitterwelt',
            ],
        ],
    ],
        'deeplearning' => [
            'title' => 'Deep Learning',
            'description' => 'Dieser Pfad skaliert die Intuition von Kurven zu Netzwerken. Beobachten Sie, wie Neuronen Eingaben in Repräsentationen umwandeln, und sehen Sie dann, wie Faltungsfilter visuelle Merkmale extrahieren. Der Fokus liegt darauf, wie Tiefe und Nichtlinearität das ändern, was ein Modell ausdrücken kann.',
            'question' => 'Verwenden Sie es, um zu antworten: Wie lernt ein CNN Kanten? Warum passt sich ein neuronales Modell über an, während sich der Verlust weiter verbessert?',

            'labs' => [
                'NN-Regression',
                'CNN Binary',
                'CNN MNIST',
                'XOR-Lab',
                'Tiny Web LLM',
            ],
        ],
    ],
    'quickStart' => [
        'title' => 'Schnellstart-Prompts',
        'items' => [
            [
                'label' => 'Neu in ML?',
                'text' => 'Starte mit Linearer Regression und Logistischer Regression, dann vergleiche mit Entscheidungsb?umen.',
            ],
            [
                'label' => 'Interessiert an Kurven?',
                'text' => 'Nutze NN-Regression, um zu sehen, wie Tiefe und Breite die Anpassung ver?ndern.',
            ],
            [
                'label' => 'Visuelle Intuition?',
                'text' => 'Spring zu CNN MNIST und zeichne Ziffern, um die Inferenz zu testen.',
            ],
        ],
        'cta' => [
            'start_linear' => 'Mit Linearer Regression starten',
            'explore_nn' => 'NN-Regression erkunden',
        ],
    ],
];
