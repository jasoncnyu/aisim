<?php

return [
    'title' => 'مختبر Tiny Web LLM',
    'subtitle' => 'درّب نموذج next-token صغير في المتصفح وولّد نصًا.',
    'accordion' => [
        '1' => [
            'title' => '1) ما الذي يعلّمه هذا المحاكي',
            'p1' => 'يعرض آليات نمذجة اللغة الأساسية: التجزئة، نوافذ السياق، logits، softmax، والتحديثات بالانحدار.',
            'p2' => 'هو صغير وتعليمي. يمكنك فحص الخسارة ومقارنة Greedy وSampling وTop-k.',
        ],
        '2' => [
            'title' => '2) تصميم النموذج',
            'p1' => 'التوكنات كلمات مفصولة بمسافات. النموذج يأخذ متوسط embeddings للسياق ويُسقطها إلى logits المفردات.',
            'equation' => '$$ h = \\frac{1}{K}\\sum E(t_i),\\quad z = W^Th + b,\\quad p = softmax(z) $$',
            'p2' => 'التدريب يستخدم cross-entropy لكل توكن مع تحديثات SGD بسيطة.',
        ],
    ],
    'train' => [
        'title' => '1) كوربس التدريب',
        'load_demo' => 'تحميل demo:',
    ],
    'hyper' => [
        'title' => '2) الهايبر باراميترز',
        'embed' => 'حجم الـEmbedding',
        'context' => 'طول السياق',
        'epochs' => 'عصور',
        'lr' => 'معدل التعلم',
        'train_embeddings' => 'تدريب الـEmbeddings',
    ],
    'run' => [
        'title' => '3) تشغيل التدريب',
        'start' => 'بدء التدريب',
        'stop' => 'إيقاف',
    ],
    'generate' => [
        'title' => '4) توليد النص',
        'prompt' => 'Prompt',
        'tokens' => 'Tokens',
        'temperature' => 'Temperature',
        'greedy' => 'Greedy',
        'sampling' => 'Sampling',
        'topk' => 'Top-k',
        'generate' => 'توليد',
    ],
];
