<?php

return [
    'title' => 'K-Nearest Neighbors Lab',
    'subtitle' => 'Instance-based classification with interactive decision regions, neighbor inspection, and weighted voting.',
    'accordion' => [
        '1' => [
            'title' => '1) Core Idea of K-NN',
            'p1' => 'K-NN does not learn global model parameters. It predicts using the labels of nearby training points in feature space.',
            'p2' => 'For a query point x, select the closest K samples and aggregate their labels by majority vote (or weighted vote).',
            'equation' => '$$\\hat{y}(x)=\\arg\\max_c \\sum_{i\\in \\mathcal{N}_K(x)} w_i\\,\\mathbf{1}(y_i=c)$$',
        ],
        '2' => [
            'title' => '2) Effect of K and Distance Weighting',
            'li1' => 'Small K: highly flexible boundary, sensitive to local noise.',
            'li2' => 'Large K: smoother boundary, lower variance, potentially higher bias.',
            'li3' => 'Weighted voting (w=1/d) gives stronger influence to very close neighbors.',
        ],
        '3' => [
            'title' => '3) Practical Notes',
            'p1' => 'Because K-NN relies on distance, feature scaling is critical in real datasets. Standardization usually improves reliability.',
            'p2' => 'Prediction cost grows with dataset size, since distances must be computed against many samples at inference time.',
            'p3' => 'Use validation to choose K and evaluate robustness under noisy or overlapping class distributions.',
        ],
        '4' => [
            'title' => '4) Suggested Workflow',
            'step1' => 'Load a demo distribution (vertical, XOR, concentric, overlap, random).',
            'step2' => 'Adjust K and toggle weighted voting to compare decision boundaries.',
            'step3' => 'Enable Test Mode and click to inspect nearest neighbors and class probability.',
            'step4' => 'Increase region density to see finer boundary details, then lower it for faster rendering.',
        ],
    ],
    'controls' => [
        'class_a' => 'Class A',
        'class_b' => 'Class B',
        'test_mode' => 'Test Mode',
        'k_label' => 'K:',
        'weighted' => 'Weighted (1/d)',
        'region_density' => 'Region Density:',
        'demo' => [
            'vertical' => 'Mixed Vertical',
            'xor' => 'XOR (4 Clusters)',
            'concentric' => 'Concentric (Center vs Ring)',
            'overlap' => 'Overlapping (Hard)',
            'random' => 'Random Clusters',
        ],
        'load_demo' => 'Load Demo',
        'refresh' => 'Refresh',
        'clear' => 'Clear',
        'hint' => 'Click to add training samples. In Test Mode, click to classify a query point and inspect its nearest neighbors.',
    ],
    'model' => [
        'title' => 'Model Info',
        'points' => 'Points:',
        'last_prob' => 'Last Test P(B):',
    ],
    'neighbors_title' => 'Nearest Neighbors',
];
