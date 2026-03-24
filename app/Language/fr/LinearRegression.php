<?php

return [
    'title' => 'Visualisation de la regression lineaire',
    'subtitle' => 'Simulation interactive pour OLS, GD et SGD.',
    'accordion' => [
        '1' => [
            'title' => '1) Ce que resout la regression lineaire',
            'p1' => 'La regression lineaire estime une relation lineaire entre une entree x et une sortie y.',
            'equation' => 'y = ax + b',
            'p2' => 'Ici, a est la pente et b l¡¯ordonnee a l¡¯origine. Dans ce simulateur, chaque point ajoute est un echantillon d¡¯entrainement et le modele trouve les meilleurs a et b.',
        ],
        '2' => [
            'title' => '2) Fonction d¡¯erreur et pourquoi utiliser la MSE',
            'p1' => 'Le modele minimise l¡¯erreur quadratique moyenne (MSE) :',
            'equation' => '$$ MSE(a,b) = \\frac{1}{n}\\sum_{i=1}^{n}(y_i-(ax_i+b))^2 $$',
            'p2' => 'Le carre penalise davantage les grandes erreurs et fournit un objectif d¡¯optimisation lisse. Une perte plus faible signifie un meilleur ajustement.',
        ],
        '3' => [
            'title' => '3) OLS vs GD vs SGD',
            'ols' => 'Solution fermee en une seule etape.',
            'gd' => 'Utilise tous les echantillons par epoque, stable mais plus lourd.',
            'sgd' => 'Mises a jour sur un seul echantillon melange, plus rapide mais plus bruite.',
            'p1' => 'Utilisez les memes points et comparez les courbes d¡¯apprentissage de chaque methode.',
        ],
        '4' => [
            'title' => '4) Flux de travail recommande',
            'step1' => 'Ajoutez des points ou chargez des donnees de demo.',
            'step2' => 'Executez d¡¯abord OLS pour obtenir une ligne de base.',
            'step3' => 'Passez a GD/SGD et ajustez le taux d¡¯apprentissage et les epoques.',
            'step4' => 'Utilisez le Mode test pour inspecter les valeurs reelles vs predites.',
        ],
    ],
    'controls' => [
        'add_point' => 'Ajouter un point',
        'clear_points' => 'Effacer les points',
        'load_demo' => 'Charger des donnees de demo',
        'hint' => 'Cliquez pour ajouter des points. Appuyez longuement sur un point pour le supprimer.',
        'method' => 'Methode de regression',
        'method_ols' => 'OLS',
        'method_gd' => 'Descente de gradient par lot',
        'method_sgd' => 'Descente de gradient stochastique',
        'learning_rate' => 'Taux d¡¯apprentissage',
        'epochs' => 'Epoques',
        'step_train' => 'Entrainement pas a pas',
        'auto_train' => 'Entrainement auto',
        'test_mode' => 'Mode test',
    ],
    'loss_title' => 'Perte (MSE)',
    'model' => [
        'title' => 'Modele',
        'points' => 'Points :',
        'slope' => 'Pente (a) :',
        'intercept' => 'Ordonnee a l¡¯origine (b) :',
        'r2' => 'R2 :',
        'last_loss' => 'Derniere perte :',
    ],
    'notes' => [
        'title' => 'Notes de methode',
        'ols' => [
            'title' => 'OLS',
            'desc' => 'Solution fermee issue de la covariance et de la variance :',
            'formula' => '$$ a = \\frac{\\sum (x_i-\\bar{x})(y_i-\\bar{y})}{\\sum (x_i-\\bar{x})^2}, \\quad b = \\bar{y} - a\\bar{x} $$',
        ],
        'gd' => [
            'title' => 'Batch GD',
            'desc' => 'Mise a jour avec les gradients sur l¡¯ensemble du jeu de donnees :',
            'formula' => '$$ a \\leftarrow a - \\eta \\frac{\\partial MSE}{\\partial a}, \\quad b \\leftarrow b - \\eta \\frac{\\partial MSE}{\\partial b} $$',
        ],
        'sgd' => [
            'title' => 'SGD',
            'desc' => 'Mises a jour par echantillon avec points melanges :',
            'formula' => '$$ a \\leftarrow a - \\eta \\cdot 2(ax_j+b-y_j)x_j, \\quad b \\leftarrow b - \\eta \\cdot 2(ax_j+b-y_j) $$',
        ],
    ],
];
