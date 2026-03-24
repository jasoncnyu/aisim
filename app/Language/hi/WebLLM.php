<?php

return [
    'title' => 'Tiny Web LLM Lab',
    'subtitle' => 'ब्राउज़र में छोटा next-token मॉडल ट्रेन करें और टेक्स्ट जनरेट करें।',
    'accordion' => [
        '1' => [
            'title' => '1) यह सिमुलेटर क्या सिखाता है',
            'p1' => 'यह पेज language modeling की core mechanics दिखाता है: tokenization, context windows, logits, softmax और gradient-based updates।',
            'p2' => 'यह जानबूझकर छोटा और शिक्षात्मक है। आप training loss देख सकते हैं और Greedy, Sampling, Top-k जैसी decoding strategies तुलना कर सकते हैं।',
        ],
        '2' => [
            'title' => '2) Model Design',
            'p1' => 'Tokens space-split words हैं। मॉडल current context में token embeddings का average लेता है और vocabulary logits पर project करता है।',
            'equation' => '$$ h = \\frac{1}{K}\\sum E(t_i),\\quad z = W^Th + b,\\quad p = softmax(z) $$',
            'p2' => 'Training per-token cross-entropy और simple SGD updates से होता है।',
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
