<?php

return [
    'title' => 'K-Means Clustering Lab',
    'subtitle' => 'Interactive 2D clustering simulator with Voronoi regions, centroid updates, and inertia tracking.',
    'accordion' => [
        '1' => [
            'title' => '1) What K-Means Optimizes',
            'p1' => 'K-Means partitions data into K clusters by minimizing within-cluster squared distance (inertia).',
            'equation' => '$$ J = \\sum_{i=1}^{N} \\min_{1 \\leq j \\leq K} \\left\\lVert x_i - \\mu_j \\right\\rVert^2 $$',
            'p2' => 'Each sample is assigned to the nearest centroid, then centroids are recomputed as the mean of assigned samples.',
        ],
        '2' => [
            'title' => '2) Lloyd\'s Iteration (Assign then Update)',
            'p1' => 'The algorithm alternates between two deterministic steps:',
            'equation1' => '$$ c_i \\leftarrow \\arg\\min_j \\lVert x_i - \\mu_j \\rVert^2 $$',
            'equation2' => '$$ \\mu_j \\leftarrow \\frac{1}{|C_j|}\\sum_{x_i \\in C_j} x_i $$',
            'p2' => 'Inertia decreases monotonically until convergence to a local optimum.',
        ],
        '3' => [
            'title' => '3) Why Initialization Matters',
            'p1' => 'Random initialization is simple but can start from poor seeds.',
            'p2' => 'k-means++ spreads initial centroids, often yielding faster convergence and lower final inertia.',
            'p3' => 'Use multiple runs with different seeds in production to reduce local-minimum sensitivity.',
        ],
        '4' => [
            'title' => '4) Suggested Experiment Workflow',
            'step1' => 'Load demo points, then compare Random vs k-means++ initialization.',
            'step2' => 'Try different K values and inspect region boundaries and cluster counts.',
            'step3' => 'Use Step to inspect one assign/update cycle at a time.',
            'step4' => 'Run until convergence and compare final inertia values across settings.',
        ],
    ],
    'controls' => [
        'k_label' => 'K:',
        'init_label' => 'Init:',
        'init_random' => 'Random',
        'init_plus' => 'k-means++',
        'region_density' => 'Region Density:',
        'load_demo' => 'Load Demo',
        'init_centroids' => 'Init Centroids',
        'step' => 'Step',
        'run' => 'Run',
        'stop' => 'Stop',
        'clear' => 'Clear',
        'hint' => 'Click anywhere on the canvas to add points. Long-press on touch devices or right-click to remove the nearest point.',
    ],
    'status' => [
        'title' => 'Status',
        'points' => 'Points:',
        'k' => 'K:',
        'iteration' => 'Iteration:',
        'inertia' => 'Inertia:',
        'shift' => 'Centroid Shift:',
    ],
    'inertia_title' => 'Inertia Curve',
    'summary_title' => 'Cluster Summary',
];
