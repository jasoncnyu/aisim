<?php

return [
    'title' => 'K-Nächste-Nachbarn-Labor',
    'subtitle' => 'Instanzbasierte Klassifikation mit interaktiven Entscheidungsregionen, Nachbarschaftsprüfung und gewichteter Abstimmung.',
    'accordion' => [
        '1' => [
            'title' => '1) Kernidee von K-NN',
            'p1' => 'K-NN lernt keine globalen Modellparameter. Es sagt mithilfe der Labels nahegelegener Trainingspunkte im Merkmalsraum voraus.',
            'p2' => 'Für einen Abfragepunkt x wähle die K nächsten Samples und aggregiere ihre Labels per Mehrheits- (oder gewichteter) Abstimmung.',
            'equation' => '$$\\hat{y}(x)=\\arg\\max_c \\sum_{i\\in \\mathcal{N}_K(x)} w_i\\,\\mathbf{1}(y_i=c)$$',
        ],
        '2' => [
            'title' => '2) Einfluss von K und Distanzgewichtung',
            'li1' => 'K klein: sehr flexible Grenze, empfindlich gegenüber lokalem Rauschen.',
            'li2' => 'K groß: glattere Grenze, geringere Varianz, potenziell höherer Bias.',
            'li3' => 'Gewichtete Abstimmung (w=1/d) gibt sehr nahen Nachbarn mehr Einfluss.',
        ],
        '3' => [
            'title' => '3) Praktische Hinweise',
            'p1' => 'Da K-NN auf Distanz beruht, ist Feature-Skalierung in realen Datensätzen kritisch. Standardisierung verbessert meist die Zuverlässigkeit.',
            'p2' => 'Die Vorhersagekosten steigen mit der Datensatzgröße, da bei der Inferenz viele Distanzen berechnet werden müssen.',
            'p3' => 'Nutze Validierung, um K zu wählen, und bewerte Robustheit bei verrauschten oder überlappenden Klassenverteilungen.',
        ],
        '4' => [
            'title' => '4) Empfohlener Workflow',
            'step1' => 'Lade eine Demo-Verteilung (vertikal, XOR, konzentrisch, Überlappung, zufällig).',
            'step2' => 'Passe K an und schalte gewichtete Abstimmung um, um Grenzen zu vergleichen.',
            'step3' => 'Aktiviere den Testmodus und klicke, um Nachbarn und Klassenwahrscheinlichkeit zu prüfen.',
            'step4' => 'Erhöhe die Regionsdichte für feinere Details und senke sie für schnelleres Rendering.',
        ],
    ],
    'controls' => [
        'class_a' => 'Klasse A',
        'class_b' => 'Klasse B',
        'test_mode' => 'Testmodus',
        'k_label' => 'K:',
        'weighted' => 'Gewichtet (1/d)',
        'region_density' => 'Regionsdichte:',
        'demo' => [
            'vertical' => 'Gemischt Vertikal',
            'xor' => 'XOR (4 Cluster)',
            'concentric' => 'Konzentrisch (Zentrum vs Ring)',
            'overlap' => 'Überlappung (Schwierig)',
            'random' => 'Zufällige Cluster',
        ],
        'load_demo' => 'Demo laden',
        'refresh' => 'Aktualisieren',
        'clear' => 'Löschen',
        'hint' => 'Klicken, um Trainingspunkte hinzuzufügen. Im Testmodus klicken, um einen Punkt zu klassifizieren und Nachbarn zu prüfen.',
    ],
    'model' => [
        'title' => 'Modellinfo',
        'points' => 'Punkte:',
        'last_prob' => 'Letzter Test P(B):',
    ],
    'neighbors_title' => 'Nächste Nachbarn',
];
