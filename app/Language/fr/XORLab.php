<?php

return [
    'title' => 'Laboratoire de reseau neuronal XOR',
    'subtitle' => 'Visualisation des passes avant/arriere d¡¯un petit MLP.',
    'accordion' => [
        '1' => [
            'title' => '1) Pourquoi XOR est un classique',
            'p1' => 'XOR ne se resout pas avec un separateur lineaire unique.',
            'p2' => 'C¡¯est le probleme jouet standard pour montrer couches cachees et activations non lineaires.',
        ],
        '2' => [
            'title' => '2) Structure du reseau',
            'p1' => 'Le simulateur utilise un MLP compact :',
            'structure' => 'Entree(2) -> Cachee(4) -> Cachee(2) -> Sortie(1)',
            'p2' => 'Activation de sortie sigmoid ; activation cachee tanh ou ReLU.',
        ],
        '3' => [
            'title' => '3) Dynamique d¡¯entrainement',
            'p1' => 'Chaque pas echantillonne un cas XOR, fait un forward, calcule la perte et applique la retropropagation.',
            'equation1' => '$$ z^{(l)} = a^{(l-1)}W^{(l)} + b^{(l)}, \\quad a^{(l)} = f(z^{(l)}) $$',
            'equation2' => '$$ W \\leftarrow W - \\eta \\nabla_W L, \\quad b \\leftarrow b - \\eta \\nabla_b L $$',
        ],
        '4' => [
            'title' => '4) Lire les visuels',
            'li1' => 'Le graphique de perte montre la convergence.',
            'li2' => 'Le panneau de prediction montre la confiance pour les 4 entrees XOR.',
            'li3' => 'Le panneau de calcul enregistre les valeurs forward/backward recentes.',
        ],
    ],
    'controls' => [
        'title' => 'Controles d¡¯entrainement',
        'learning_rate' => 'Taux d¡¯apprentissage',
        'sleep' => 'Pause (ms)',
        'activation' => 'Activation',
        'step' => '+1 Pas',
        'auto_train' => 'Auto train',
        'reset' => 'Reinitialiser',
        'step_label' => 'Pas :',
        'loss_label' => 'Perte :',
    ],
    'trace_title' => 'Trace avant/arriere',
    'prediction_title' => 'Instantane de prediction',
    'prediction_hint' => 'Des cercles plus grands indiquent une probabilite plus elevee de la classe 1.',
    'targets_title' => 'Cibles XOR',
    'targets' => [
        'li1' => '(0,0) -> 0',
        'li2' => '(0,1) -> 1',
        'li3' => '(1,0) -> 1',
        'li4' => '(1,1) -> 0',
    ],
];
