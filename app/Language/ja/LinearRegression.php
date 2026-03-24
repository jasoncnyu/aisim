<?php

return [
    'title' => '線形回帰の可視化',
    'subtitle' => 'OLS・GD・SGDのインタラクティブシミュレーション。',
    'accordion' => [
        '1' => [
            'title' => '1) 線形回帰が解くこと',
            'p1' => '線形回帰は入力 x と出力 y の直線的な関係を推定します。',
            'equation' => 'y = ax + b',
            'p2' => 'ここで a は傾き、b は切片です。このシミュレータでは、追加した各点が学習サンプルとなり、最適な a と b を見つけます。',
        ],
        '2' => [
            'title' => '2) 誤差関数と MSE を使う理由',
            'p1' => 'モデルは平均二乗誤差（MSE）を最小化します：',
            'equation' => '$$ MSE(a,b) = \\frac{1}{n}\\sum_{i=1}^{n}(y_i-(ax_i+b))^2 $$',
            'p2' => '二乗により大きな誤差が強く罰せられ、滑らかな最適化対象になります。損失が低いほど良い当てはまりです。',
        ],
        '3' => [
            'title' => '3) OLS vs GD vs SGD',
            'ols' => '閉形式解で一括計算。',
            'gd' => '各エポックで全サンプルを使用、安定だが重い。',
            'sgd' => 'シャッフルした単一サンプル更新、高速だがノイズが大きい。',
            'p1' => '同じ点で各手法の学習曲線を比較しましょう。',
        ],
        '4' => [
            'title' => '4) 推奨ワークフロー',
            'step1' => '点を追加するか、デモデータを読み込みます。',
            'step2' => 'まず OLS を実行して基準線を得ます。',
            'step3' => 'GD/SGD に切り替えて学習率とエポックを調整します。',
            'step4' => 'テストモードで実測値と予測値を確認します。',
        ],
    ],
    'controls' => [
        'add_point' => '点を追加',
        'clear_points' => '点をクリア',
        'load_demo' => 'デモデータを読み込む',
        'hint' => 'クリックして点を追加します。点を長押しすると削除できます。',
        'method' => '回帰手法',
        'method_ols' => 'OLS',
        'method_gd' => 'バッチ勾配降下法',
        'method_sgd' => '確率的勾配降下法',
        'learning_rate' => '学習率',
        'epochs' => 'エポック',
        'step_train' => 'ステップ学習',
        'auto_train' => '自動学習',
        'test_mode' => 'テストモード',
    ],
    'loss_title' => '損失（MSE）',
    'model' => [
        'title' => 'モデル',
        'points' => '点数：',
        'slope' => '傾き(a)：',
        'intercept' => '切片(b)：',
        'r2' => 'R2：',
        'last_loss' => '直近の損失：',
    ],
    'notes' => [
        'title' => '手法メモ',
        'ols' => [
            'title' => 'OLS',
            'desc' => '共分散と分散から求める閉形式解：',
            'formula' => '$$ a = \\frac{\\sum (x_i-\\bar{x})(y_i-\\bar{y})}{\\sum (x_i-\\bar{x})^2}, \\quad b = \\bar{y} - a\\bar{x} $$',
        ],
        'gd' => [
            'title' => 'Batch GD',
            'desc' => '全データセットの勾配で更新：',
            'formula' => '$$ a \\leftarrow a - \\eta \\frac{\\partial MSE}{\\partial a}, \\quad b \\leftarrow b - \\eta \\frac{\\partial MSE}{\\partial b} $$',
        ],
        'sgd' => [
            'title' => 'SGD',
            'desc' => 'シャッフルした点でのサンプル単位更新：',
            'formula' => '$$ a \\leftarrow a - \\eta \\cdot 2(ax_j+b-y_j)x_j, \\quad b \\leftarrow b - \\eta \\cdot 2(ax_j+b-y_j) $$',
        ],
    ],
];
