<?php

return [
    'title' => 'Tiny Web LLM 实验',
    'subtitle' => '在浏览器中训练小型 next-token 模型并生成文本。',
    'accordion' => [
        '1' => [
            'title' => '1) 这个模拟器教什么',
            'p1' => '展示语言模型核心机制：分词、上下文窗口、logits、softmax 与基于梯度的更新。',
            'p2' => '这是一个很小的教学示例。你可以查看训练损失并比较 Greedy、Sampling、Top-k。',
        ],
        '2' => [
            'title' => '2) 模型设计',
            'p1' => 'Token 由空格分词。模型对当前上下文的 token embedding 求平均并投影为词表 logits。',
            'equation' => '$$ h = \\frac{1}{K}\\sum E(t_i),\\quad z = W^Th + b,\\quad p = softmax(z) $$',
            'p2' => '训练使用逐 token 交叉熵与简单 SGD 更新。',
        ],
    ],
    'train' => [
        'title' => '1) 训练语料',
        'load_demo' => '加载示例:',
    ],
    'hyper' => [
        'title' => '2) 超参数',
        'embed' => 'Embedding 大小',
        'context' => '上下文长度',
        'epochs' => 'Epochs',
        'lr' => '学习率',
        'train_embeddings' => '训练 Embedding',
    ],
    'run' => [
        'title' => '3) 训练运行',
        'start' => '开始训练',
        'stop' => '停止',
    ],
    'generate' => [
        'title' => '4) 文本生成',
        'prompt' => 'Prompt',
        'tokens' => 'Tokens',
        'temperature' => 'Temperature',
        'greedy' => 'Greedy',
        'sampling' => 'Sampling',
        'topk' => 'Top-k',
        'generate' => '生成',
    ],
];
