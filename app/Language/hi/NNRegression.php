<?php

return [
    'title' => 'Nonlinear Neural Regression Lab',
    'subtitle' => 'Multilayer perceptron से nonlinear curves फिट करें और overtraining में train/validation divergence देखें।',
    'accordion' => [
        '1' => [
            'title' => '1) Model Formulation',
            'p1' => 'Linear regression y=ax+b से अलग, यह लैब hidden layers का उपयोग करके nonlinear mappings x -> y सीखता है।',
            'equation' => '$$\\hat{y}=W_L\\,\\phi(W_{L-1}\\phi(\\cdots\\phi(W_1x+b_1)\\cdots)+b_{L-1})+b_L$$',
            'p2' => 'Depth, width और activation चुनकर model capacity नियंत्रित करें।',
        ],
        '2' => [
            'title' => '2) Loss और Overfitting Signal',
            'p1' => 'Objective training subset पर mean squared error है:',
            'equation' => '$$\\text{MSE}=\\frac{1}{n}\\sum_{i=1}^{n}(y_i-\\hat{y}_i)^2$$',
            'p2' => 'Overfitting तब दिखता है जब train loss घटती रहती है लेकिन validation loss flat या बढ़ती है।',
        ],
    ],
    'controls' => [
        'add_point' => 'Point जोड़ें',
        'test_mode' => 'Test Mode',
        'clear' => 'Clear',
        'demo' => [
            'sine' => 'Sine Curve',
            'cubic' => 'Cubic Curve',
            'piecewise' => 'Piecewise Curve',
        ],
        'load_demo' => 'Load Demo',
        'hint' => 'Samples जोड़ने के लिए क्लिक करें। Test Mode में x position पर क्लिक करके predicted y और residual देखें।',
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
        'li1' => 'नीले points: training subset, नारंगी points: validation subset।',
        'li2' => 'Test Mode में पीला marker: क्लिक किए गए x पर predicted output।',
        'li3' => 'अगर train loss घटती है लेकिन val loss बढ़ती है, capacity बहुत अधिक है या training बहुत लंबी है।',
        'li4' => 'Overfitting कम करने के लिए मजबूत L2 regularization या छोटे hidden layers आज़माएं।',
    ],
];
