<?php

return [
    'title' => 'Laboratorio Tiny Web LLM',
    'subtitle' => 'Entrena un pequeño modelo de next-token en el navegador y genera texto.',
    'accordion' => [
        '1' => [
            'title' => '1) Qué enseña este simulador',
            'p1' => 'Esta página demuestra mecánicas clave del modelado de lenguaje: tokenización, ventanas de contexto, logits, softmax y actualizaciones por gradiente.',
            'p2' => 'Es intencionalmente pequeño y educativo. Puedes inspeccionar la pérdida y comparar Greedy, Sampling y Top-k.',
        ],
        '2' => [
            'title' => '2) Diseño del modelo',
            'p1' => 'Los tokens son palabras separadas por espacios. El modelo promedia embeddings del contexto y los proyecta a logits del vocabulario.',
            'equation' => '$$ h = \\frac{1}{K}\\sum E(t_i),\\quad z = W^Th + b,\\quad p = softmax(z) $$',
            'p2' => 'El entrenamiento usa cross-entropy por token con actualizaciones SGD simples.',
        ],
    ],
    'train' => [
        'title' => '1) Corpus de entrenamiento',
        'load_demo' => 'Cargar demo:',
    ],
    'hyper' => [
        'title' => '2) Hiperparámetros',
        'embed' => 'Tamaño de embedding',
        'context' => 'Longitud de contexto',
        'epochs' => 'Épocas',
        'lr' => 'Learning Rate',
        'train_embeddings' => 'Entrenar embeddings',
    ],
    'run' => [
        'title' => '3) Ejecución de entrenamiento',
        'start' => 'Iniciar entrenamiento',
        'stop' => 'Detener',
    ],
    'generate' => [
        'title' => '4) Generación de texto',
        'prompt' => 'Prompt',
        'tokens' => 'Tokens',
        'temperature' => 'Temperatura',
        'greedy' => 'Greedy',
        'sampling' => 'Sampling',
        'topk' => 'Top-k',
        'generate' => 'Generar',
    ],
];
