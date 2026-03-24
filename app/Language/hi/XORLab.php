<?php

return [
    'title' => 'XOR Neural Network Lab',
    'subtitle' => 'छोटे multilayer perceptron के लिए forward/backward pass visualization।',
    'accordion' => [
        '1' => [
            'title' => '1) XOR एक classic demo क्यों है',
            'p1' => 'XOR को एक single linear separator से हल नहीं किया जा सकता। मॉडल को nonlinear decision surface सीखनी होती है।',
            'p2' => 'इसलिए XOR hidden layers और nonlinear activations दिखाने का standard toy problem है।',
        ],
        '2' => [
            'title' => '2) यहां उपयोग की गई नेटवर्क संरचना',
            'p1' => 'सिमुलेटर एक compact MLP उपयोग करता है:',
            'structure' => 'Input(2) -> Hidden(4) -> Hidden(2) -> Output(1)',
            'p2' => 'Output activation sigmoid है ताकि binary probability मिले। Hidden activation tanh या ReLU हो सकता है।',
        ],
        '3' => [
            'title' => '3) Training Dynamics',
            'p1' => 'हर step एक XOR केस sample करता है, forward pass करता है, loss निकालता है, फिर backprop updates लगाता है।',
            'equation1' => '$$ z^{(l)} = a^{(l-1)}W^{(l)} + b^{(l)}, \\quad a^{(l)} = f(z^{(l)}) $$',
            'equation2' => '$$ W \\leftarrow W - \\eta \\nabla_W L, \\quad b \\leftarrow b - \\eta \\nabla_b L $$',
        ],
        '4' => [
            'title' => '4) Visuals कैसे पढ़ें',
            'li1' => 'Loss chart training steps पर convergence trend दिखाता है।',
            'li2' => 'Prediction panel चारों XOR inputs के लिए output confidence दिखाता है।',
            'li3' => 'Calculation panel latest forward/backward values log करता है।',
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
    'prediction_hint' => 'बड़े circles output probability ज्यादा होने का संकेत हैं।',
    'targets_title' => 'XOR Targets',
    'targets' => [
        'li1' => '(0,0) -> 0',
        'li2' => '(0,1) -> 1',
        'li3' => '(1,0) -> 1',
        'li4' => '(1,1) -> 0',
    ],
];
