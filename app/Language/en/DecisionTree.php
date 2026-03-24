<?php

return [
    'title' => 'Decision Tree Visual Lab',
    'subtitle' => 'Interactive axis-aligned splitting simulator for binary classification.',
    'accordion' => [
        '1' => [
            'title' => '1) How a Decision Tree Learns',
            'p1' => 'A decision tree recursively splits data into smaller regions. In this simulator, each split is axis-aligned and uses either x or y with a threshold.',
            'p2' => 'Each internal node asks a rule like x <= 22. Leaf nodes output class probabilities and a final class label.',
        ],
        '2' => [
            'title' => '2) Split Quality: Gini Impurity',
            'p1' => 'For class proportions p_k, Gini impurity is:',
            'equation' => '$$ G = 1 - \\sum_k p_k^2 $$',
            'p2' => 'The model tries candidate splits and picks the one that minimizes weighted child impurity.',
        ],
        '3' => [
            'title' => '3) Stopping Criteria and Generalization',
            'li1' => 'Maximum depth limits tree complexity.',
            'li2' => 'Minimum samples avoids unstable micro-splits.',
            'li3' => 'Pure leaves (all one class) stop naturally.',
            'p1' => 'Shallower trees usually generalize better, while deeper trees can overfit local noise.',
        ],
        '4' => [
            'title' => '4) Suggested Workflow',
            'step1' => 'Add points for class A and class B, or load a preset demo pattern.',
            'step2' => 'Train with different max depth / min samples settings.',
            'step3' => 'Observe region boundaries, text tree rules, and split logs.',
            'step4' => 'Compare simple vs complex trees for interpretability and fit quality.',
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
        'hint' => 'Click the canvas to add samples on grid cells, then train to generate split rules and decision regions.',
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
