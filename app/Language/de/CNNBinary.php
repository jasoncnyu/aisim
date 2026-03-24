<?php

return [
    'title' => 'CNN-Binärlabor',
    'subtitle' => 'Kleines konvolutionales neuronales Netz für zweiklassige Bildklassifikation mit Filter- und Feature-Map-Visualisierung.',
    'accordion' => [
        '1' => [
            'title' => '1) Modellarchitektur',
            'p1' => 'Diese Seite trainiert ein kompaktes CNN: Conv(3x3) -> ReLU -> Flatten -> Dense -> ReLU -> Dense -> Softmax.',
            'p2' => 'Eingabebilder werden in Graustufen umgewandelt und auf 32x32 skaliert, sodass jedes Sample vor der Faltung ein 1024-dimensionaler Vektor ist.',
            'p3' => 'Binäre Labels werden auf Klassenwahrscheinlichkeiten abgebildet: P(Klasse 1) und P(Klasse 2).',
        ],
        '2' => [
            'title' => '2) Lernziel',
            'p1' => 'Das Netzwerk wird mit Kreuzentropie über zwei Klassen optimiert:',
            'equation' => '$$ L = -\\frac{1}{N}\\sum_{i=1}^{N}\\sum_{c=1}^{2} y_{ic}\\log(\\hat{y}_{ic}) $$',
            'p2' => 'Nutze eine niedrigere Lernrate für stabile Konvergenz oder eine höhere für schnellere, aber verrauschtere Updates.',
        ],
        '3' => [
            'title' => '3) Empfohlener Workflow',
            'step1' => 'Lade Demo-Katzen/Hunde-Bilder oder lade eigene Dateien in jede Klassenkategorie hoch.',
            'step2' => 'Initialisiere Gewichte, führe einige Epochen aus und beobachte Verlust und Genauigkeit.',
            'step3' => 'Prüfe Filterwerte und Feature-Maps, um zu verstehen, was die erste Conv-Schicht erfasst.',
            'step4' => 'Lade ein Testbild hoch und untersuche die Klassenwahrscheinlichkeiten.',
        ],
    ],
    'controls' => [
        'load_demo' => 'Demo-Daten laden',
        'init_weights' => 'Gewichte initialisieren',
        'step' => 'Schritt (1 Epoche)',
        'run' => 'Start',
        'stop' => 'Stopp',
        'reset' => 'Zurücksetzen',
        'lr' => 'LR:',
        'epochs' => 'Epochen:',
        'batch' => 'Batch:',
    ],
    'metrics' => [
        'dataset' => 'Datensatz:',
        'epoch' => 'Epoche:',
        'loss' => 'Verlust:',
        'accuracy' => 'Genauigkeit:',
    ],
    'training_images_title' => 'Trainingsbilder',
    'class1_label' => 'Klasse 1 (Label 0)',
    'class2_label' => 'Klasse 2 (Label 1)',
    'upload_hint' => 'Hochgeladene Bilder werden vor dem Training auf 32x32 Graustufen skaliert.',
    'loading_images' => 'Bilder werden geladen...',
    'conv_filters_title' => 'Conv-Filter (Echtzeit)',
    'prediction_title' => 'Vorhersage',
    'predict_button' => 'Hochgeladenes Bild vorhersagen',
    'feature_maps_title' => 'Feature-Maps (Conv-Schicht)',
];
