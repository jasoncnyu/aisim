<?php

return [
    'title' => 'Tiny Web LLM ラボ',
    'subtitle' => 'ブラウザ上で小さな next-token モデルを学習しテキスト生成します。',
    'accordion' => [
        '1' => [
            'title' => '1) このシミュレータが教えること',
            'p1' => 'トークン化、コンテキスト、logits、softmax、勾配更新などLMの基本を示します。',
            'p2' => '教育用の小さなデモです。損失を確認し Greedy、Sampling、Top-k を比較します。',
        ],
        '2' => [
            'title' => '2) モデル設計',
            'p1' => 'トークンは空白区切りの単語です。文脈の埋め込みを平均し語彙 logits に投影します。',
            'equation' => '$$ h = \\frac{1}{K}\\sum E(t_i),\\quad z = W^Th + b,\\quad p = softmax(z) $$',
            'p2' => '学習はトークンごとの交差エントロピーと簡易 SGD を使用します。',
        ],
    ],
    'train' => [
        'title' => '1) 学習コーパス',
        'load_demo' => 'デモ読み込み:',
    ],
    'hyper' => [
        'title' => '2) ハイパーパラメータ',
        'embed' => '埋め込みサイズ',
        'context' => '文脈長',
        'epochs' => 'エポック',
        'lr' => '学習率',
        'train_embeddings' => '埋め込みを学習',
    ],
    'run' => [
        'title' => '3) 学習実行',
        'start' => '学習開始',
        'stop' => '停止',
    ],
    'generate' => [
        'title' => '4) テキスト生成',
        'prompt' => 'プロンプト',
        'tokens' => 'トークン',
        'temperature' => '温度',
        'greedy' => 'Greedy',
        'sampling' => 'Sampling',
        'topk' => 'Top-k',
        'generate' => '生成',
    ],
];
