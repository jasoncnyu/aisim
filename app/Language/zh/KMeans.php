<?php

return [
    'title' => 'K-Means 聚类实验',
    'subtitle' => '包含 Voronoi 区域、质心更新与惯性跟踪的 2D 交互式聚类模拟器。',
    'accordion' => [
        '1' => [
            'title' => '1) K-Means 优化什么',
            'p1' => 'K-Means 通过最小化簇内平方距离（惯性）将数据划分为 K 个簇。',
            'equation' => '$$ J = \\sum_{i=1}^{N} \\min_{1 \\leq j \\leq K} \\left\\lVert x_i - \\mu_j \\right\\rVert^2 $$',
            'p2' => '每个样本分配到最近质心，然后质心更新为所分配样本的均值。',
        ],
        '2' => [
            'title' => '2) Lloyd 迭代（分配再更新）',
            'p1' => '算法在两步之间交替：',
            'equation1' => '$$ c_i \\leftarrow \\arg\\min_j \\lVert x_i - \\mu_j \\rVert^2 $$',
            'equation2' => '$$ \\mu_j \\leftarrow \\frac{1}{|C_j|}\\sum_{x_i \\in C_j} x_i $$',
            'p2' => '惯性会单调下降，直到收敛到局部最优。',
        ],
        '3' => [
            'title' => '3) 为什么初始化很重要',
            'p1' => '随机初始化简单，但可能从较差的种子开始。',
            'p2' => 'k-means++ 会分散初始质心，通常带来更快收敛和更低的最终惯性。',
            'p3' => '生产中建议用不同种子多次运行以降低局部最优敏感性。',
        ],
        '4' => [
            'title' => '4) 建议实验流程',
            'step1' => '加载演示点并比较随机初始化与 k-means++。',
            'step2' => '尝试不同 K 值并观察区域边界与簇数量。',
            'step3' => '使用“步进”查看一次分配/更新循环。',
            'step4' => '运行至收敛并比较最终惯性。',
        ],
    ],
    'controls' => [
        'k_label' => 'K：',
        'init_label' => '初始化：',
        'init_random' => '随机',
        'init_plus' => 'k-means++',
        'region_density' => '区域密度：',
        'load_demo' => '加载演示',
        'init_centroids' => '初始化质心',
        'step' => '步进',
        'run' => '运行',
        'stop' => '停止',
        'clear' => '清除',
        'hint' => '点击画布添加点。触屏长按或右键可删除最近点。',
    ],
    'status' => [
        'title' => '状态',
        'points' => '点数：',
        'k' => 'K：',
        'iteration' => '迭代：',
        'inertia' => '惯性：',
        'shift' => '质心位移：',
    ],
    'inertia_title' => '惯性曲线',
    'summary_title' => '簇摘要',
];
