<?php

return [
    'title' => 'K-Means Clustering Lab',
    'subtitle' => 'Voronoi regions, centroid updates और inertia tracking के साथ इंटरैक्टिव 2D clustering सिमुलेटर।',
    'accordion' => [
        '1' => [
            'title' => '1) K-Means क्या optimize करता है',
            'p1' => 'K-Means डेटा को K clusters में बांटता है और within-cluster squared distance (inertia) को न्यूनतम करता है।',
            'equation' => '$$ J = \\sum_{i=1}^{N} \\min_{1 \\leq j \\leq K} \\left\\lVert x_i - \\mu_j \\right\\rVert^2 $$',
            'p2' => 'हर sample सबसे नज़दीकी centroid को assign होता है, फिर centroids को assigned samples की mean से recompute किया जाता है।',
        ],
        '2' => [
            'title' => '2) Lloyd Iteration (Assign फिर Update)',
            'p1' => 'Algorithm दो deterministic steps के बीच चलता है:',
            'equation1' => '$$ c_i \\leftarrow \\arg\\min_j \\lVert x_i - \\mu_j \\rVert^2 $$',
            'equation2' => '$$ \\mu_j \\leftarrow \\frac{1}{|C_j|}\\sum_{x_i \\in C_j} x_i $$',
            'p2' => 'Inertia monotonically घटती है जब तक local optimum पर converge न हो जाए।',
        ],
        '3' => [
            'title' => '3) Initialization क्यों मायने रखता है',
            'p1' => 'Random initialization सरल है लेकिन खराब seeds से शुरू हो सकता है।',
            'p2' => 'k-means++ प्रारंभिक centroids फैलाता है, जिससे अक्सर तेज convergence और कम final inertia मिलती है।',
            'p3' => 'Production में अलग-अलग seeds के साथ multiple runs करें ताकि local-minimum sensitivity कम हो।',
        ],
        '4' => [
            'title' => '4) Suggested Experiment Workflow',
            'step1' => 'Demo points लोड करें, फिर Random vs k-means++ initialization तुलना करें।',
            'step2' => 'अलग-अलग K values आज़माएं और region boundaries व cluster counts देखें।',
            'step3' => 'Step से एक assign/update cycle एक समय में देखें।',
            'step4' => 'Convergence तक चलाएं और final inertia values तुलना करें।',
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
        'hint' => 'Canvas पर कहीं भी क्लिक करके points जोड़ें। Touch पर long-press या right-click से nearest point हटाएं।',
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
