<?php

return [
    'title' => 'Logistic Regression Visual Lab',
    'subtitle' => 'Binary classification simulation with sigmoid boundary learning.',
    'accordion' => [
        '1' => [
            'title' => '1) What Logistic Regression Does',
            'p1' => 'Logistic regression predicts the probability of class membership for binary targets.',
            'equation' => '$$ \\hat{y} = \\sigma(z), \\quad z = mx + b, \\quad \\sigma(z)=\\frac{1}{1+e^{-z}} $$',
            'p2' => 'The model outputs values between 0 and 1. A threshold such as 0.5 converts probability into class labels.',
        ],
        '2' => [
            'title' => '2) Objective Function (Binary Cross-Entropy)',
            'p1' => 'The training objective minimizes negative log likelihood:',
            'equation' => '$$ L(m,b)=-\\frac{1}{n}\\sum_{i=1}^{n}\\left[y_i\\log(\\hat{y_i})+(1-y_i)\\log(1-\\hat{y_i})\\right] $$',
            'p2' => 'This loss penalizes confident wrong predictions heavily, which improves calibrated probability outputs.',
        ],
        '3' => [
            'title' => '3) Gradient Updates',
            'p1' => 'For one-feature logistic regression, batch gradients are:',
            'equation1' => '$$ \\frac{\\partial L}{\\partial m}=\\frac{1}{n}\\sum(\\hat{y_i}-y_i)x_i,\\quad \\frac{\\partial L}{\\partial b}=\\frac{1}{n}\\sum(\\hat{y_i}-y_i) $$',
            'equation2' => '$$ m \\leftarrow m-\\eta\\frac{\\partial L}{\\partial m},\\quad b \\leftarrow b-\\eta\\frac{\\partial L}{\\partial b} $$',
            'p2' => 'Lower learning rates improve stability, while larger rates converge faster but may oscillate.',
        ],
        '4' => [
            'title' => '4) Practical Workflow',
            'step1' => 'Add class points manually (lower band for class 0, upper band for class 1) or load random data.',
            'step2' => 'Train with Auto Train and monitor loss decay.',
            'step3' => 'Use Step to inspect per-iteration behavior.',
            'step4' => 'Enable Test Mode and click to inspect predicted probability at any input position.',
        ],
    ],
    'controls' => [
        'generate_data' => 'Generate Sample Data',
        'auto_train' => 'Auto Train',
        'step' => 'Step',
        'test_mode' => 'Test Mode',
        'reset' => 'Reset',
        'learning_rate' => 'LR:',
        'hint' => 'Click canvas to add points. Points near y=0 represent class 0 and points near y=1 represent class 1.',
    ],
    'loss_title' => 'Loss Curve',
    'interpretation' => [
        'title' => 'Interpretation Guide',
        'li1' => 'The yellow S-curve is the learned probability function.',
        'li2' => 'Red points are class 1, cyan points are class 0.',
        'li3' => 'The center transition zone approximates the decision boundary.',
        'li4' => 'Decreasing loss indicates improving classification confidence.',
    ],
];
