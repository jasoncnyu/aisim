<?php

return [
    'title' => 'XOR-Neuronales Netzwerk-Labor',
    'subtitle' => 'Visualisierung von Vorwärts-/Rückwärtsdurchlauf für ein kleines Mehrschicht-Perzeptron.',
    'accordion' => [
        '1' => [
            'title' => '1) Warum XOR ein klassisches NN-Demo ist',
            'p1' => 'XOR kann nicht durch eine einzige lineare Trennlinie gelöst werden. Ein Modell muss eine nichtlineare Entscheidungsfläche lernen.',
            'p2' => 'Daher ist XOR das Standard-Spielzeugproblem, um versteckte Schichten und nichtlineare Aktivierungen zu demonstrieren.',
        ],
        '2' => [
            'title' => '2) Hier verwendete Netzstruktur',
            'p1' => 'Der Simulator nutzt ein kompaktes MLP:',
            'structure' => 'Input(2) -> Hidden(4) -> Hidden(2) -> Output(1)',
            'p2' => 'Ausgabeaktivierung ist Sigmoid für binäre Wahrscheinlichkeit. Verdeckte Aktivierung kann tanh oder ReLU sein.',
        ],
        '3' => [
            'title' => '3) Trainingsdynamik',
            'p1' => 'Jeder Schritt sampelt einen XOR-Fall, führt einen Vorwärtsdurchlauf aus, berechnet den Verlust und wendet dann Backprop-Updates an.',
            'equation1' => '$$ z^{(l)} = a^{(l-1)}W^{(l)} + b^{(l)}, \\quad a^{(l)} = f(z^{(l)}) $$',
            'equation2' => '$$ W \\leftarrow W - \\eta \\nabla_W L, \\quad b \\leftarrow b - \\eta \\nabla_b L $$',
        ],
        '4' => [
            'title' => '4) So liest man die Visuals',
            'li1' => 'Das Verlustdiagramm zeigt den Konvergenztrend über die Trainingsschritte.',
            'li2' => 'Das Vorhersage-Panel zeigt die Ausgabesicherheit für alle vier XOR-Eingaben.',
            'li3' => 'Das Berechnungspanel protokolliert die letzten Vorwärts-/Rückwärtswerte zur Inspektion.',
        ],
    ],
    'controls' => [
        'title' => 'Trainingssteuerung',
        'learning_rate' => 'Lernrate',
        'sleep' => 'Warten (ms)',
        'activation' => 'Aktivierung',
        'step' => '+1 Schritt',
        'auto_train' => 'Auto-Training',
        'reset' => 'Zurücksetzen',
        'step_label' => 'Schritt:',
        'loss_label' => 'Verlust:',
    ],
    'trace_title' => 'Vorwärts-/Rückwärts-Trace',
    'prediction_title' => 'Vorhersage-Snapshot',
    'prediction_hint' => 'Größere Kreise zeigen eine höhere Ausgabewahrscheinlichkeit nahe Klasse 1.',
    'targets_title' => 'XOR-Ziele',
    'targets' => [
        'li1' => '(0,0) -> 0',
        'li2' => '(0,1) -> 1',
        'li3' => '(1,0) -> 1',
        'li4' => '(1,1) -> 0',
    ],
];
