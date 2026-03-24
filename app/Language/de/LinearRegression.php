<?php

return [
    'title' => 'Visualisierung der linearen Regression',
    'subtitle' => 'Interaktive Simulation fur OLS, GD und SGD.',
    'accordion' => [
        '1' => [
            'title' => '1) Was lineare Regression lost',
            'p1' => 'Lineare Regression schatzt eine Gerade zwischen Eingabe x und Ausgabe y.',
            'equation' => 'y = ax + b',
            'p2' => 'Hier ist a die Steigung und b der Achsenabschnitt. In diesem Simulator ist jeder hinzugefugte Punkt ein Trainingsbeispiel und das Modell findet die besten a und b.',
        ],
        '2' => [
            'title' => '2) Fehlerfunktion und warum MSE verwendet wird',
            'p1' => 'Das Modell minimiert den mittleren quadratischen Fehler (MSE):',
            'equation' => '$$ MSE(a,b) = \\frac{1}{n}\\sum_{i=1}^{n}(y_i-(ax_i+b))^2 $$',
            'p2' => 'Quadratieren bestraft gro©¬e Fehler starker und liefert ein glattes Optimierungsziel. Geringere Verlustwerte bedeuten bessere Anpassung.',
        ],
        '3' => [
            'title' => '3) OLS vs GD vs SGD',
            'ols' => 'Geschlossene Formel, einmalig.',
            'gd' => 'Nutzt alle Samples pro Epoche, stabil aber schwerer.',
            'sgd' => 'Nutzt gemischte Einzel-Sample-Updates, schneller aber rauschiger.',
            'p1' => 'Nutze dieselben Punkte und vergleiche Lernkurven der Methoden.',
        ],
        '4' => [
            'title' => '4) Empfohlener Lernablauf',
            'step1' => 'Punkte hinzufugen oder Demo-Daten laden.',
            'step2' => 'Zuerst OLS ausfuhren, um eine Basislinie zu erhalten.',
            'step3' => 'Auf GD/SGD umstellen und Lernrate sowie Epochen anpassen.',
            'step4' => 'Testmodus verwenden, um Ist- vs. Vorhersagewerte zu prufen.',
        ],
    ],
    'controls' => [
        'add_point' => 'Punkt hinzufugen',
        'clear_points' => 'Punkte loschen',
        'load_demo' => 'Demo-Daten laden',
        'hint' => 'Klicken, um Punkte hinzuzufugen. Langes Drucken auf einen Punkt entfernt ihn.',
        'method' => 'Regressionsmethode',
        'method_ols' => 'OLS',
        'method_gd' => 'Batch-Gradientenabstieg',
        'method_sgd' => 'Stochastischer Gradientenabstieg',
        'learning_rate' => 'Lernrate',
        'epochs' => 'Epochen',
        'step_train' => 'Schrittweise trainieren',
        'auto_train' => 'Automatisch trainieren',
        'test_mode' => 'Testmodus',
    ],
    'loss_title' => 'Verlust (MSE)',
    'model' => [
        'title' => 'Modell',
        'points' => 'Punkte:',
        'slope' => 'Steigung (a):',
        'intercept' => 'Achsenabschnitt (b):',
        'r2' => 'R2:',
        'last_loss' => 'Letzter Verlust:',
    ],
    'notes' => [
        'title' => 'Methodenhinweise',
        'ols' => [
            'title' => 'OLS',
            'desc' => 'Geschlossene Losung aus Kovarianz und Varianz:',
            'formula' => '$$ a = \\frac{\\sum (x_i-\\bar{x})(y_i-\\bar{y})}{\\sum (x_i-\\bar{x})^2}, \\quad b = \\bar{y} - a\\bar{x} $$',
        ],
        'gd' => [
            'title' => 'Batch GD',
            'desc' => 'Aktualisierung mit Gradienten uber den gesamten Datensatz:',
            'formula' => '$$ a \\leftarrow a - \\eta \\frac{\\partial MSE}{\\partial a}, \\quad b \\leftarrow b - \\eta \\frac{\\partial MSE}{\\partial b} $$',
        ],
        'sgd' => [
            'title' => 'SGD',
            'desc' => 'Einzel-Sample-Updates mit gemischten Punkten:',
            'formula' => '$$ a \\leftarrow a - \\eta \\cdot 2(ax_j+b-y_j)x_j, \\quad b \\leftarrow b - \\eta \\cdot 2(ax_j+b-y_j) $$',
        ],
    ],
];
