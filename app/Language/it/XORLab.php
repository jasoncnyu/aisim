<?php

return [
    'title' => 'Laboratorio rete neurale XOR',
    'subtitle' => 'Visualizzazione del forward/backward pass per un piccolo percettrone multistrato.',
    'accordion' => [
        '1' => [
            'title' => '1) Perche XOR e un demo classico',
            'p1' => 'XOR non puo essere risolto da un singolo separatore lineare. Un modello deve apprendere una superficie decisionale non lineare.',
            'p2' => 'Questo rende XOR il problema giocattolo standard per dimostrare strati nascosti e attivazioni non lineari.',
        ],
        '2' => [
            'title' => '2) Struttura della rete usata qui',
            'p1' => 'Il simulatore usa un MLP compatto:',
            'structure' => 'Input(2) -> Hidden(4) -> Hidden(2) -> Output(1)',
            'p2' => 'L attivazione di output e sigmoide per probabilita binaria. L attivazione nascosta puo essere tanh o ReLU.',
        ],
        '3' => [
            'title' => '3) Dinamica di training',
            'p1' => 'Ogni step campiona un caso XOR, esegue un forward pass, calcola la loss e poi applica backprop.',
            'equation1' => '$$ z^{(l)} = a^{(l-1)}W^{(l)} + b^{(l)}, \\quad a^{(l)} = f(z^{(l)}) $$',
            'equation2' => '$$ W \\leftarrow W - \\eta \\nabla_W L, \\quad b \\leftarrow b - \\eta \\nabla_b L $$',
        ],
        '4' => [
            'title' => '4) Come leggere le visualizzazioni',
            'li1' => 'Il grafico della loss mostra il trend di convergenza durante il training.',
            'li2' => 'Il pannello di predizione mostra la confidenza di output per tutti e quattro gli input XOR.',
            'li3' => 'Il pannello di calcolo registra gli ultimi valori forward/backward per ispezione.',
        ],
    ],
    'controls' => [
        'title' => 'Controlli di training',
        'learning_rate' => 'Learning Rate',
        'sleep' => 'Sleep (ms)',
        'activation' => 'Attivazione',
        'step' => '+1 Step',
        'auto_train' => 'Auto Train',
        'reset' => 'Reset',
        'step_label' => 'Step:',
        'loss_label' => 'Loss:',
    ],
    'trace_title' => 'Trace forward/backward',
    'prediction_title' => 'Snapshot predizione',
    'prediction_hint' => 'Cerchi piu grandi indicano maggiore probabilita di output vicino alla classe 1.',
    'targets_title' => 'Target XOR',
    'targets' => [
        'li1' => '(0,0) -> 0',
        'li2' => '(0,1) -> 1',
        'li3' => '(1,0) -> 1',
        'li4' => '(1,1) -> 0',
    ],
];
