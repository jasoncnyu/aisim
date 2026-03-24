<?php

return [
    'pageTitle' => 'Home',
    'tagline' => 'AI Simulator',
    'title' => 'A Visual Lab for Learning AI',
    'description' => 'AI Simulator turns abstract math into interactive experiments. Build intuition by training models in real time, watching loss curves move, and seeing how decisions change as you tune parameters.',
    'labels' => [
        'interactive_labs' => 'Interactive Labs',
        'live_training' => 'Live Training',
        'explainable_visuals' => 'Explainable Visuals',
        'guided_experiments' => 'Guided Experiments',
    ],
    'cta' => [
        'start_learning' => 'Start Learning',
        'try_cnn_mnist' => 'Try CNN MNIST',
    ],
    
    // How to Use Section
    'howToUse' => [
        'title' => 'How to Use This Platform',
        'subtitle' => 'A short path from curiosity to confident intuition.',
        'steps' => [
            [
                'number' => '1',
                'label' => 'Step',
                'title' => 'Pick a lab',
                'description' => 'Pick a lab and read the concept primer at the top. It tells you what the model is trying to learn.',
            ],
            [
                'number' => '2',
                'label' => 'Step',
                'title' => 'Create data',
                'description' => 'Create data by clicking, loading demos, or using sample images. Data shape drives everything.',
            ],
            [
                'number' => '3',
                'label' => 'Step',
                'title' => 'Train and observe',
                'description' => 'Train and observe with step or auto-run, then watch the loss curve and model behavior evolve.',
            ],
            [
                'number' => '4',
                'label' => 'Step',
                'title' => 'Compare and reflect',
                'description' => 'Compare and reflect by changing hyperparameters or model type to see bias, variance, and overfitting.',
            ],
        ],
    ],
    
    // Learning Tracks Section
    'learningTracks' => [
        'title' => 'Core Learning Tracks',
        'machinelearning' => [
            'title' => 'Machine Learning',
            'description' => 'Start here to understand how models learn from data. You will see how a simple curve bends to fit points, how classifiers draw boundaries, and why model capacity matters. This track is about building intuition for loss functions, gradients, and data geometry.',
            'question' => 'Use it to answer: Why does a model underfit or overfit? How does data distribution reshape a decision boundary?',
            'labs' => [
                'Linear Regression',
                'Logistic Regression',
                'Decision Tree',
                'K-Means',
                'K-NN',
                'SVM',
            ],
        ],
        'deeplearning' => [
            'title' => 'Deep Learning',
            'description' => 'This track scales intuition from curves to networks. Watch neurons transform inputs into representations, then see how convolutional filters extract visual features. The focus is on how depth and nonlinearity change what a model can express.',
            'question' => 'Use it to answer: How does a CNN learn edges? Why does a neural model overfit while the loss keeps improving?',
            'labs' => [
                'NN Regression',
                'CNN Binary',
                'CNN MNIST',
                'XOR Lab',
                'Tiny Web LLM',
            ],
        ],
        'reinforcement' => [
            'title' => 'Reinforcement Learning',
            'description' => 'Here the model is an agent that learns from rewards rather than labeled examples. You will explore exploration vs exploitation, sparse rewards, and the role of environment dynamics.',
            'question' => 'Use it to answer: When is it better to explore? How does reward structure shape behavior?',
            'labs' => [
                'N-Slot Bandit',
                'Grid World',
            ],
        ],
    ],
    'quickStart' => [
        'title' => 'Quick Start Prompts',
        'items' => [
            [
                'label' => 'New to ML?',
                'text' => 'Begin with Linear Regression and Logistic Regression, then compare with Decision Trees.',
            ],
            [
                'label' => 'Interested in curves?',
                'text' => 'Use NN Regression to see how depth and width change the fit.',
            ],
            [
                'label' => 'Want visual intuition?',
                'text' => 'Jump into CNN MNIST and draw digits to test inference.',
            ],
        ],
        'cta' => [
            'start_linear' => 'Start with Linear Regression',
            'explore_nn' => 'Explore NN Regression',
        ],
    ],
];
