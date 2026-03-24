<?php

return [
    'pageTitle' => 'Accueil',
    'tagline' => 'AI Simulator',
    'title' => 'Un Laboratoire Visual pour Apprendre l\'IA',
    'description' => 'AI Simulator transforme les mathématiques abstraites en expériences interactives. Développez l\'intuition en entraînant des modèles en temps réel, en observant les courbes de perte se déplacer et en voyant comment les décisions changent lorsque vous ajustez les paramètres.',
    'labels' => [
        'interactive_labs' => 'Laboratoires Interactifs',
        'live_training' => 'Entraînement en Direct',
        'explainable_visuals' => 'Visuels Explicables',
        'guided_experiments' => 'Expériences Guidées',
    ],
    'cta' => [
        'start_learning' => 'Commencer à Apprendre',
        'try_cnn_mnist' => 'Essayer CNN MNIST',
    ],
    
    // How to Use Section
    'howToUse' => [
        'title' => 'Comment Utiliser Cette Plateforme',
        'subtitle' => 'Un court chemin de la curiosité à l\'intuition confiante.',
        'steps' => [
            [
                'number' => '1',
                'label' => 'Étape',
                'title' => 'Choisir un laboratoire',
                'description' => 'Choisissez un laboratoire et lisez l\'amorce conceptuelle en haut. Il vous dit ce que le modèle essaie d\'apprendre.',
            ],
            [
                'number' => '2',
                'label' => 'Étape',
                'title' => 'Créer des données',
                'description' => 'Créez des données en cliquant, en chargeant des démonstrations ou en utilisant des images d\'exemple. La forme des données pilote tout.',
            ],
            [
                'number' => '3',
                'label' => 'Étape',
                'title' => 'Entraîner et observer',
                'description' => 'Entraînez et observez avec pas ou exécution automatique, puis regardez la courbe de perte et le comportement du modèle évoluer.',
            ],
            [
                'number' => '4',
                'label' => 'Étape',
                'title' => 'Comparer et réfléchir',
                'description' => 'Comparez et réfléchissez en changeant les hyperparamètres ou le type de modèle pour voir le biais, la variance et le surapprentissage.',
            ],
        ],
    ],
    
    // Learning Tracks Section
    'learningTracks' => [
        'title' => 'Pistes d\'Apprentissage Principales',
        'machinelearning' => [
            'title' => 'Machine Learning',
            'description' => 'Commencez ici pour comprendre comment les modèles apprennent à partir des données. Vous verrez comment une courbe simple s\'adapte aux points, comment les classifieurs tracent les limites et pourquoi la capacité du modèle est importante. Cette piste consiste à développer l\'intuition pour les fonctions de perte, les gradients et la géométrie des données.',
            'question' => 'Utilisez-le pour répondre : Pourquoi un modèle est-il mal ajusté ou surajusté ? Comment la distribution des données reformule-t-elle une limite de décision ?',
        ],
        'deeplearning' => [
            'title' => 'Deep Learning',
            'description' => 'Cette piste met à l\'échelle l\'intuition des courbes aux réseaux. Regardez comment les neurones transforment les entrées en représentations, puis voyez comment les filtres convolutifs extraient les caractéristiques visuelles. L\'accent est mis sur la façon dont la profondeur et la non-linéarité changent ce qu\'un modèle peut exprimer.',
            'question' => 'Utilisez-le pour répondre : Comment un CNN apprend-il les bords ? Pourquoi un modèle neuronal est-il surajusté alors que la perte continue de s\'améliorer ?',
        ],
    ],
];
