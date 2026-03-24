<?php

return [
    'title' => 'Лабораторія CNN Binary',
    'subtitle' => 'Невелика згорткова нейромережа для класифікації двох класів з візуалізацією фільтрів і feature maps.',
    'accordion' => [
        '1' => [
            'title' => '1) Архітектура моделі',
            'p1' => 'Ця сторінка тренує компактну CNN: Conv(3x3) -> ReLU -> Flatten -> Dense -> ReLU -> Dense -> Softmax.',
            'p2' => 'Вхідні зображення перетворюються на grayscale і змінюються до 32x32, тому кожен зразок — 1024-вимірний вектор перед згорткою.',
            'p3' => 'Бінарні мітки перетворюються на ймовірності класів: P(class 1) та P(class 2).',
        ],
        '2' => [
            'title' => '2) Ціль навчання',
            'p1' => 'Мережа оптимізується cross-entropy для двох класів:',
            'equation' => '$$ L = -\\frac{1}{N}\\sum_{i=1}^{N}\\sum_{c=1}^{2} y_{ic}\\log(\\hat{y}_{ic}) $$',
            'p2' => 'Використовуйте менший learning rate для стабільної збіжності або більший для швидших, але шумних оновлень.',
        ],
        '3' => [
            'title' => '3) Рекомендований workflow',
            'step1' => 'Завантажте demo cat/dog зображення або завантажте власні файли у кожен клас.',
            'step2' => 'Ініціалізуйте ваги, запустіть кілька епох і спостерігайте loss та accuracy.',
            'step3' => 'Перегляньте значення фільтрів і feature maps, щоб зрозуміти, що захоплює перший conv-шар.',
            'step4' => 'Завантажте тестове зображення і перегляньте ймовірності класів.',
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
    'upload_hint' => 'Завантажені зображення змінюються до 32x32 grayscale перед навчанням.',
    'loading_images' => 'Loading images...',
    'conv_filters_title' => 'Conv Filters (Realtime)',
    'prediction_title' => 'Prediction',
    'predict_button' => 'Predict Uploaded Image',
    'feature_maps_title' => 'Feature Maps (Conv Layer)',
];
