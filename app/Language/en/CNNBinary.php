<?php

return [
    'title' => 'CNN Binary Lab',
    'subtitle' => 'Tiny convolutional neural network for two-class image classification with filter and feature-map visualization.',
    'accordion' => [
        '1' => [
            'title' => '1) Model Architecture',
            'p1' => 'This page trains a compact CNN: Conv(3x3) -> ReLU -> Flatten -> Dense -> ReLU -> Dense -> Softmax.',
            'p2' => 'Input images are converted to grayscale and resized to 32x32, so each sample is a 1024-dimensional vector before convolution.',
            'p3' => 'Binary labels are mapped to class probabilities: P(class 1) and P(class 2).',
        ],
        '2' => [
            'title' => '2) Learning Objective',
            'p1' => 'The network is optimized with cross-entropy over two classes:',
            'equation' => '$$ L = -\\frac{1}{N}\\sum_{i=1}^{N}\\sum_{c=1}^{2} y_{ic}\\log(\\hat{y}_{ic}) $$',
            'p2' => 'Use a lower learning rate for stable convergence, or a higher learning rate for faster but noisier updates.',
        ],
        '3' => [
            'title' => '3) Suggested Workflow',
            'step1' => 'Load demo cat/dog images or upload custom files into each class bucket.',
            'step2' => 'Initialize weights, run a few epochs, and monitor loss and accuracy.',
            'step3' => 'Check filter values and feature maps to understand what the first conv layer captures.',
            'step4' => 'Upload a test image and inspect class probabilities.',
        ],
    ],
    'controls' => [
        'load_demo' => 'Load Demo Data',
        'init_weights' => 'Init Weights',
        'step' => 'Step (1 Epoch)',
        'run' => 'Run',
        'stop' => 'Stop',
        'reset' => 'Reset',
        'lr' => 'LR:',
        'epochs' => 'Epochs:',
        'batch' => 'Batch:',
    ],
    'metrics' => [
        'dataset' => 'Dataset:',
        'epoch' => 'Epoch:',
        'loss' => 'Loss:',
        'accuracy' => 'Accuracy:',
    ],
    'training_images_title' => 'Training Images',
    'class1_label' => 'Class 1 (label 0)',
    'class2_label' => 'Class 2 (label 1)',
    'upload_hint' => 'Uploaded images are resized to 32x32 grayscale before training.',
    'loading_images' => 'Loading images...',
    'conv_filters_title' => 'Conv Filters (Realtime)',
    'prediction_title' => 'Prediction',
    'predict_button' => 'Predict Uploaded Image',
    'feature_maps_title' => 'Feature Maps (Conv Layer)',
];
