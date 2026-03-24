<?php

return [
    'title' => 'N 槽位老虎机实验',
    'subtitle' => '在随机多臂老虎机中比较探索-利用策略。',
    'accordion' => [
        '1' => [
            'title' => '1) 问题设置',
            'p1' => '每个臂有未知的 Bernoulli 奖励概率。每一步智能体选择一个臂并观察 0 或 1 的奖励。',
        ],
        '2' => [
            'title' => '2) 对比算法',
            'li1_label' => 'Epsilon-Greedy',
            'li1' => '以 epsilon 概率随机探索。',
            'li2_label' => 'UCB1',
            'li2' => '对不确定臂给予乐观奖励。',
            'li3_label' => 'Thompson Sampling',
            'li3' => '通过 Beta 分布进行贝叶斯后验采样。',
        ],
    ],
    'controls' => [
        'algorithm' => '算法',
        'eps_greedy' => 'Epsilon-Greedy',
        'ucb1' => 'UCB1',
        'thompson' => 'Thompson Sampling',
        'arms' => '臂数 (N)',
        'steps' => '步数',
        'runs' => '运行次数',
        'epsilon' => 'Epsilon',
        'seed' => '种子',
        'optional' => '可选',
        'randomize' => '随机化概率',
        'apply' => '应用',
        'run' => '运行',
        'step' => '步进',
        'stop' => '停止',
        'reset' => '重置',
        'export_csv' => '导出 CSV',
    ],
    'charts' => [
        'avg_reward' => '平均奖励',
        'cum_regret' => '累计后悔',
    ],
    'arms' => [
        'title' => '臂（真实概率）',
        'subtitle' => '手动编辑或随机化后点击应用。',
    ],
    'run_info' => [
        'title' => '运行信息',
        'current_run' => '当前运行：',
        'step' => '步数：',
        'avg_reward' => '平均奖励：',
        'cum_regret' => '累计后悔：',
    ],
];
