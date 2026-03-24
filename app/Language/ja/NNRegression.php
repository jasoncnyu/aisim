<?php

return [
    'title' => '非線形ニューラル回帰ラボ',
    'subtitle' => '多層パーセプトロンで非線形曲線を当てはめ、過学習による train/val の乖離を観察します。',
    'accordion' => [
        '1' => [
            'title' => '1) モデル定式化',
            'p1' => '線形回帰 y=ax+b と違い、隠れ層で非線形写像 x → y を学習します。',
            'equation' => '$$\\hat{y}=W_L\\,\\phi(W_{L-1}\\phi(\\cdots\\phi(W_1x+b_1)\\cdots)+b_{L-1})+b_L$$',
            'p2' => '深さ・幅・活性化でモデル容量を調整します。',
        ],
        '2' => [
            'title' => '2) 損失と過学習の兆候',
            'p1' => '目的は学習サブセットの MSE です：',
            'equation' => '$$\\text{MSE}=\\frac{1}{n}\\sum_{i=1}^{n}(y_i-\\hat{y}_i)^2$$',
            'p2' => 'train 損失が下がり続け、val 損失が横ばい/上昇すると過学習です。',
        ],
    ],
    'controls' => [
        'add_point' => '点を追加',
        'test_mode' => 'テストモード',
        'clear' => 'クリア',
        'demo' => [
            'sine' => '正弦曲線',
            'cubic' => '三次曲線',
            'piecewise' => '区分曲線',
        ],
        'load_demo' => 'デモ読み込み',
        'hint' => 'クリックでサンプル追加。テストモードでは x をクリックして予測 y と残差を確認します。',
    ],
    'params' => [
        'hidden_layers' => '隠れ層',
        'units_per_layer' => '層あたりユニット',
        'activation' => '活性化',
        'val_ratio' => '検証比率',
        'lr' => 'LR',
        'batch' => 'Batch',
        'epochs' => 'Epochs',
        'l2_reg' => 'L2 正則化',
        'init_model' => 'モデル初期化',
    ],
    'actions' => [
        'step' => 'ステップ',
        'run' => '実行',
        'stop' => '停止',
    ],
    'status' => [
        'title' => '学習ステータス',
        'points' => '点数：',
        'train_val' => 'Train / Val：',
        'epoch' => 'Epoch：',
        'train_loss' => 'Train 損失：',
        'val_loss' => 'Val 損失：',
    ],
    'interpretation' => [
        'title' => '解釈',
        'li1' => '青：訓練、橙：検証。',
        'li2' => 'テストモードの黄色マーカーはクリック点の予測出力です。',
        'li3' => 'train が下がり val が上がる場合は容量過大/学習過多。',
        'li4' => 'L2 を強めるか隠れ層を小さくして過学習を抑えます。',
    ],
];
