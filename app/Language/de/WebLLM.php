<?php

return [
    'title' => 'Tiny Web LLM Labor',
    'subtitle' => 'Trainieren Sie ein kleines Next-Token-Modell im Browser und generieren Sie Text.',
    'accordion' => [
        '1' => [
            'title' => '1) Was dieser Simulator lehrt',
            'p1' => 'Diese Seite zeigt die Kernmechanik von Sprachmodellen: Tokenisierung, Kontextfenster, Logits, Softmax und gradientenbasierte Updates.',
            'p2' => 'Absichtlich klein und lehrreich. Sie können die Loss prüfen und Greedy, Sampling und Top-k vergleichen.',
        ],
        '2' => [
            'title' => '2) Modelldesign',
            'p1' => 'Tokens sind durch Leerzeichen getrennte Wörter. Das Modell mittelt Embeddings im Kontext und projiziert auf Vokabular-Logits.',
            'equation' => '$$ h = \\frac{1}{K}\\sum E(t_i),\\quad z = W^Th + b,\\quad p = softmax(z) $$',
            'p2' => 'Training nutzt Token-Cross-Entropy mit einfachen SGD-Updates.',
        ],
    ],
    'train' => [
        'title' => '1) Trainingskorpus',
        'load_demo' => 'Demo laden:',
    ],
    'hyper' => [
        'title' => '2) Hyperparameter',
        'embed' => 'Embedding-Größe',
        'context' => 'Kontextlänge',
        'epochs' => 'Epochen',
        'lr' => 'Learning Rate',
        'train_embeddings' => 'Embeddings trainieren',
    ],
    'run' => [
        'title' => '3) Trainingslauf',
        'start' => 'Training starten',
        'stop' => 'Stopp',
    ],
    'generate' => [
        'title' => '4) Textgenerierung',
        'prompt' => 'Prompt',
        'tokens' => 'Tokens',
        'temperature' => 'Temperatur',
        'greedy' => 'Greedy',
        'sampling' => 'Sampling',
        'topk' => 'Top-k',
        'generate' => 'Generieren',
    ],
];
