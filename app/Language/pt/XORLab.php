<?php

return [
    'title' => 'Laboratorio de rede neural XOR',
    'subtitle' => 'Visualizacao do forward/backward de um MLP pequeno.',
    'accordion' => [
        '1' => [
            'title' => '1) Por que XOR e classico',
            'p1' => 'XOR nao pode ser resolvido por um separador linear unico.',
            'p2' => 'Por isso e o problema padrao para demonstrar camadas ocultas e ativacoes nao lineares.',
        ],
        '2' => [
            'title' => '2) Estrutura da rede usada',
            'p1' => 'O simulador usa um MLP compacto:',
            'structure' => 'Entrada(2) -> Oculta(4) -> Oculta(2) -> Saida(1)',
            'p2' => 'Ativacao de saida e sigmoid; a oculta pode ser tanh ou ReLU.',
        ],
        '3' => [
            'title' => '3) Dinamica de treino',
            'p1' => 'Cada passo amostra um caso XOR, faz forward, calcula perda e aplica backprop.',
            'equation1' => '$$ z^{(l)} = a^{(l-1)}W^{(l)} + b^{(l)}, \\quad a^{(l)} = f(z^{(l)}) $$',
            'equation2' => '$$ W \\leftarrow W - \\eta \\nabla_W L, \\quad b \\leftarrow b - \\eta \\nabla_b L $$',
        ],
        '4' => [
            'title' => '4) Como ler os visuais',
            'li1' => 'O grafico de perda mostra a convergencia ao longo dos passos.',
            'li2' => 'O painel de predicao mostra a confianca nos quatro inputs XOR.',
            'li3' => 'O painel de calculo registra os ultimos valores forward/backward.',
        ],
    ],
    'controls' => [
        'title' => 'Controles de treino',
        'learning_rate' => 'Taxa de aprendizado',
        'sleep' => 'Pausa (ms)',
        'activation' => 'Ativacao',
        'step' => '+1 Passo',
        'auto_train' => 'Treino automatico',
        'reset' => 'Reset',
        'step_label' => 'Passo:',
        'loss_label' => 'Perda:',
    ],
    'trace_title' => 'Rastro forward/backward',
    'prediction_title' => 'Snapshot de predicao',
    'prediction_hint' => 'Circulos maiores indicam maior probabilidade da classe 1.',
    'targets_title' => 'Alvos XOR',
    'targets' => [
        'li1' => '(0,0) -> 0',
        'li2' => '(0,1) -> 1',
        'li3' => '(1,0) -> 1',
        'li4' => '(1,1) -> 0',
    ],
];
