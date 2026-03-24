<?php

return [
    'title' => '非线性神经回归实验',
    'subtitle' => '用多层感知机拟合非线性曲线，并观察过拟合导致的 train/val 分歧。',
    'accordion' => [
        '1' => [
            'title' => '1) 模型形式',
            'p1' => '不同于线性回归 y=ax+b，本实验使用隐藏层学习非线性映射 x → y。',
            'equation' => '$$\\hat{y}=W_L\\,\\phi(W_{L-1}\\phi(\\cdots\\phi(W_1x+b_1)\\cdots)+b_{L-1})+b_L$$',
            'p2' => '通过深度、宽度和激活函数控制模型容量。',
        ],
        '2' => [
            'title' => '2) 损失与过拟合信号',
            'p1' => '目标是在训练子集上的均方误差：',
            'equation' => '$$\\text{MSE}=\\frac{1}{n}\\sum_{i=1}^{n}(y_i-\\hat{y}_i)^2$$',
            'p2' => '若训练损失继续下降而验证损失持平或上升，则出现过拟合。',
        ],
    ],
    'controls' => [
        'add_point' => '添加点',
        'test_mode' => '测试模式',
        'clear' => '清除',
        'demo' => [
            'sine' => '正弦曲线',
            'cubic' => '三次曲线',
            'piecewise' => '分段曲线',
        ],
        'load_demo' => '加载演示',
        'hint' => '点击添加样本。测试模式下点击 x 位置查看预测 y 和残差。',
    ],
    'params' => [
        'hidden_layers' => '隐藏层',
        'units_per_layer' => '每层单元数',
        'activation' => '激活',
        'val_ratio' => '验证比例',
        'lr' => 'LR',
        'batch' => 'Batch',
        'epochs' => 'Epochs',
        'l2_reg' => 'L2 正则',
        'init_model' => '初始化模型',
    ],
    'actions' => [
        'step' => '步进',
        'run' => '运行',
        'stop' => '停止',
    ],
    'status' => [
        'title' => '训练状态',
        'points' => '点数：',
        'train_val' => 'Train / Val：',
        'epoch' => 'Epoch：',
        'train_loss' => '训练损失：',
        'val_loss' => '验证损失：',
    ],
    'interpretation' => [
        'title' => '解读',
        'li1' => '蓝点：训练子集，橙点：验证子集。',
        'li2' => '测试模式中的黄色标记：点击位置的预测输出。',
        'li3' => '若 train 降而 val 升，说明容量过大或训练过久。',
        'li4' => '尝试更强的 L2 正则或更小的隐藏层以减少过拟合。',
    ],
];
