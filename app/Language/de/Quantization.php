<?php

return [
    'title' => 'Quantisierungs-Labor',
    'subtitle' => 'Komprimiere Gewichte in Low-Bit-Formate und visualisiere Genauigkeits-Trade-offs.',
    'accordion' => [
        '1' => [
            'title' => '1) Warum Quantisierung wichtig ist',
            'p1' => 'Moderne Modelle sind groß und speicherintensiv. Quantisierung reduziert jedes Gewicht von 32-bit auf weniger Bits (8, 4 oder 1), verkleinert das Modell und beschleunigt die Inferenz.',
            'p2' => 'Der Kern-Trade-off ist Genauigkeit vs Effizienz. Mit guter Kalibrierung behalten Low-Bit-Modelle viel Leistung.',
        ],
        '2' => [
            'title' => '2) Quantisierungsmodi',
            'li1_label' => 'Uniform symmetrisch',
            'li1' => 'skaliert um Null; einfach und hardwarefreundlich.',
            'li2_label' => 'Uniform asymmetrisch',
            'li2' => 'verschiebt den Bereich für nicht-zentrierte Verteilungen.',
            'li3_label' => 'Dynamischer Bereich (pro Zeile)',
            'li3' => 'nutzt eine Skala pro Zeile für bessere Treue.',
            'li4_label' => 'Log / Binär / Ternär',
            'li4' => 'aggressive Kompression für maximale Effizienz, aber mit Verzerrung.',
        ],
        '3' => [
            'title' => '3) So nutzt du das Labor',
            'step1' => 'Erzeuge eine Zufallsmatrix oder setze die Dichte.',
            'step2' => 'Wähle Quantisierungsmodus und Bitbreite.',
            'step3' => 'Quantisiere und prüfe MSE, PSNR und Fehler-Heatmap.',
        ],
    ],
    'generator' => [
        'title' => 'Matrix-Generator',
        'rows' => 'Zeilen',
        'cols' => 'Spalten',
        'density' => 'Dichte (nicht null %)',
        'current' => 'Aktuell:',
        'generate' => 'Generieren',
    ],
    'settings' => [
        'title' => 'Quantisierungs-Einstellungen',
        'type' => 'Quantisierungstyp',
        'int8_sym' => 'Uniform symmetrisch (int8)',
        'uint8_asym' => 'Uniform asymmetrisch (uint8)',
        'row_dynamic' => 'Dynamischer Bereich (pro Zeile)',
        'log' => 'Log-Quantisierung',
        'binary' => 'Binär (Vorzeichen)',
        'ternary' => 'Ternär (-1, 0, +1)',
        'bit_width' => 'Bitbreite',
        'apply' => 'Quantisierung anwenden',
        'reset' => 'Zurücksetzen',
    ],
    'summary' => [
        'title' => 'Zusammenfassung',
        'dimensions' => 'Dimensionen:',
        'value_range' => 'Wertebereich:',
        'quant_range' => 'Quantisierungsbereich:',
        'mse' => 'MSE:',
        'psnr' => 'PSNR (dB):',
        'avg_error' => 'Durchschn. |Fehler|:',
        'bitrate' => 'Bitrate:',
        'bits_per_value' => 'Bits/Wert',
        'last_strategy' => 'Letzte Strategie:',
    ],
    'matrix' => [
        'title' => 'Originalmatrix',
    ],
    'quantized' => [
        'title' => 'Quantisierte Matrix (Integer)',
    ],
    'dequantized' => [
        'title' => 'Dequantisierte Matrix (Floats)',
    ],
    'error' => [
        'title' => 'Fehler-Heatmap (rot = positiv, blau = negativ)',
    ],
    'json' => [
        'title' => 'JSON-Export',
        'download' => 'Herunterladen',
    ],
];
