<?php

return [
    'title' => 'Nonlinear Neural Regression Lab',
    'subtitle' => 'Fit nonlinear curves with a multilayer perceptron, then observe train/validation divergence under overtraining.',
    'accordion' => [
        '1' => [
            'title' => '1) Model Formulation',
            'p1' => 'Unlike linear regression y=ax+b, this lab uses hidden layers to learn nonlinear mappings x ¡æ y.',
            'equation' => '$$\\hat{y}=W_L\\,\\phi(W_{L-1}\\phi(\\cdots\\phi(W_1x+b_1)\\cdots)+b_{L-1})+b_L$$',
            'p2' => 'Choose depth, width, and activation to control model capacity.',
        ],
        '2' => [
            'title' => '2) Loss and Overfitting Signal',
            'p1' => 'The objective is mean squared error on the training subset:',
            'equation' => '$$\\text{MSE}=\\frac{1}{n}\\sum_{i=1}^{n}(y_i-\\hat{y}_i)^2$$',
            'p2' => 'Overfitting appears when train loss keeps decreasing while validation loss flattens or rises.',
        ],
    ],
    'controls' => [
        'add_point' => 'Add Point',
        'test_mode' => 'Test Mode',
        'clear' => 'Clear',
        'demo' => [
            'sine' => 'Sine Curve',
            'cubic' => 'Cubic Curve',
            'piecewise' => 'Piecewise Curve',
        ],
        'load_demo' => 'Load Demo',
        'hint' => 'Click to add samples. In Test Mode, click an x-position to inspect predicted y and residual.',
    ],
    'params' => [
        'hidden_layers' => 'Hidden Layers',
        'units_per_layer' => 'Units / Layer',
        'activation' => 'Activation',
        'val_ratio' => 'Validation Ratio',
        'lr' => 'LR',
        'batch' => 'Batch',
        'epochs' => 'Epochs',
        'l2_reg' => 'L2 Reg',
        'init_model' => 'Init Model',
    ],
    'actions' => [
        'step' => 'Step',
        'run' => 'Run',
        'stop' => 'Stop',
    ],
    'status' => [
        'title' => 'Training Status',
        'points' => 'Points:',
        'train_val' => 'Train / Val:',
        'epoch' => 'Epoch:',
        'train_loss' => 'Train Loss:',
        'val_loss' => 'Val Loss:',
    ],
    'interpretation' => [
        'title' => 'Interpretation',
        'li1' => 'Blue points: training subset, orange points: validation subset.',
        'li2' => 'Yellow marker in Test Mode: predicted output at clicked x.',
        'li3' => 'If train loss drops but val loss rises, capacity is too high or training is too long.',
        'li4' => 'Try stronger L2 regularization or smaller hidden layers to reduce overfitting.',
    ],
];
