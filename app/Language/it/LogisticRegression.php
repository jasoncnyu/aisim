<?php

return [
    'title' => 'Laboratorio visivo di regressione logistica',
    'subtitle' => 'Simulazione di classificazione binaria con apprendimento del confine sigmoide.',
    'accordion' => [
        '1' => [
            'title' => '1) Cosa fa la regressione logistica',
            'p1' => 'La regressione logistica predice la probabilita di appartenenza di classe per target binari.',
            'equation' => '$$ \\hat{y} = \\sigma(z), \\quad z = mx + b, \\quad \\sigma(z)=\\frac{1}{1+e^{-z}} $$',
            'p2' => 'Il modello produce valori tra 0 e 1. Una soglia come 0.5 converte la probabilita in etichette di classe.',
        ],
        '2' => [
            'title' => '2) Funzione obiettivo (Binary Cross-Entropy)',
            'p1' => 'L obiettivo di training minimizza la negative log likelihood:',
            'equation' => '$$ L(m,b)=-\\frac{1}{n}\\sum_{i=1}^{n}\\left[y_i\\log(\\hat{y_i})+(1-y_i)\\log(1-\\hat{y_i})\\right] $$',
            'p2' => 'Questa loss penalizza molto le previsioni sbagliate ma confidenti, migliorando la calibrazione delle probabilita.',
        ],
        '3' => [
            'title' => '3) Aggiornamenti del gradiente',
            'p1' => 'Per la regressione logistica a una feature, i gradienti batch sono:',
            'equation1' => '$$ \\frac{\\partial L}{\\partial m}=\\frac{1}{n}\\sum(\\hat{y_i}-y_i)x_i,\\quad \\frac{\\partial L}{\\partial b}=\\frac{1}{n}\\sum(\\hat{y_i}-y_i) $$',
            'equation2' => '$$ m \\leftarrow m-\\eta\\frac{\\partial L}{\\partial m},\\quad b \\leftarrow b-\\eta\\frac{\\partial L}{\\partial b} $$',
            'p2' => 'Learning rate piu bassi migliorano la stabilita, mentre rate piu alti convergono piu in fretta ma possono oscillare.',
        ],
        '4' => [
            'title' => '4) Workflow pratico',
            'step1' => 'Aggiungi punti di classe manualmente (banda bassa per classe 0, banda alta per classe 1) o carica dati casuali.',
            'step2' => 'Allena con Auto Train e monitora la diminuzione della loss.',
            'step3' => 'Usa Step per osservare il comportamento per iterazione.',
            'step4' => 'Abilita Test Mode e clicca per vedere la probabilita prevista in ogni posizione di input.',
        ],
    ],
    'controls' => [
        'generate_data' => 'Genera dati di esempio',
        'auto_train' => 'Auto Train',
        'step' => 'Step',
        'test_mode' => 'Test Mode',
        'reset' => 'Reset',
        'learning_rate' => 'LR:',
        'hint' => 'Clicca sulla canvas per aggiungere punti. I punti vicino a y=0 rappresentano la classe 0 e quelli vicino a y=1 la classe 1.',
    ],
    'loss_title' => 'Curva di loss',
    'interpretation' => [
        'title' => 'Guida all interpretazione',
        'li1' => 'La curva gialla a S e la funzione di probabilita appresa.',
        'li2' => 'I punti rossi sono classe 1, i punti ciano sono classe 0.',
        'li3' => 'La zona di transizione centrale approssima il confine decisionale.',
        'li4' => 'La loss che diminuisce indica maggiore confidenza nella classificazione.',
    ],
];
