<?php

return [
    'title' => '逻辑回归可视化实验',
    'subtitle' => '通过 sigmoid 边界学习的二分类模拟。',
    'accordion' => [
        '1' => [
            'title' => '1) 逻辑回归做什么',
            'p1' => '逻辑回归预测二元目标的类别归属概率。',
            'equation' => '$$ \\hat{y} = \\sigma(z), \\quad z = mx + b, \\quad \\sigma(z)=\\frac{1}{1+e^{-z}} $$',
            'p2' => '模型输出 0 到 1 之间的值。阈值如 0.5 可将概率转换为类别标签。',
        ],
        '2' => [
            'title' => '2) 目标函数（二元交叉熵）',
            'p1' => '训练目标最小化负对数似然：',
            'equation' => '$$ L(m,b)=-\\frac{1}{n}\\sum_{i=1}^{n}\\left[y_i\\log(\\hat{y_i})+(1-y_i)\\log(1-\\hat{y_i})\\right] $$',
            'p2' => '该损失会重罚高置信度的错误预测，从而改进概率校准。',
        ],
        '3' => [
            'title' => '3) 梯度更新',
            'p1' => '单特征逻辑回归的批量梯度为：',
            'equation1' => '$$ \\frac{\\partial L}{\\partial m}=\\frac{1}{n}\\sum(\\hat{y_i}-y_i)x_i,\\quad \\frac{\\partial L}{\\partial b}=\\frac{1}{n}\\sum(\\hat{y_i}-y_i) $$',
            'equation2' => '$$ m \\leftarrow m-\\eta\\frac{\\partial L}{\\partial m},\\quad b \\leftarrow b-\\eta\\frac{\\partial L}{\\partial b} $$',
            'p2' => '较低学习率更稳定，较高学习率收敛更快但可能振荡。',
        ],
        '4' => [
            'title' => '4) 实用流程',
            'step1' => '手动添加类点（下带为类 0、上带为类 1）或加载随机数据。',
            'step2' => '使用自动训练并观察损失下降。',
            'step3' => '使用“步进”检查每次迭代的变化。',
            'step4' => '启用测试模式并点击查看任意输入位置的预测概率。',
        ],
    ],
    'controls' => [
        'generate_data' => '生成样本数据',
        'auto_train' => '自动训练',
        'step' => '步进',
        'test_mode' => '测试模式',
        'reset' => '重置',
        'learning_rate' => 'LR：',
        'hint' => '点击画布添加点。y=0 附近为类 0，y=1 附近为类 1。',
    ],
    'loss_title' => '损失曲线',
    'interpretation' => [
        'title' => '解读指南',
        'li1' => '黄色 S 曲线为学习得到的概率函数。',
        'li2' => '红色点为类 1，青色点为类 0。',
        'li3' => '中间过渡带近似决策边界。',
        'li4' => '损失下降表示分类置信度提升。',
    ],
];
