<?php

return [
    'title' => 'Tiny Web LLM Lab',
    'subtitle' => 'Treine um pequeno modelo next-token no navegador e gere texto.',
    'accordion' => [
        '1' => [
            'title' => '1) O que este simulador ensina',
            'p1' => 'Esta página demonstra a mecânica central de modelos de linguagem: tokenização, janelas de contexto, logits, softmax e atualizações por gradiente.',
            'p2' => 'É propositalmente pequeno e educativo. Você pode inspecionar a loss e comparar Greedy, Sampling e Top-k.',
        ],
        '2' => [
            'title' => '2) Design do modelo',
            'p1' => 'Tokens são palavras separadas por espaço. O modelo faz a média dos embeddings no contexto e projeta para logits do vocabulário.',
            'equation' => '$$ h = \\frac{1}{K}\\sum E(t_i),\\quad z = W^Th + b,\\quad p = softmax(z) $$',
            'p2' => 'O treinamento usa cross-entropy por token com atualizações simples de SGD.',
        ],
    ],
    'train' => [
        'title' => '1) Corpus de treinamento',
        'load_demo' => 'Carregar demo:',
    ],
    'hyper' => [
        'title' => '2) Hiperparâmetros',
        'embed' => 'Tamanho do embedding',
        'context' => 'Comprimento do contexto',
        'epochs' => 'Épocas',
        'lr' => 'Learning Rate',
        'train_embeddings' => 'Treinar embeddings',
    ],
    'run' => [
        'title' => '3) Execução de treinamento',
        'start' => 'Iniciar treinamento',
        'stop' => 'Parar',
    ],
    'generate' => [
        'title' => '4) Geração de texto',
        'prompt' => 'Prompt',
        'tokens' => 'Tokens',
        'temperature' => 'Temperatura',
        'greedy' => 'Greedy',
        'sampling' => 'Sampling',
        'topk' => 'Top-k',
        'generate' => 'Gerar',
    ],
];
