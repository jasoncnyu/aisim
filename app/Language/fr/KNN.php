<?php

return [
    'title' => 'Laboratoire des K plus proches voisins',
    'subtitle' => 'Classification basée sur les instances avec régions de décision interactives, inspection des voisins et vote pondéré.',
    'accordion' => [
        '1' => [
            'title' => '1) Idée Centrale du K-NN',
            'p1' => 'Le K-NN n\'apprend pas de paramètres globaux. Il prédit à partir des labels des points d\'entraînement proches dans l\'espace des caractéristiques.',
            'p2' => 'Pour un point de requête x, sélectionnez les K échantillons les plus proches et agrégiez leurs labels par vote majoritaire (ou pondéré).',
            'equation' => '$$\\hat{y}(x)=\\arg\\max_c \\sum_{i\\in \\mathcal{N}_K(x)} w_i\\,\\mathbf{1}(y_i=c)$$',
        ],
        '2' => [
            'title' => '2) Effet de K et de la Pondération par Distance',
            'li1' => 'Petit K : frontière très flexible, sensible au bruit local.',
            'li2' => 'Grand K : frontière plus lisse, variance plus faible, biais potentiellement plus élevé.',
            'li3' => 'Le vote pondéré (w=1/d) donne plus d\'influence aux voisins très proches.',
        ],
        '3' => [
            'title' => '3) Notes Pratiques',
            'p1' => 'Comme le K-NN dépend des distances, le scaling des features est critique sur des données réelles. La standardisation améliore souvent la fiabilité.',
            'p2' => 'Le coût de prédiction augmente avec la taille du dataset, car les distances doivent être calculées contre de nombreux échantillons à l\'inférence.',
            'p3' => 'Utilisez la validation pour choisir K et évaluer la robustesse face au bruit ou aux classes qui se chevauchent.',
        ],
        '4' => [
            'title' => '4) Workflow Suggéré',
            'step1' => 'Chargez une distribution demo (verticale, XOR, concentrique, chevauchement, aléatoire).',
            'step2' => 'Ajustez K et activez le vote pondéré pour comparer les frontières.',
            'step3' => 'Activez le mode Test et cliquez pour inspecter voisins et probabilité de classe.',
            'step4' => 'Augmentez la densité des régions pour plus de détails, puis réduisez-la pour un rendu plus rapide.',
        ],
    ],
    'controls' => [
        'class_a' => 'Classe A',
        'class_b' => 'Classe B',
        'test_mode' => 'Mode Test',
        'k_label' => 'K:',
        'weighted' => 'Pondéré (1/d)',
        'region_density' => 'Densité de Région :',
        'demo' => [
            'vertical' => 'Vertical Mixte',
            'xor' => 'XOR (4 Clusters)',
            'concentric' => 'Concentrique (Centre vs Anneau)',
            'overlap' => 'Chevauchement (Difficile)',
            'random' => 'Clusters Aléatoires',
        ],
        'load_demo' => 'Charger Demo',
        'refresh' => 'Actualiser',
        'clear' => 'Effacer',
        'hint' => 'Cliquez pour ajouter des échantillons. En mode Test, cliquez pour classifier un point et inspecter ses voisins.',
    ],
    'model' => [
        'title' => 'Info Modèle',
        'points' => 'Points :',
        'last_prob' => 'Dernier Test P(B) :',
    ],
    'neighbors_title' => 'Plus Proches Voisins',
];
