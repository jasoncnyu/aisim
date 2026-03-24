<?php

return [
    'title' => 'CNN 二分类实验',
    'subtitle' => '用于二分类图像的轻量级 CNN，提供滤波器与特征图可视化。',
    'accordion' => [
        '1' => [
            'title' => '1) 模型架构',
            'p1' => '本页训练一个紧凑的 CNN：Conv(3x3) -> ReLU -> Flatten -> Dense -> ReLU -> Dense -> Softmax。',
            'p2' => '输入图像会转为灰度并缩放到 32x32。',
            'p3' => '二元标签映射为类 1 / 类 2 的概率。',
        ],
        '2' => [
            'title' => '2) 学习目标',
            'p1' => '使用两类交叉熵优化：',
            'equation' => '$$ L = -\\frac{1}{N}\\sum_{i=1}^{N}\\sum_{c=1}^{2} y_{ic}\\log(\\hat{y}_{ic}) $$',
            'p2' => '较低 LR 更稳定，较高 LR 更快但更噪。',
        ],
        '3' => [
            'title' => '3) 建议流程',
            'step1' => '加载猫/狗演示数据或上传自定义图片。',
            'step2' => '初始化权重，运行若干 epoch，查看损失与准确率。',
            'step3' => '查看滤波器与特征图，理解第一层卷积捕获的内容。',
            'step4' => '上传测试图片并查看类别概率。',
        ],
    ],
    'controls' => [
        'load_demo' => '加载演示数据',
        'init_weights' => '初始化权重',
        'step' => '步进(1 Epoch)',
        'run' => '运行',
        'stop' => '停止',
        'reset' => '重置',
        'lr' => 'LR:',
        'epochs' => 'Epochs:',
        'batch' => 'Batch:',
    ],
    'metrics' => [
        'dataset' => '数据集：',
        'epoch' => 'Epoch：',
        'loss' => '损失：',
        'accuracy' => '准确率：',
    ],
    'training_images_title' => '训练图像',
    'class1_label' => '类 1（标签 0）',
    'class2_label' => '类 2（标签 1）',
    'upload_hint' => '上传图片在训练前会缩放为 32x32 灰度。',
    'loading_images' => '正在加载图像...',
    'conv_filters_title' => '卷积滤波器（实时）',
    'prediction_title' => '预测',
    'predict_button' => '预测上传图片',
    'feature_maps_title' => '特征图（卷积层）',
];
