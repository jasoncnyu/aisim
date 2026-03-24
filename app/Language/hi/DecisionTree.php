<?php

return [
    'title' => 'Decision Tree Visual Lab',
    'subtitle' => 'Binary classification के लिए axis-aligned split का इंटरैक्टिव सिमुलेटर।',
    'accordion' => [
        '1' => [
            'title' => '1) Decision Tree कैसे सीखता है',
            'p1' => 'Decision tree डेटा को recursively छोटे क्षेत्रों में बांटता है। इस सिमुलेटर में हर split axis-aligned है और x या y के threshold का उपयोग करता है।',
            'p2' => 'हर internal node x <= 22 जैसी rule पूछता है। Leaf nodes class probabilities और final class label देते हैं।',
        ],
        '2' => [
            'title' => '2) Split Quality: Gini Impurity',
            'p1' => 'Class proportions p_k के लिए Gini impurity:',
            'equation' => '$$ G = 1 - \\sum_k p_k^2 $$',
            'p2' => 'मॉडल candidate splits चुनता है और weighted child impurity न्यूनतम करता है।',
        ],
        '3' => [
            'title' => '3) Stopping Criteria और Generalization',
            'li1' => 'Maximum depth tree complexity सीमित करता है।',
            'li2' => 'Minimum samples unstable micro-splits से बचाता है।',
            'li3' => 'Pure leaves (सब एक class) अपने आप रुक जाती हैं।',
            'p1' => 'कम गहराई वाले trees आमतौर पर बेहतर generalize करते हैं, जबकि बहुत गहरे trees local noise पर overfit कर सकते हैं।',
        ],
        '4' => [
            'title' => '4) Suggested Workflow',
            'step1' => 'Class A और Class B के points जोड़ें या preset demo pattern लोड करें।',
            'step2' => 'अलग-अलग max depth / min samples के साथ ट्रेन करें।',
            'step3' => 'Region boundaries, text tree rules और split logs देखें।',
            'step4' => 'Simple vs complex trees की interpretability और fit quality तुलना करें।',
        ],
    ],
    'controls' => [
        'class_a' => 'Class A',
        'class_b' => 'Class B',
        'train' => 'Train',
        'clear' => 'Clear',
        'demo' => [
            'random_clusters' => 'Random Mixed Clusters',
            'concentric' => 'Concentric (Center vs Ring)',
            'xor' => 'XOR Pattern',
            'overlap' => 'Overlapping Clusters',
        ],
        'load_demo' => 'Load Demo',
        'max_depth' => 'Max Depth:',
        'min_samples' => 'Min Samples:',
        'show_regions' => 'Show Regions',
        'hint' => 'Canvas पर क्लिक करके grid cells में samples जोड़ें, फिर train करें ताकि split rules और decision regions बनें।',
    ],
    'model' => [
        'title' => 'Model Info',
        'points' => 'Points:',
        'last_split' => 'Last Split Score:',
        'points_a' => 'Points A',
        'points_b' => 'Points B',
    ],
    'tree_title' => 'Decision Tree (Text)',
    'calc_title' => 'Split Calculation Log',
];
