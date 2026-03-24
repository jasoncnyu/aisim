<?php

return [
    'title' => 'XOR 神经网络实验',
    'subtitle' => '可视化小型多层感知机的前向/反向传播。',
    'accordion' => [
        '1' => [
            'title' => '1) 为什么 XOR 是经典示例',
            'p1' => 'XOR 无法由单一线性分隔器解决。模型必须学习非线性决策面。',
            'p2' => '因此 XOR 是展示隐藏层与非线性激活的标准玩具问题。',
        ],
        '2' => [
            'title' => '2) 本实验使用的网络结构',
            'p1' => '模拟器使用紧凑的 MLP：',
            'structure' => 'Input(2) -> Hidden(4) -> Hidden(2) -> Output(1)',
            'p2' => '输出激活为 sigmoid 以表示二元概率。隐藏层激活可选 tanh 或 ReLU。',
        ],
        '3' => [
            'title' => '3) 训练动态',
            'p1' => '每一步采样一个 XOR 案例，执行前向传播、计算损失并应用反向传播更新。',
            'equation1' => '$$ z^{(l)} = a^{(l-1)}W^{(l)} + b^{(l)}, \\quad a^{(l)} = f(z^{(l)}) $$',
            'equation2' => '$$ W \\leftarrow W - \\eta \\nabla_W L, \\quad b \\leftarrow b - \\eta \\nabla_b L $$',
        ],
        '4' => [
            'title' => '4) 如何读图',
            'li1' => '损失曲线展示训练收敛趋势。',
            'li2' => '预测面板显示四个 XOR 输入的输出置信度。',
            'li3' => '计算面板记录最近一次的前向/反向数值。',
        ],
    ],
    'controls' => [
        'title' => '训练控制',
        'learning_rate' => '学习率',
        'sleep' => '休眠 (ms)',
        'activation' => '激活',
        'step' => '+1 步',
        'auto_train' => '自动训练',
        'reset' => '重置',
        'step_label' => '步：',
        'loss_label' => '损失：',
    ],
    'trace_title' => '前向/反向追踪',
    'prediction_title' => '预测快照',
    'prediction_hint' => '圆越大表示输出概率越接近类 1。',
    'targets_title' => 'XOR 目标',
    'targets' => [
        'li1' => '(0,0) -> 0',
        'li2' => '(0,1) -> 1',
        'li3' => '(1,0) -> 1',
        'li4' => '(1,1) -> 0',
    ],
];
