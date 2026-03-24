<?php

return [
    'title' => 'Visualisation de la régression linéaire',
    'subtitle' => 'Simulation interactive pour OLS, GD et SGD.',
    'accordion' => [
        '1' => [
            'title' => '1) Ce que résout la régression linéaire',
            'p1' => 'La régression linéaire estime une relation linéaire entre une entrée x et une sortie y.',
            'equation' => 'y = ax + b',
            'p2' => 'Ici, a est la pente et b l’ordonnée à l’origine. Dans ce simulateur, chaque point ajouté est un échantillon d’entraînement et le modèle trouve les meilleurs a et b.',
        ],
        '2' => [
            'title' => '2) Fonction d’erreur et pourquoi utiliser la MSE',
            'p1' => 'Le modèle minimise l’erreur quadratique moyenne (MSE) :',
            'equation' => '$$ MSE(a,b) = \\frac{1}{n}\\sum_{i=1}^{n}(y_i-(ax_i+b))^2 $$',
            'p2' => 'Le carré pénalise davantage les grandes erreurs et fournit un objectif d’optimisation lisse. Une perte plus faible signifie un meilleur ajustement.',
        ],
        '3' => [
            'title' => '3) OLS vs GD vs SGD',
            'ols' => 'Solution fermée en une seule étape.',
            'gd' => 'Utilise tous les échantillons par époque, stable mais plus lourd.',
            'sgd' => 'Mises à jour sur un seul échantillon mélangé, plus rapide mais plus bruitée.',
            'p1' => 'Utilisez les mêmes points et comparez les courbes d’apprentissage de chaque méthode.',
        ],
        '4' => [
            'title' => '4) Flux de travail recommandé',
            'step1' => 'Ajoutez des points ou chargez des données de démo.',
            'step2' => 'Exécutez d’abord OLS pour obtenir une ligne de base.',
            'step3' => 'Passez à GD/SGD et ajustez le taux d’apprentissage et les époques.',
            'step4' => 'Utilisez le Mode test pour inspecter les valeurs réelles vs prédites.',
        ],
    ],
    'controls' => [
        'add_point' => 'Ajouter un point',
        'clear_points' => 'Effacer les points',
        'load_demo' => 'Charger des données de démo',
        'hint' => 'Cliquez pour ajouter des points. Appuyez longuement sur un point pour le supprimer.',
        'method' => 'Méthode de régression',
        'method_ols' => 'OLS',
        'method_gd' => 'Descente de gradient par lot',
        'method_sgd' => 'Descente de gradient stochastique',
        'learning_rate' => 'Taux d’apprentissage',
        'epochs' => 'Époques',
        'step_train' => 'Entraînement pas à pas',
        'auto_train' => 'Entraînement auto',
        'test_mode' => 'Mode test',
    ],
    'loss_title' => 'Perte (MSE)',
    'model' => [
        'title' => 'Modèle',
        'points' => 'Points :',
        'slope' => 'Pente (a) :',
        'intercept' => 'Ordonnée à l’origine (b) :',
        'r2' => 'R2 :',
        'last_loss' => 'Dernière perte :',
    ],
    'notes' => [
        'title' => 'Notes de méthode',
        'ols' => [
            'title' => 'OLS',
            'desc' => 'Solution fermée issue de la covariance et de la variance :',
            'formula' => '$$ a = \\frac{\\sum (x_i-\\bar{x})(y_i-\\bar{y})}{\\sum (x_i-\\bar{x})^2}, \\quad b = \\bar{y} - a\\bar{x} $$',
        ],
        'gd' => [
            'title' => 'Batch GD',
            'desc' => 'Mise à jour avec les gradients sur l’ensemble du jeu de données :',
            'formula' => '$$ a \\leftarrow a - \\eta \\frac{\\partial MSE}{\\partial a}, \\quad b \\leftarrow b - \\eta \\frac{\\partial MSE}{\\partial b} $$',
        ],
        'sgd' => [
            'title' => 'SGD',
            'desc' => 'Mises à jour par échantillon avec points mélangés :',
            'formula' => '$$ a \\leftarrow a - \\eta \\cdot 2(ax_j+b-y_j)x_j, \\quad b \\leftarrow b - \\eta \\cdot 2(ax_j+b-y_j) $$',
        ],
    ],
];
