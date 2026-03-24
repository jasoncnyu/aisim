<?php

return [
    'title' => 'Logistic Regression Visual Lab',
    'subtitle' => 'Sigmoid boundary learning के साथ binary classification सिमुलेशन।',
    'accordion' => [
        '1' => [
            'title' => '1) Logistic Regression क्या करता है',
            'p1' => 'Logistic regression binary targets के लिए class membership की probability अनुमान करता है।',
            'equation' => '$$ \\hat{y} = \\sigma(z), \\quad z = mx + b, \\quad \\sigma(z)=\\frac{1}{1+e^{-z}} $$',
            'p2' => 'मॉडल 0 और 1 के बीच मान देता है। 0.5 जैसी threshold probability को class labels में बदलती है।',
        ],
        '2' => [
            'title' => '2) Objective Function (Binary Cross-Entropy)',
            'p1' => 'Training objective negative log likelihood को न्यूनतम करता है:',
            'equation' => '$$ L(m,b)=-\\frac{1}{n}\\sum_{i=1}^{n}\\left[y_i\\log(\\hat{y_i})+(1-y_i)\\log(1-\\hat{y_i})\\right] $$',
            'p2' => 'यह loss गलत लेकिन confident predictions को ज्यादा penalize करता है, जिससे calibrated probabilities मिलती हैं।',
        ],
        '3' => [
            'title' => '3) Gradient Updates',
            'p1' => 'One-feature logistic regression के लिए batch gradients:',
            'equation1' => '$$ \\frac{\\partial L}{\\partial m}=\\frac{1}{n}\\sum(\\hat{y_i}-y_i)x_i,\\quad \\frac{\\partial L}{\\partial b}=\\frac{1}{n}\\sum(\\hat{y_i}-y_i) $$',
            'equation2' => '$$ m \\leftarrow m-\\eta\\frac{\\partial L}{\\partial m},\\quad b \\leftarrow b-\\eta\\frac{\\partial L}{\\partial b} $$',
            'p2' => 'कम learning rate स्थिरता बढ़ाता है, जबकि बड़ा rate तेज convergence देता है पर oscillate कर सकता है।',
        ],
        '4' => [
            'title' => '4) Practical Workflow',
            'step1' => 'Class points manually जोड़ें (class 0 के लिए नीचे, class 1 के लिए ऊपर) या random data लोड करें।',
            'step2' => 'Auto Train से ट्रेन करें और loss decay देखें।',
            'step3' => 'Step से per-iteration behavior देखें।',
            'step4' => 'Test Mode ऑन करें और किसी भी input पर predicted probability देखें।',
        ],
    ],
    'controls' => [
        'generate_data' => 'Sample Data बनाएं',
        'auto_train' => 'Auto Train',
        'step' => 'Step',
        'test_mode' => 'Test Mode',
        'reset' => 'Reset',
        'learning_rate' => 'LR:',
        'hint' => 'Canvas पर क्लिक करके points जोड़ें। y=0 के पास class 0 और y=1 के पास class 1 है।',
    ],
    'loss_title' => 'Loss Curve',
    'interpretation' => [
        'title' => 'Interpretation Guide',
        'li1' => 'पीली S-curve सीखी हुई probability function है।',
        'li2' => 'लाल points class 1 हैं, cyan points class 0 हैं।',
        'li3' => 'बीच का transition zone decision boundary को दर्शाता है।',
        'li4' => 'Loss कम होना classification confidence बढ़ने का संकेत है।',
    ],
];
