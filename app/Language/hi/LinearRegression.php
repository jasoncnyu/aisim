<?php

return [
    'title' => 'Linear Regression Visualization',
    'subtitle' => 'OLS, GD और SGD के लिए इंटरैक्टिव सिमुलेशन।',
    'accordion' => [
        '1' => [
            'title' => '1) Linear Regression क्या हल करता है',
            'p1' => 'Linear regression इनपुट x और आउटपुट y के बीच सीधी रेखा का संबंध अनुमान करता है।',
            'equation' => 'y = ax + b',
            'p2' => 'यहां a slope है और b intercept है। इस सिमुलेटर में हर जोड़ा गया पॉइंट एक training sample है और मॉडल सबसे अच्छा a और b ढूंढता है।',
        ],
        '2' => [
            'title' => '2) Error Function और MSE क्यों',
            'p1' => 'मॉडल mean squared error (MSE) को न्यूनतम करता है:',
            'equation' => '$$ MSE(a,b) = \\frac{1}{n}\\sum_{i=1}^{n}(y_i-(ax_i+b))^2 $$',
            'p2' => 'स्क्वेयरिंग बड़े errors को ज्यादा penalize करता है और एक smooth optimization target देता है। कम loss मतलब बेहतर fit।',
        ],
        '3' => [
            'title' => '3) OLS vs GD vs SGD',
            'ols' => 'Closed-form और one-shot।',
            'gd' => 'हर epoch में सभी samples, स्थिर पर भारी।',
            'sgd' => 'Shuffled single-sample updates, तेज पर noisy।',
            'p1' => 'एक ही points के साथ हर method की learning curves तुलना करें।',
        ],
        '4' => [
            'title' => '4) सुझाया गया workflow',
            'step1' => 'Points जोड़ें या demo data लोड करें।',
            'step2' => 'पहले OLS चलाएं ताकि baseline line मिले।',
            'step3' => 'GD/SGD पर जाएं और learning rate व epochs ट्यून करें।',
            'step4' => 'Test Mode से actual vs predicted values देखें।',
        ],
    ],
    'controls' => [
        'add_point' => 'Point जोड़ें',
        'clear_points' => 'Points साफ करें',
        'load_demo' => 'Demo Data लोड करें',
        'hint' => 'क्लिक करके points जोड़ें। किसी point को हटाने के लिए long-press करें।',
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
            'desc' => 'Covariance और variance से closed-form solution:',
            'formula' => '$$ a = \\frac{\\sum (x_i-\\bar{x})(y_i-\\bar{y})}{\\sum (x_i-\\bar{x})^2}, \\quad b = \\bar{y} - a\\bar{x} $$',
        ],
        'gd' => [
            'title' => 'Batch GD',
            'desc' => 'पूरे dataset पर gradients से update:',
            'formula' => '$$ a \\leftarrow a - \\eta \\frac{\\partial MSE}{\\partial a}, \\quad b \\leftarrow b - \\eta \\frac{\\partial MSE}{\\partial b} $$',
        ],
        'sgd' => [
            'title' => 'SGD',
            'desc' => 'Shuffled points के साथ per-sample updates:',
            'formula' => '$$ a \\leftarrow a - \\eta \\cdot 2(ax_j+b-y_j)x_j, \\quad b \\leftarrow b - \\eta \\cdot 2(ax_j+b-y_j) $$',
        ],
    ],
];
