<?php

return [
    'title' => 'XOR Neural Network Lab',
    'subtitle' => 'Forward/Backward pass visualization for a tiny multi-layer perceptron.',
    'accordion' => [
        '1' => [
            'title' => '1) Why XOR Is a Classic Neural Network Demo',
            'p1' => 'XOR cannot be solved by a single linear separator. A model must learn a non-linear decision surface.',
            'p2' => 'This makes XOR the standard toy problem for demonstrating hidden layers and non-linear activations.',
        ],
        '2' => [
            'title' => '2) Network Structure Used Here',
            'p1' => 'The simulator uses a compact MLP:',
            'structure' => 'Input(2) -> Hidden(4) -> Hidden(2) -> Output(1)',
            'p2' => 'Output activation is sigmoid for binary probability. Hidden activation can be tanh or ReLU.',
        ],
        '3' => [
            'title' => '3) Training Dynamics',
            'p1' => 'Each step samples one XOR case, performs a forward pass, computes loss, then applies backpropagation updates.',
            'equation1' => '$$ z^{(l)} = a^{(l-1)}W^{(l)} + b^{(l)}, \\quad a^{(l)} = f(z^{(l)}) $$',
            'equation2' => '$$ W \\leftarrow W - \\eta \\nabla_W L, \\quad b \\leftarrow b - \\eta \\nabla_b L $$',
        ],
        '4' => [
            'title' => '4) How To Read the Visuals',
            'li1' => 'Loss chart shows convergence trend over training steps.',
            'li2' => 'Prediction panel displays output confidence for all four XOR inputs.',
            'li3' => 'Calculation panel logs the latest forward/backward values for inspection.',
        ],
    ],
    'controls' => [
        'title' => 'Training Controls',
        'learning_rate' => 'Learning Rate',
        'sleep' => 'Sleep (ms)',
        'activation' => 'Activation',
        'step' => '+1 Step',
        'auto_train' => 'Auto Train',
        'reset' => 'Reset',
        'step_label' => 'Step:',
        'loss_label' => 'Loss:',
    ],
    'trace_title' => 'Forward/Backward Trace',
    'prediction_title' => 'Prediction Snapshot',
    'prediction_hint' => 'Larger circles indicate higher output probability near class 1.',
    'targets_title' => 'XOR Targets',
    'targets' => [
        'li1' => '(0,0) -> 0',
        'li2' => '(0,1) -> 1',
        'li3' => '(1,0) -> 1',
        'li4' => '(1,1) -> 0',
    ],
];
