<?php

return [
    'pageTitle' => '首页',
    'tagline' => 'AI Simulator',
    'title' => '学习 AI 的可视化实验室',
    'description' => 'AI Simulator 将抽象的数学变成可交互的实验。你可以实时训练模型，观察损失曲线的变化，并看到参数调整如何改变决策，从而建立直觉。',
    'labels' => [
        'interactive_labs' => '交互式实验',
        'live_training' => '实时训练',
        'explainable_visuals' => '可解释的可视化',
        'guided_experiments' => '引导式实验',
    ],
    'cta' => [
        'start_learning' => '开始学习',
        'try_cnn_mnist' => '试试 CNN MNIST',
    ],
    
    // How to Use Section
    'howToUse' => [
        'title' => '如何使用本平台',
        'subtitle' => '从好奇到有把握的直觉，一条很短的路径。',
        'steps' => [
            [
                'number' => '1',
                'label' => '步骤',
                'title' => '选择实验',
                'description' => '选择一个实验并阅读顶部的概念简介，它会告诉你模型要学习什么。',
            ],
            [
                'number' => '2',
                'label' => '步骤',
                'title' => '创建数据',
                'description' => '通过点击、加载演示或使用样例图片来创建数据。数据形状决定了一切。',
            ],
            [
                'number' => '3',
                'label' => '步骤',
                'title' => '训练并观察',
                'description' => '使用步进或自动运行进行训练，然后观察损失曲线和模型行为的变化。',
            ],
            [
                'number' => '4',
                'label' => '步骤',
                'title' => '对比与反思',
                'description' => '通过调整超参数或模型类型，对比偏差、方差与过拟合。',
            ],
        ],
    ],
    
    // Learning Tracks Section
    'learningTracks' => [
        'title' => '核心学习路径',
        'machinelearning' => [
            'title' => '机器学习',
            'description' => '从这里开始理解模型如何从数据中学习。你会看到简单曲线如何拟合点、分类器如何画出边界，以及模型容量为何重要。本路径旨在建立对损失函数、梯度和数据几何的直觉。',
            'question' => '用它来回答：为什么模型会欠拟合或过拟合？数据分布如何重塑决策边界？',
            'labs' => [
                '线性回归',
                '逻辑回归',
                '决策树',
                'K-Means',
                'K-NN',
                'SVM',
            ],
        ],
        'deeplearning' => [
            'title' => '深度学习',
            'description' => '这条路径将直觉从曲线扩展到网络。观察神经元如何将输入变为表示，以及卷积滤波器如何提取视觉特征。重点在于深度与非线性如何改变模型表达能力。',
            'question' => '用它来回答：CNN 如何学习边缘？为什么神经模型在损失持续下降时仍会过拟合？',
            'labs' => [
                'NN 回归',
                'CNN Binary',
                'CNN MNIST',
                'XOR 实验',
                'Tiny Web LLM',
            ],
        ],
        'reinforcement' => [
            'title' => '强化学习',
            'description' => '这里模型是一个从奖励而非标注样本中学习的智能体。你将探索探索与利用、稀疏奖励以及环境动力学的作用。',
            'question' => '用它来回答：什么时候更该探索？奖励结构如何塑造行为？',
            'labs' => [
                'N臂老虎机',
                '网格世界',
            ],
        ],
    ],
    'quickStart' => [
        'title' => '快速开始提示',
        'items' => [
            [
                'label' => 'ML 新手？',
                'text' => '先从线性回归和逻辑回归开始，然后与决策树比较。',
            ],
            [
                'label' => '对曲线感兴趣？',
                'text' => '使用 NN 回归观察深度和宽度如何改变拟合。',
            ],
            [
                'label' => '想要视觉直觉？',
                'text' => '进入 CNN MNIST 并绘制数字测试推理。',
            ],
        ],
        'cta' => [
            'start_linear' => '从线性回归开始',
            'explore_nn' => '探索 NN 回归',
        ],
    ],
];
