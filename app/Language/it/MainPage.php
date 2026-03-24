<?php

return [
    'pageTitle' => 'Home',
    'tagline' => 'AI Simulator',
    'title' => 'Un laboratorio visivo per imparare l AI',
    'description' => 'AI Simulator trasforma la matematica astratta in esperimenti interattivi. Costruisci intuizione allenando i modelli in tempo reale, osservando le curve di loss e vedendo come le decisioni cambiano mentre regoli i parametri.',
    'labels' => [
        'interactive_labs' => 'Laboratori interattivi',
        'live_training' => 'Training dal vivo',
        'explainable_visuals' => 'Visualizzazioni spiegabili',
        'guided_experiments' => 'Esperimenti guidati',
    ],
    'cta' => [
        'start_learning' => 'Inizia a imparare',
        'try_cnn_mnist' => 'Prova CNN MNIST',
    ],
    
    // How to Use Section
    'howToUse' => [
        'title' => 'Come usare questa piattaforma',
        'subtitle' => 'Un percorso breve dalla curiosita alla sicurezza.',
        'steps' => [
            [
                'number' => '1',
                'label' => 'Passo',
                'title' => 'Scegli un laboratorio',
                'description' => 'Scegli un laboratorio e leggi il primer concettuale in alto. Ti dice cosa il modello sta cercando di imparare.',
            ],
            [
                'number' => '2',
                'label' => 'Passo',
                'title' => 'Crea dati',
                'description' => 'Crea dati cliccando, caricando demo o usando immagini campione. La forma dei dati guida tutto.',
            ],
            [
                'number' => '3',
                'label' => 'Passo',
                'title' => 'Allena e osserva',
                'description' => 'Allena e osserva con step o auto-run, poi guarda la curva di loss e l evoluzione del comportamento del modello.',
            ],
            [
                'number' => '4',
                'label' => 'Passo',
                'title' => 'Confronta e rifletti',
                'description' => 'Confronta e rifletti cambiando iperparametri o tipo di modello per vedere bias, varianza e overfitting.',
            ],
        ],
    ],
    
    // Learning Tracks Section
    'learningTracks' => [
        'title' => 'Percorsi di apprendimento principali',
        'machinelearning' => [
            'title' => 'Machine Learning',
            'description' => 'Inizia qui per capire come i modelli imparano dai dati. Vedrai come una curva semplice si piega per adattarsi ai punti, come i classificatori disegnano confini e perche la capacita del modello conta. Questo percorso e dedicato all intuizione su loss, gradienti e geometria dei dati.',
            'question' => 'Usalo per rispondere: Perche un modello underfit o overfit? Come la distribuzione dei dati rimodella un confine decisionale?',
            'labs' => [
                'Linear Regression',
                'Logistic Regression',
                'Decision Tree',
                'K-Means',
                'K-NN',
                'SVM',
            ],
        ],
        'deeplearning' => [
            'title' => 'Deep Learning',
            'description' => 'Questo percorso amplia l intuizione dalle curve alle reti. Guarda i neuroni trasformare gli input in rappresentazioni e poi vedi come i filtri convoluzionali estraggono caratteristiche visive. Il focus e su come profondita e non linearita cambiano cio che un modello puo esprimere.',
            'question' => 'Usalo per rispondere: Come una CNN impara i bordi? Perche un modello neurale overfitta mentre la loss continua a migliorare?',
            'labs' => [
                'NN Regression',
                'CNN Binary',
                'CNN MNIST',
                'XOR Lab',
                'Tiny Web LLM',
            ],
        ],
        'reinforcement' => [
            'title' => 'Reinforcement Learning',
            'description' => 'Qui il modello e un agente che impara dalle ricompense invece che da esempi etichettati. Esplorerai esplorazione vs sfruttamento, ricompense sparse e il ruolo delle dinamiche dell ambiente.',
            'question' => 'Usalo per rispondere: Quando e meglio esplorare? Come la struttura delle ricompense modella il comportamento?',
            'labs' => [
                'N-Slot Bandit',
                'Grid World',
            ],
        ],
    ],
    'quickStart' => [
        'title' => 'Prompt di avvio rapido',
        'items' => [
            [
                'label' => 'Nuovo al ML?',
                'text' => 'Inizia con Linear Regression e Logistic Regression, poi confronta con Decision Tree.',
            ],
            [
                'label' => 'Interessato alle curve?',
                'text' => 'Usa NN Regression per vedere come profondita e larghezza cambiano il fit.',
            ],
            [
                'label' => 'Vuoi intuizione visiva?',
                'text' => 'Vai su CNN MNIST e disegna cifre per testare l inferenza.',
            ],
        ],
        'cta' => [
            'start_linear' => 'Inizia con Linear Regression',
            'explore_nn' => 'Esplora NN Regression',
        ],
    ],
];
