<?php

return [
    'title' => 'Tiny Web LLM Lab',
    'subtitle' => 'Entraînez un petit modèle next-token dans le navigateur et générez du texte.',
    'accordion' => [
        '1' => [
            'title' => '1) Ce que ce simulateur enseigne',
            'p1' => 'Cette page montre les mécanismes clés des modèles de langage : tokenisation, contexte, logits, softmax et mises à jour par gradient.',
            'p2' => 'C’est volontairement petit et pédagogique. Vous pouvez inspecter la loss et comparer Greedy, Sampling et Top-k.',
        ],
        '2' => [
            'title' => '2) Conception du modèle',
            'p1' => 'Les tokens sont des mots séparés par des espaces. Le modèle moyenne les embeddings du contexte et les projette en logits.',
            'equation' => '$$ h = \\frac{1}{K}\\sum E(t_i),\\quad z = W^Th + b,\\quad p = softmax(z) $$',
            'p2' => 'L’entraînement utilise la cross-entropy par token avec des mises à jour SGD simples.',
        ],
    ],
    'train' => [
        'title' => '1) Corpus d’entraînement',
        'load_demo' => 'Charger une démo :',
    ],
    'hyper' => [
        'title' => '2) Hyperparamètres',
        'embed' => 'Taille des embeddings',
        'context' => 'Longueur de contexte',
        'epochs' => 'Époques',
        'lr' => 'Learning Rate',
        'train_embeddings' => 'Entraîner les embeddings',
    ],
    'run' => [
        'title' => '3) Exécution de l’entraînement',
        'start' => 'Démarrer l’entraînement',
        'stop' => 'Stop',
    ],
    'generate' => [
        'title' => '4) Génération de texte',
        'prompt' => 'Prompt',
        'tokens' => 'Tokens',
        'temperature' => 'Température',
        'greedy' => 'Greedy',
        'sampling' => 'Sampling',
        'topk' => 'Top-k',
        'generate' => 'Générer',
    ],
];
