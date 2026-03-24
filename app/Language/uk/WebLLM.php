<?php

return [
    'title' => 'Лабораторія Tiny Web LLM',
    'subtitle' => 'Тренуйте невелику модель next-token прямо в браузері та генеруйте текст.',
    'accordion' => [
        '1' => [
            'title' => '1) Чому навчає цей симулятор',
            'p1' => 'Ця сторінка демонструє базову механіку language modeling: токенізацію, контекстні вікна, logits, softmax та градієнтні оновлення.',
            'p2' => 'Він навмисно маленький і навчальний. Ви можете переглядати training loss та порівнювати стратегії декодування, як-от Greedy, Sampling і Top-k.',
        ],
        '2' => [
            'title' => '2) Дизайн моделі',
            'p1' => 'Токени — це слова, розділені пробілами. Модель усереднює embeddings токенів у поточному контексті й проектує їх у logits словника.',
            'equation' => '$$ h = \\frac{1}{K}\\sum E(t_i),\\quad z = W^Th + b,\\quad p = softmax(z) $$',
            'p2' => 'Навчання використовує per-token cross-entropy з простими SGD оновленнями.',
        ],
    ],
    'train' => [
        'title' => '1) Training Corpus',
        'load_demo' => 'Load demo:',
    ],
    'hyper' => [
        'title' => '2) Гіперпараметри',
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
        'title' => '4) Генерація тексту',
        'prompt' => 'Prompt',
        'tokens' => 'Tokens',
        'temperature' => 'Temperature',
        'greedy' => 'Greedy',
        'sampling' => 'Sampling',
        'topk' => 'Top-k',
        'generate' => 'Generate',
    ],
];
