<?php

return [
    'title' => 'N-スロットバンディット実験',
    'subtitle' => '確率的マルチアームドバンディットで探索と活用を比較します。',
    'accordion' => [
        '1' => [
            'title' => '1) 問題設定',
            'p1' => '各アームは未知のベルヌーイ報酬確率を持ちます。各ステップで1本のアームを選び、0または1の報酬を観測します。',
        ],
        '2' => [
            'title' => '2) 比較アルゴリズム',
            'li1_label' => 'Epsilon-Greedy',
            'li1' => 'epsilon 確率でランダム探索。',
            'li2_label' => 'UCB1',
            'li2' => '不確実なアームに楽観ボーナス。',
            'li3_label' => 'Thompson Sampling',
            'li3' => 'Beta分布によるベイズ事後サンプリング。',
        ],
    ],
    'controls' => [
        'algorithm' => 'アルゴリズム',
        'eps_greedy' => 'Epsilon-Greedy',
        'ucb1' => 'UCB1',
        'thompson' => 'Thompson Sampling',
        'arms' => 'アーム数 (N)',
        'steps' => 'ステップ',
        'runs' => '実行回数',
        'epsilon' => 'Epsilon',
        'seed' => 'シード',
        'optional' => '任意',
        'randomize' => '確率をランダム化',
        'apply' => '適用',
        'run' => '実行',
        'step' => 'ステップ',
        'stop' => '停止',
        'reset' => 'リセット',
        'export_csv' => 'CSVを出力',
    ],
    'charts' => [
        'avg_reward' => '平均報酬',
        'cum_regret' => '累積後悔',
    ],
    'arms' => [
        'title' => 'アーム（真の確率）',
        'subtitle' => '手動編集またはランダム化してから適用をクリック。',
    ],
    'run_info' => [
        'title' => '実行情報',
        'current_run' => '現在の実行:',
        'step' => 'ステップ:',
        'avg_reward' => '平均報酬:',
        'cum_regret' => '累積後悔:',
    ],
];
