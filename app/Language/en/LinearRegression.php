<?php

return [
    'title' => 'Linear Regression Visualization',
    'subtitle' => 'Interactive simulation for OLS, GD, and SGD.',
    'accordion' => [
        '1' => [
            'title' => '1) What Linear Regression Solves',
            'p1' => 'Linear regression estimates a straight-line relationship between an input x and output y.',
            'equation' => 'y = ax + b',
            'p2' => 'Here, a is the slope and b is the intercept. In this simulator, each point you add is a training sample and the model finds the best-fitting a and b.',
        ],
        '2' => [
            'title' => '2) Error Function and Why MSE Is Used',
            'p1' => 'The model minimizes mean squared error (MSE):',
            'equation' => '$$ MSE(a,b) = \\frac{1}{n}\\sum_{i=1}^{n}(y_i-(ax_i+b))^2 $$',
            'p2' => 'Squaring penalizes large errors more strongly and gives a smooth optimization target. Lower loss means a better fit.',
        ],
        '3' => [
            'title' => '3) OLS vs GD vs SGD',
            'ols' => 'Closed-form and one-shot.',
            'gd' => 'Uses all samples per epoch, stable but heavier.',
            'sgd' => 'Uses shuffled single-sample updates, faster but noisier.',
            'p1' => 'Use the same points and compare learning curves for each method.',
        ],
        '4' => [
            'title' => '4) Suggested Learning Workflow',
            'step1' => 'Add points or load demo data.',
            'step2' => 'Run OLS first to get a baseline line.',
            'step3' => 'Switch to GD/SGD and tune learning rate and epochs.',
            'step4' => 'Use Test Mode to inspect actual vs predicted values.',
        ],
    ],
    'controls' => [
        'add_point' => 'Add Point',
        'clear_points' => 'Clear Points',
        'load_demo' => 'Load Demo Data',
        'hint' => 'Click to add points. Long-press on a point to remove it.',
        'method' => 'Regression Method',
        'method_ols' => 'OLS',
        'method_gd' => 'Batch Gradient Descent',
        'method_sgd' => 'Stochastic Gradient Descent',
        'learning_rate' => 'Learning Rate',
        'epochs' => 'Epochs',
        'step_train' => 'Step Train',
        'auto_train' => 'Auto Train',
        'test_mode' => 'Test Mode',
    ],
    'loss_title' => 'Loss (MSE)',
    'model' => [
        'title' => 'Model',
        'points' => 'Points:',
        'slope' => 'Slope (a):',
        'intercept' => 'Intercept (b):',
        'r2' => 'R2:',
        'last_loss' => 'Last Loss:',
    ],
    'notes' => [
        'title' => 'Method Notes',
        'ols' => [
            'title' => 'OLS',
            'desc' => 'Closed-form solution from covariance and variance:',
            'formula' => '$$ a = \\frac{\\sum (x_i-\\bar{x})(y_i-\\bar{y})}{\\sum (x_i-\\bar{x})^2}, \\quad b = \\bar{y} - a\\bar{x} $$',
        ],
        'gd' => [
            'title' => 'Batch GD',
            'desc' => 'Update using gradients over the full dataset:',
            'formula' => '$$ a \\leftarrow a - \\eta \\frac{\\partial MSE}{\\partial a}, \\quad b \\leftarrow b - \\eta \\frac{\\partial MSE}{\\partial b} $$',
        ],
        'sgd' => [
            'title' => 'SGD',
            'desc' => 'Per-sample updates with shuffled points:',
            'formula' => '$$ a \\leftarrow a - \\eta \\cdot 2(ax_j+b-y_j)x_j, \\quad b \\leftarrow b - \\eta \\cdot 2(ax_j+b-y_j) $$',
        ],
    ],
];
