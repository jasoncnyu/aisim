<?php

return [
    'title' => 'CNN Binary Lab',
    'subtitle' => 'दो classes के लिए छोटी CNN जिसमें filter और feature-map visualization है।',
    'accordion' => [
        '1' => [
            'title' => '1) Model Architecture',
            'p1' => 'यह पेज एक compact CNN ट्रेन करता है: Conv(3x3) -> ReLU -> Flatten -> Dense -> ReLU -> Dense -> Softmax।',
            'p2' => 'इनपुट images को grayscale में बदलकर 32x32 किया जाता है, इसलिए हर sample convolution से पहले 1024-dimensional vector होता है।',
            'p3' => 'Binary labels को class probabilities में map किया जाता है: P(class 1) और P(class 2)।',
        ],
        '2' => [
            'title' => '2) Learning Objective',
            'p1' => 'नेटवर्क दो classes पर cross-entropy से optimize होता है:',
            'equation' => '$$ L = -\\frac{1}{N}\\sum_{i=1}^{N}\\sum_{c=1}^{2} y_{ic}\\log(\\hat{y}_{ic}) $$',
            'p2' => 'Stable convergence के लिए कम learning rate या तेज updates के लिए बड़ा learning rate उपयोग करें।',
        ],
        '3' => [
            'title' => '3) Suggested Workflow',
            'step1' => 'Demo cat/dog images लोड करें या custom files हर class bucket में अपलोड करें।',
            'step2' => 'Weights initialize करें, कुछ epochs चलाएं, और loss व accuracy देखें।',
            'step3' => 'Filters और feature maps देखें ताकि first conv layer क्या पकड़ता है समझ सकें।',
            'step4' => 'Test image अपलोड करें और class probabilities देखें।',
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
    'upload_hint' => 'Uploaded images को 32x32 grayscale में resize करके training से पहले उपयोग किया जाता है।',
    'loading_images' => 'Loading images...',
    'conv_filters_title' => 'Conv Filters (Realtime)',
    'prediction_title' => 'Prediction',
    'predict_button' => 'Predict Uploaded Image',
    'feature_maps_title' => 'Feature Maps (Conv Layer)',
];
