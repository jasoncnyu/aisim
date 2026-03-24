<?php

return [
    'title' => 'Laboratoire Visuel d\'Arbre de Décision',
    'subtitle' => 'Simulateur interactif de splits alignés aux axes pour classification binaire.',
    'accordion' => [
        '1' => [
            'title' => '1) Comment un Arbre de Décision Apprend',
            'p1' => 'Un arbre de décision divise les données récursivement en régions plus petites. Ici, chaque split est aligné aux axes et utilise x ou y avec un seuil.',
            'p2' => 'Chaque nœud interne pose une règle du type x <= 22. Les feuilles renvoient des probabilités de classe et un label final.',
        ],
        '2' => [
            'title' => '2) Qualité du Split : Impureté de Gini',
            'p1' => 'Pour des proportions de classe p_k, l\'impureté de Gini est :',
            'equation' => '$$ G = 1 - \\sum_k p_k^2 $$',
            'p2' => 'Le modèle teste des splits candidats et choisit celui qui minimise l\'impureté pondérée des enfants.',
        ],
        '3' => [
            'title' => '3) Critères d\'Arrêt et Généralisation',
            'li1' => 'La profondeur maximale limite la complexité de l\'arbre.',
            'li2' => 'Le nombre minimum d\'échantillons évite des micro-splits instables.',
            'li3' => 'Les feuilles pures (une seule classe) s\'arrêtent naturellement.',
            'p1' => 'Les arbres peu profonds généralisent mieux, tandis que les arbres profonds peuvent sur-ajuster le bruit local.',
        ],
        '4' => [
            'title' => '4) Workflow Suggéré',
            'step1' => 'Ajoutez des points pour la classe A et la classe B, ou chargez un pattern demo.',
            'step2' => 'Entraînez avec différents réglages de profondeur max / min d\'échantillons.',
            'step3' => 'Observez les frontières, les règles texte et les logs de split.',
            'step4' => 'Comparez arbres simples vs complexes pour l\'interprétabilité et la qualité d\'ajustement.',
        ],
    ],
    'controls' => [
        'class_a' => 'Classe A',
        'class_b' => 'Classe B',
        'train' => 'Entraîner',
        'clear' => 'Effacer',
        'demo' => [
            'random_clusters' => 'Clusters Mixtes Aléatoires',
            'concentric' => 'Concentrique (Centre vs Anneau)',
            'xor' => 'Pattern XOR',
            'overlap' => 'Clusters Chevauchants',
        ],
        'load_demo' => 'Charger Demo',
        'max_depth' => 'Profondeur Max :',
        'min_samples' => 'Min Échantillons :',
        'show_regions' => 'Afficher les Régions',
        'hint' => 'Cliquez sur le canvas pour ajouter des échantillons dans les cellules de la grille, puis entraînez pour générer les règles et régions.',
    ],
    'model' => [
        'title' => 'Info Modèle',
        'points' => 'Points :',
        'last_split' => 'Dernier Score de Split :',
        'points_a' => 'Points A',
        'points_b' => 'Points B',
    ],
    'tree_title' => 'Arbre de Décision (Texte)',
    'calc_title' => 'Log de Calcul des Splits',
];
