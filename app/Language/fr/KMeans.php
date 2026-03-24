<?php

return [
    'title' => 'Laboratoire de Clustering K-Means',
    'subtitle' => 'Simulateur 2D interactif avec régions de Voronoi, mise à jour des centroïdes et suivi d\'inertie.',
    'accordion' => [
        '1' => [
            'title' => '1) Ce que K-Means Optimise',
            'p1' => 'K-Means partitionne les données en K clusters en minimisant la distance quadratique intra-cluster (inertie).',
            'equation' => '$$ J = \\sum_{i=1}^{N} \\min_{1 \\leq j \\leq K} \\left\\lVert x_i - \\mu_j \\right\\rVert^2 $$',
            'p2' => 'Chaque échantillon est assigné au centroïde le plus proche, puis les centroïdes sont recalculés comme la moyenne des échantillons assignés.',
        ],
        '2' => [
            'title' => '2) Itération de Lloyd (Assignation puis Mise à Jour)',
            'p1' => 'L\'algorithme alterne entre deux étapes déterministes :',
            'equation1' => '$$ c_i \\leftarrow \\arg\\min_j \\lVert x_i - \\mu_j \\rVert^2 $$',
            'equation2' => '$$ \\mu_j \\leftarrow \\frac{1}{|C_j|}\\sum_{x_i \\in C_j} x_i $$',
            'p2' => 'L\'inertie diminue monotoniquement jusqu\'à la convergence vers un optimum local.',
        ],
        '3' => [
            'title' => '3) Pourquoi l\'Initialisation Compte',
            'p1' => 'L\'initialisation aléatoire est simple mais peut partir de mauvaises graines.',
            'p2' => 'k-means++ répartit les centroïdes initiaux, offrant souvent une convergence plus rapide et une inertie finale plus faible.',
            'p3' => 'En production, utilisez plusieurs runs avec différentes graines pour réduire la sensibilité aux minima locaux.',
        ],
        '4' => [
            'title' => '4) Workflow d\'Expérience Suggéré',
            'step1' => 'Chargez des points demo et comparez l\'initialisation Aléatoire vs k-means++.',
            'step2' => 'Testez différents K et inspectez les frontières et tailles de clusters.',
            'step3' => 'Utilisez Étape pour observer un cycle assignation/mise à jour à la fois.',
            'step4' => 'Exécutez jusqu\'à convergence et comparez l\'inertie finale entre réglages.',
        ],
    ],
    'controls' => [
        'k_label' => 'K:',
        'init_label' => 'Init:',
        'init_random' => 'Aléatoire',
        'init_plus' => 'k-means++',
        'region_density' => 'Densité de Région :',
        'load_demo' => 'Charger Demo',
        'init_centroids' => 'Init Centroïdes',
        'step' => 'Étape',
        'run' => 'Exécuter',
        'stop' => 'Stop',
        'clear' => 'Effacer',
        'hint' => 'Cliquez n\'importe où sur le canvas pour ajouter des points. Appui long sur mobile ou clic droit pour supprimer le point le plus proche.',
    ],
    'status' => [
        'title' => 'Statut',
        'points' => 'Points :',
        'k' => 'K:',
        'iteration' => 'Itération :',
        'inertia' => 'Inertie :',
        'shift' => 'Déplacement du Centroïde :',
    ],
    'inertia_title' => 'Courbe d\'Inertie',
    'summary_title' => 'Résumé des Clusters',
];
