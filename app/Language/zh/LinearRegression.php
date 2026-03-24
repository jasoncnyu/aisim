<?php

return [
    'title' => '线性回归可视化',
    'subtitle' => 'OLS、GD 和 SGD 的交互式模拟。',
    'accordion' => [
        '1' => [
            'title' => '1) 线性回归解决什么',
            'p1' => '线性回归拟合输入 x 与输出 y 之间的直线关系。',
            'equation' => 'y = ax + b',
            'p2' => '其中 a 是斜率，b 是截距。在本模拟器中，添加的每个点都是训练样本，模型会找到最优的 a 和 b。',
        ],
        '2' => [
            'title' => '2) 误差函数与为何使用 MSE',
            'p1' => '模型最小化均方误差（MSE）：',
            'equation' => '$$ MSE(a,b) = \\frac{1}{n}\\sum_{i=1}^{n}(y_i-(ax_i+b))^2 $$',
            'p2' => '平方会更强地惩罚大误差，并提供平滑的优化目标。损失越低，拟合越好。',
        ],
        '3' => [
            'title' => '3) OLS vs GD vs SGD',
            'ols' => '闭式解，一步到位。',
            'gd' => '每个 epoch 使用全部样本，稳定但更重。',
            'sgd' => '使用打乱的单样本更新，更快但更噪。',
            'p1' => '使用相同的点比较各方法的学习曲线。',
        ],
        '4' => [
            'title' => '4) 推荐工作流程',
            'step1' => '添加点或加载演示数据。',
            'step2' => '先执行 OLS 得到基准直线。',
            'step3' => '切换到 GD/SGD 并调整学习率与 epoch。',
            'step4' => '使用测试模式查看真实值与预测值。',
        ],
    ],
    'controls' => [
        'add_point' => '添加点',
        'clear_points' => '清除点',
        'load_demo' => '加载演示数据',
        'hint' => '点击添加点。长按某个点可移除。',
        'method' => '回归方法',
        'method_ols' => 'OLS',
        'method_gd' => '批量梯度下降',
        'method_sgd' => '随机梯度下降',
        'learning_rate' => '学习率',
        'epochs' => 'Epoch',
        'step_train' => '步进训练',
        'auto_train' => '自动训练',
        'test_mode' => '测试模式',
    ],
    'loss_title' => '损失（MSE）',
    'model' => [
        'title' => '模型',
        'points' => '点数：',
        'slope' => '斜率(a)：',
        'intercept' => '截距(b)：',
        'r2' => 'R2：',
        'last_loss' => '最近损失：',
    ],
    'notes' => [
        'title' => '方法说明',
        'ols' => [
            'title' => 'OLS',
            'desc' => '由协方差/方差得到的闭式解：',
            'formula' => '$$ a = \\frac{\\sum (x_i-\\bar{x})(y_i-\\bar{y})}{\\sum (x_i-\\bar{x})^2}, \\quad b = \\bar{y} - a\\bar{x} $$',
        ],
        'gd' => [
            'title' => 'Batch GD',
            'desc' => '使用全数据集的梯度进行更新：',
            'formula' => '$$ a \\leftarrow a - \\eta \\frac{\\partial MSE}{\\partial a}, \\quad b \\leftarrow b - \\eta \\frac{\\partial MSE}{\\partial b} $$',
        ],
        'sgd' => [
            'title' => 'SGD',
            'desc' => '对打乱后的点进行单样本更新：',
            'formula' => '$$ a \\leftarrow a - \\eta \\cdot 2(ax_j+b-y_j)x_j, \\quad b \\leftarrow b - \\eta \\cdot 2(ax_j+b-y_j) $$',
        ],
    ],
];
