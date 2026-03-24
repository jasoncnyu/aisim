<?php

return [
    'title' => 'XOR ニューラルネットラボ',
    'subtitle' => '小さな MLP の forward/backward を可視化します。',
    'accordion' => [
        '1' => [
            'title' => '1) XOR が古典的デモである理由',
            'p1' => 'XOR は単一の線形分離器では解けません。',
            'p2' => 'そのため隠れ層と非線形活性化の定番デモです。',
        ],
        '2' => [
            'title' => '2) ここで使う構造',
            'p1' => 'このシミュレータはコンパクトな MLP を使用します：',
            'structure' => '入力(2) -> 隠れ(4) -> 隠れ(2) -> 出力(1)',
            'p2' => '出力は sigmoid、隠れは tanh / ReLU を使用します。',
        ],
        '3' => [
            'title' => '3) 学習ダイナミクス',
            'p1' => '各ステップで XOR ケースをサンプルし、forward→損失計算→backprop 更新を行います。',
            'equation1' => '$$ z^{(l)} = a^{(l-1)}W^{(l)} + b^{(l)}, \\quad a^{(l)} = f(z^{(l)}) $$',
            'equation2' => '$$ W \\leftarrow W - \\eta \\nabla_W L, \\quad b \\leftarrow b - \\eta \\nabla_b L $$',
        ],
        '4' => [
            'title' => '4) 可視化の読み方',
            'li1' => '損失チャートは収束トレンドを示します。',
            'li2' => '予測パネルは 4 つの XOR 入力の出力確信度を表示。',
            'li3' => '計算パネルは最新の forward/backward 値を記録。',
        ],
    ],
    'controls' => [
        'title' => '学習コントロール',
        'learning_rate' => '学習率',
        'sleep' => 'スリープ(ms)',
        'activation' => '活性化',
        'step' => '+1 ステップ',
        'auto_train' => '自動学習',
        'reset' => 'リセット',
        'step_label' => 'ステップ：',
        'loss_label' => '損失：',
    ],
    'trace_title' => 'Forward/Backward トレース',
    'prediction_title' => '予測スナップショット',
    'prediction_hint' => '円が大きいほどクラス1の確率が高いことを示します。',
    'targets_title' => 'XOR ターゲット',
    'targets' => [
        'li1' => '(0,0) -> 0',
        'li2' => '(0,1) -> 1',
        'li3' => '(1,0) -> 1',
        'li4' => '(1,1) -> 0',
    ],
];
