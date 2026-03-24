<?php

return [
    'title' => 'Laboratorio CNN Binaria',
    'subtitle' => 'Piccola rete neurale convoluzionale per classificazione di immagini a due classi con visualizzazione di filtri e feature map.',
    'accordion' => [
        '1' => [
            'title' => '1) Architettura del modello',
            'p1' => 'Questa pagina allena una CNN compatta: Conv(3x3) -> ReLU -> Flatten -> Dense -> ReLU -> Dense -> Softmax.',
            'p2' => 'Le immagini in input sono convertite in scala di grigi e ridimensionate a 32x32, quindi ogni campione e un vettore 1024-dimensionale prima della convoluzione.',
            'p3' => 'Le etichette binarie sono mappate a probabilita di classe: P(classe 1) e P(classe 2).',
        ],
        '2' => [
            'title' => '2) Obiettivo di apprendimento',
            'p1' => 'La rete e ottimizzata con cross-entropy su due classi:',
            'equation' => '$$ L = -\\frac{1}{N}\\sum_{i=1}^{N}\\sum_{c=1}^{2} y_{ic}\\log(\\hat{y}_{ic}) $$',
            'p2' => 'Usa un learning rate piu basso per una convergenza stabile, o piu alto per aggiornamenti piu veloci ma rumorosi.',
        ],
        '3' => [
            'title' => '3) Workflow suggerito',
            'step1' => 'Carica immagini demo di gatto/cane o carica file personalizzati in ciascun bucket di classe.',
            'step2' => 'Inizializza i pesi, esegui alcune epoche e monitora loss e accuratezza.',
            'step3' => 'Controlla i valori dei filtri e le feature map per capire cosa cattura il primo strato conv.',
            'step4' => 'Carica un immagine di test e ispeziona le probabilita di classe.',
        ],
    ],
    'controls' => [
        'load_demo' => 'Carica dati demo',
        'init_weights' => 'Inizializza pesi',
        'step' => 'Step (1 epoca)',
        'run' => 'Esegui',
        'stop' => 'Stop',
        'reset' => 'Reset',
        'lr' => 'LR:',
        'epochs' => 'Epoche:',
        'batch' => 'Batch:',
    ],
    'metrics' => [
        'dataset' => 'Dataset:',
        'epoch' => 'Epoca:',
        'loss' => 'Loss:',
        'accuracy' => 'Accuratezza:',
    ],
    'training_images_title' => 'Immagini di training',
    'class1_label' => 'Classe 1 (label 0)',
    'class2_label' => 'Classe 2 (label 1)',
    'upload_hint' => 'Le immagini caricate sono ridimensionate a 32x32 in scala di grigi prima del training.',
    'loading_images' => 'Caricamento immagini...',
    'conv_filters_title' => 'Filtri conv (tempo reale)',
    'prediction_title' => 'Predizione',
    'predict_button' => 'Predici immagine caricata',
    'feature_maps_title' => 'Feature map (strato conv)',
];
