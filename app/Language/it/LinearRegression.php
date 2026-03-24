<?php

return [
    'title' => 'Visualizzazione della regressione lineare',
    'subtitle' => 'Simulazione interattiva per OLS, GD e SGD.',
    'accordion' => [
        '1' => [
            'title' => '1) Cosa risolve la regressione lineare',
            'p1' => 'La regressione lineare stima una relazione lineare tra input x e output y.',
            'equation' => 'y = ax + b',
            'p2' => 'Qui a e la pendenza e b e l intercetta. In questo simulatore ogni punto aggiunto e un campione di training e il modello trova i migliori a e b.',
        ],
        '2' => [
            'title' => '2) Funzione di errore e perche si usa MSE',
            'p1' => 'Il modello minimizza l errore quadratico medio (MSE):',
            'equation' => '$$ MSE(a,b) = \\frac{1}{n}\\sum_{i=1}^{n}(y_i-(ax_i+b))^2 $$',
            'p2' => 'Il quadrato penalizza di piu gli errori grandi e fornisce un obiettivo di ottimizzazione liscio. Una loss piu bassa significa un fit migliore.',
        ],
        '3' => [
            'title' => '3) OLS vs GD vs SGD',
            'ols' => 'Forma chiusa e one-shot.',
            'gd' => 'Usa tutti i campioni per epoca, stabile ma piu pesante.',
            'sgd' => 'Aggiornamenti su singolo campione con shuffle, piu veloce ma piu rumoroso.',
            'p1' => 'Usa gli stessi punti e confronta le curve di apprendimento per ogni metodo.',
        ],
        '4' => [
            'title' => '4) Workflow di apprendimento suggerito',
            'step1' => 'Aggiungi punti o carica dati demo.',
            'step2' => 'Esegui prima OLS per avere una baseline.',
            'step3' => 'Passa a GD/SGD e regola learning rate ed epoche.',
            'step4' => 'Usa Test Mode per confrontare valori reali e predetti.',
        ],
    ],
    'controls' => [
        'add_point' => 'Aggiungi punto',
        'clear_points' => 'Cancella punti',
        'load_demo' => 'Carica dati demo',
        'hint' => 'Clicca per aggiungere punti. Premi a lungo su un punto per rimuoverlo.',
        'method' => 'Metodo di regressione',
        'method_ols' => 'OLS',
        'method_gd' => 'Batch Gradient Descent',
        'method_sgd' => 'Stochastic Gradient Descent',
        'learning_rate' => 'Learning Rate',
        'epochs' => 'Epoche',
        'step_train' => 'Allenamento step',
        'auto_train' => 'Allenamento automatico',
        'test_mode' => 'Test Mode',
    ],
    'loss_title' => 'Loss (MSE)',
    'model' => [
        'title' => 'Modello',
        'points' => 'Punti:',
        'slope' => 'Pendenza (a):',
        'intercept' => 'Intercetta (b):',
        'r2' => 'R2:',
        'last_loss' => 'Ultima loss:',
    ],
    'notes' => [
        'title' => 'Note sui metodi',
        'ols' => [
            'title' => 'OLS',
            'desc' => 'Soluzione in forma chiusa da covarianza e varianza:',
            'formula' => '$$ a = \\frac{\\sum (x_i-\\bar{x})(y_i-\\bar{y})}{\\sum (x_i-\\bar{x})^2}, \\quad b = \\bar{y} - a\\bar{x} $$',
        ],
        'gd' => [
            'title' => 'Batch GD',
            'desc' => 'Aggiornamento con gradienti sull intero dataset:',
            'formula' => '$$ a \\leftarrow a - \\eta \\frac{\\partial MSE}{\\partial a}, \\quad b \\leftarrow b - \\eta \\frac{\\partial MSE}{\\partial b} $$',
        ],
        'sgd' => [
            'title' => 'SGD',
            'desc' => 'Aggiornamenti per campione con punti mescolati:',
            'formula' => '$$ a \\leftarrow a - \\eta \\cdot 2(ax_j+b-y_j)x_j, \\quad b \\leftarrow b - \\eta \\cdot 2(ax_j+b-y_j) $$',
        ],
    ],
];
