<?php

return [
    'title' => 'Visuelles Labor fur logistische Regression',
    'subtitle' => 'Binare Klassifikationssimulation mit sigmoidaler Grenzflachenlernkurve.',
    'accordion' => [
        '1' => [
            'title' => '1) Was logistische Regression macht',
            'p1' => 'Logistische Regression sagt die Wahrscheinlichkeit der Klassenzugehorigkeit fur binare Ziele voraus.',
            'equation' => '$$ \\hat{y} = \\sigma(z), \\quad z = mx + b, \\quad \\sigma(z)=\\frac{1}{1+e^{-z}} $$',
            'p2' => 'Das Modell liefert Werte zwischen 0 und 1. Ein Schwellenwert wie 0,5 wandelt die Wahrscheinlichkeit in Klassenlabels um.',
        ],
        '2' => [
            'title' => '2) Zielfunktion (binare Kreuzentropie)',
            'p1' => 'Das Trainingsziel minimiert die negative Log-Likelihood:',
            'equation' => '$$ L(m,b)=-\\frac{1}{n}\\sum_{i=1}^{n}\\left[y_i\\log(\\hat{y_i})+(1-y_i)\\log(1-\\hat{y_i})\\right] $$',
            'p2' => 'Diese Verlustfunktion bestraft falsche, selbstsichere Vorhersagen stark und verbessert die Kalibrierung der Wahrscheinlichkeiten.',
        ],
        '3' => [
            'title' => '3) Gradienten-Updates',
            'p1' => 'Fur logistische Regression mit einem Merkmal sind die Batch-Gradienten:',
            'equation1' => '$$ \\frac{\\partial L}{\\partial m}=\\frac{1}{n}\\sum(\\hat{y_i}-y_i)x_i,\\quad \\frac{\\partial L}{\\partial b}=\\frac{1}{n}\\sum(\\hat{y_i}-y_i) $$',
            'equation2' => '$$ m \\leftarrow m-\\eta\\frac{\\partial L}{\\partial m},\\quad b \\leftarrow b-\\eta\\frac{\\partial L}{\\partial b} $$',
            'p2' => 'Niedrigere Lernraten verbessern die Stabilitat, hohere Raten konvergieren schneller, konnen aber oszillieren.',
        ],
        '4' => [
            'title' => '4) Praktischer Workflow',
            'step1' => 'Fuge Klassenpunkte manuell hinzu (unteres Band fur Klasse 0, oberes Band fur Klasse 1) oder lade Zufallsdaten.',
            'step2' => 'Trainiere mit Auto-Training und beobachte den Verlustabfall.',
            'step3' => 'Nutze Schritt, um das Verhalten pro Iteration zu prufen.',
            'step4' => 'Aktiviere den Testmodus und klicke, um die vorhergesagte Wahrscheinlichkeit an einer Eingabeposition zu prufen.',
        ],
    ],
    'controls' => [
        'generate_data' => 'Beispieldaten erzeugen',
        'auto_train' => 'Auto-Training',
        'step' => 'Schritt',
        'test_mode' => 'Testmodus',
        'reset' => 'Zurucksetzen',
        'learning_rate' => 'LR:',
        'hint' => 'Klicke auf die Zeichenflache, um Punkte hinzuzufugen. Punkte nahe y=0 stehen fur Klasse 0, Punkte nahe y=1 fur Klasse 1.',
    ],
    'loss_title' => 'Verlustkurve',
    'interpretation' => [
        'title' => 'Interpretationsleitfaden',
        'li1' => 'Die gelbe S-Kurve ist die gelernte Wahrscheinlichkeitsfunktion.',
        'li2' => 'Rote Punkte sind Klasse 1, cyanfarbene Punkte sind Klasse 0.',
        'li3' => 'Die zentrale Ubergangszone nahert die Entscheidungsgrenze an.',
        'li4' => 'Sinkender Verlust zeigt steigendes Klassifikationsvertrauen an.',
    ],
];
