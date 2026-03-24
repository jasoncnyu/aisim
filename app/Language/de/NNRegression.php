<?php

return [
    'title' => 'Nichtlineares Neuronales Regressionslabor',
    'subtitle' => 'Passe nichtlineare Kurven mit einem Mehrschicht-Perzeptron an und beobachte die Divergenz von Training/Validierung bei Übertraining.',
    'accordion' => [
        '1' => [
            'title' => '1) Modellformulierung',
            'p1' => 'Im Gegensatz zur linearen Regression y=ax+b nutzt dieses Labor versteckte Schichten, um nichtlineare Abbildungen x → y zu lernen.',
            'equation' => '$$\\hat{y}=W_L\\,\\phi(W_{L-1}\\phi(\\cdots\\phi(W_1x+b_1)\\cdots)+b_{L-1})+b_L$$',
            'p2' => 'Wähle Tiefe, Breite und Aktivierung, um die Modellkapazität zu steuern.',
        ],
        '2' => [
            'title' => '2) Verlust und Overfitting-Signal',
            'p1' => 'Ziel ist der mittlere quadratische Fehler im Trainings-Subset:',
            'equation' => '$$\\text{MSE}=\\frac{1}{n}\\sum_{i=1}^{n}(y_i-\\hat{y}_i)^2$$',
            'p2' => 'Overfitting zeigt sich, wenn der Trainingsverlust weiter sinkt, während der Validierungsverlust stagniert oder steigt.',
        ],
    ],
    'controls' => [
        'add_point' => 'Punkt hinzufügen',
        'test_mode' => 'Testmodus',
        'clear' => 'Löschen',
        'demo' => [
            'sine' => 'Sinuskurve',
            'cubic' => 'Kubische Kurve',
            'piecewise' => 'Stückweise Kurve',
        ],
        'load_demo' => 'Demo laden',
        'hint' => 'Klicke, um Stichproben hinzuzufügen. Im Testmodus auf eine x-Position klicken, um vorhergesagtes y und Residuum zu sehen.',
    ],
    'params' => [
        'hidden_layers' => 'Verborgene Schichten',
        'units_per_layer' => 'Einheiten / Schicht',
        'activation' => 'Aktivierung',
        'val_ratio' => 'Validierungsanteil',
        'lr' => 'LR',
        'batch' => 'Batch',
        'epochs' => 'Epochen',
        'l2_reg' => 'L2-Reg',
        'init_model' => 'Modell initialisieren',
    ],
    'actions' => [
        'step' => 'Schritt',
        'run' => 'Start',
        'stop' => 'Stopp',
    ],
    'status' => [
        'title' => 'Trainingsstatus',
        'points' => 'Punkte:',
        'train_val' => 'Train / Val:',
        'epoch' => 'Epoche:',
        'train_loss' => 'Trainingsverlust:',
        'val_loss' => 'Validierungsverlust:',
    ],
    'interpretation' => [
        'title' => 'Interpretation',
        'li1' => 'Blaue Punkte: Trainings-Subset, orange Punkte: Validierungs-Subset.',
        'li2' => 'Gelber Marker im Testmodus: vorhergesagte Ausgabe am angeklickten x.',
        'li3' => 'Wenn der Trainingsverlust fällt, aber der Validierungsverlust steigt, ist die Kapazität zu hoch oder das Training zu lang.',
        'li4' => 'Probiere stärkere L2-Regularisierung oder kleinere versteckte Schichten, um Overfitting zu reduzieren.',
    ],
];
