<?php

return [
    'title' => 'Tiny Web LLM Lab',
    'subtitle' => 'Train a small next-token model directly in the browser and generate text.',
    'accordion' => [
        '1' => [
            'title' => '1) What This Simulator Teaches',
            'p1' => 'This page demonstrates the core mechanics of language modeling: tokenization, context windows, logits, softmax, and gradient-based updates.',
            'p2' => 'It is intentionally tiny and educational. You can inspect training loss and compare decoding strategies such as Greedy, Sampling, and Top-k.',
        ],
        '2' => [
            'title' => '2) Model Design',
            'p1' => 'Tokens are space-split words. The model averages token embeddings in the current context and projects them to vocabulary logits.',
            'equation' => '$$ h = \\frac{1}{K}\\sum E(t_i),\\quad z = W^Th + b,\\quad p = softmax(z) $$',
            'p2' => 'Training uses per-token cross-entropy with simple SGD updates.',
        ],
    ],
    'train' => [
        'title' => '1) Training Corpus',
        'load_demo' => 'Load demo:',
    ],
    'hyper' => [
        'title' => '2) Hyperparameters',
        'embed' => 'Embedding Size',
        'context' => 'Context Length',
        'epochs' => 'Epochs',
        'lr' => 'Learning Rate',
        'train_embeddings' => 'Train Embeddings',
    ],
    'run' => [
        'title' => '3) Training Run',
        'start' => 'Start Training',
        'stop' => 'Stop',
    ],
    'generate' => [
        'title' => '4) Text Generation',
        'prompt' => 'Prompt',
        'tokens' => 'Tokens',
        'temperature' => 'Temperature',
        'greedy' => 'Greedy',
        'sampling' => 'Sampling',
        'topk' => 'Top-k',
        'generate' => 'Generate',
    ],
];
