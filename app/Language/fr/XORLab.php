<?php

return [
    'title' => 'Laboratoire de réseau neuronal XOR',
    'subtitle' => 'Visualisation des passes avant/arrière d’un petit MLP.',
    'accordion' => [
        '1' => [
            'title' => '1) Pourquoi XOR est un classique',
            'p1' => 'XOR ne se résout pas avec un séparateur linéaire unique.',
            'p2' => 'C’est le problème jouet standard pour montrer couches cachées et activations non linéaires.',
        ],
        '2' => [
            'title' => '2) Structure du réseau',
            'p1' => 'Le simulateur utilise un MLP compact :',
            'structure' => 'Entrée(2) -> Cachée(4) -> Cachée(2) -> Sortie(1)',
            'p2' => 'Activation de sortie sigmoid ; activation cachée tanh ou ReLU.',
        ],
        '3' => [
            'title' => '3) Dynamique d’entraînement',
            'p1' => 'Chaque pas échantillonne un cas XOR, fait un forward, calcule la perte et applique la rétropropagation.',
            'equation1' => '$$ z^{(l)} = a^{(l-1)}W^{(l)} + b^{(l)}, \\quad a^{(l)} = f(z^{(l)}) $$',
            'equation2' => '$$ W \\leftarrow W - \\eta \\nabla_W L, \\quad b \\leftarrow b - \\eta \\nabla_b L $$',
        ],
        '4' => [
            'title' => '4) Lire les visuels',
            'li1' => 'Le graphique de perte montre la convergence.',
            'li2' => 'Le panneau de prédiction montre la confiance pour les 4 entrées XOR.',
            'li3' => 'Le panneau de calcul enregistre les valeurs forward/backward récentes.',
        ],
    ],
    'controls' => [
        'title' => 'Contrôles d’entraînement',
        'learning_rate' => 'Taux d’apprentissage',
        'sleep' => 'Pause (ms)',
        'activation' => 'Activation',
        'step' => '+1 Pas',
        'auto_train' => 'Auto train',
        'reset' => 'Réinitialiser',
        'step_label' => 'Pas :',
        'loss_label' => 'Perte :',
    ],
    'trace_title' => 'Trace avant/arrière',
    'prediction_title' => 'Instantané de prédiction',
    'prediction_hint' => 'Des cercles plus grands indiquent une probabilité plus élevée de la classe 1.',
    'targets_title' => 'Cibles XOR',
    'targets' => [
        'li1' => '(0,0) -> 0',
        'li2' => '(0,1) -> 1',
        'li3' => '(1,0) -> 1',
        'li4' => '(1,1) -> 0',
    ],
];
