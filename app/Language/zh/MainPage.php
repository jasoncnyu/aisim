<?php

return [
    'pageTitle' => '首页',
    'tagline' => 'AI Simulator',
    'title' => '学习人工智能的视觉实验室',
    'description' => 'AI Simulator 将抽象数学转变为交互式实验。通过实时训练模型、观看损失曲线移动以及查看调整参数时决策如何变化来建立直觉。',
    'labels' => [
        'interactive_labs' => '交互式实验室',
        'live_training' => '实时训练',
        'explainable_visuals' => '可解释的可视化',
        'guided_experiments' => '引导实验',
    ],
    'cta' => [
        'start_learning' => '开始学习',
        'try_cnn_mnist' => '尝试 CNN MNIST',
    ],
    
    // How to Use Section
    'howToUse' => [
        'title' => '如何使用此平台',
        'subtitle' => '从好奇心到自信直觉的短路径。',
        'steps' => [
            [
                'number' => '1',
                'label' => '步骤',
                'title' => '选择实验室',
                'description' => '选择一个实验室并阅读顶部的概念入门。它告诉你模型试图学什么。',
            ],
            [
                'number' => '2',
                'label' => '步骤',
                'title' => '创建数据',
                'description' => '通过单击、加载演示或使用示例图像来创建数据。数据形状驱动一切。',
            ],
            [
                'number' => '3',
                'label' => '步骤',
                'title' => '训练和观察',
                'description' => '使用步进或自动运行进行训练和观察，然后观看损失曲线和模型行为演变。',
            ],
            [
                'number' => '4',
                'label' => '步骤',
                'title' => '比较和反思',
                'description' => '通过更改超参数或模型类型来比较和反思，以查看偏差、方差和过拟合。',
            ],
        ],
    ],
    
    // Learning Tracks Section
    'learningTracks' => [
        'title' => '核心学习轨道',
        'machinelearning' => [
            'title' => '机器学习',
            'description' => '从这里开始以理解模型如何从数据学习。你会看到一条简单曲线如何适应点，分类器如何绘制边界，以及为什么模型容量很重要。这个轨道是关于为损失函数、梯度和数据几何建立直觉。',
            'question' => '用它来回答：为什么模型会欠拟合或过拟合？数据分布如何重塑决策边界？',
            'reinforcement' => [
            'title' => '????',
            'description' => '?????????????????????????????????????????????????',
            'question' => '??????????????????????????',
            'labs' => [
                'N????',
                '????',
            ],
        ],
    ],
        'deeplearning' => [
            'title' => '深度学习',
            'description' => '这个轨道将直觉从曲线扩展到网络。观看神经元如何将输入转换为表示，然后看卷积滤波器如何提取视觉特征。重点在于深度和非线性如何改变模型能够表达的内容。',
            'question' => '用它来回答：CNN 如何学习边缘？为什么当损失不断改进时神经模型会过拟合？',

            'labs' => [
                'NN ??',
                'CNN Binary',
                'CNN MNIST',
                'XOR ??',
                'Tiny Web LLM',
            ],
        ],
    ],
    'quickStart' => [
        'title' => '??????',
        'items' => [
            [
                'label' => 'ML ???',
                'text' => '???????????????????????',
            ],
            [
                'label' => '???????',
                'text' => '?? NN ????????????????',
            ],
            [
                'label' => '???????',
                'text' => '?? CNN MNIST ??????????',
            ],
        ],
        'cta' => [
            'start_linear' => '???????',
            'explore_nn' => '?? NN ??',
        ],
    ],
];
