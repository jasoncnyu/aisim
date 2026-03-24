<?php

return [
    'title' => 'Laboratoire visuel de régression logistique',
    'subtitle' => 'Simulation de classification binaire avec apprentissage de frontière sigmoïde.',
    'accordion' => [
        '1' => [
            'title' => '1) Ce que fait la régression logistique',
            'p1' => 'La régression logistique prédit la probabilité d’appartenance à une classe pour des cibles binaires.',
            'equation' => '$$ \\hat{y} = \\sigma(z), \\quad z = mx + b, \\quad \\sigma(z)=\\frac{1}{1+e^{-z}} $$',
            'p2' => 'Le modèle produit des valeurs entre 0 et 1. Un seuil comme 0,5 convertit la probabilité en étiquettes de classe.',
        ],
        '2' => [
            'title' => '2) Fonction objectif (entropie croisée binaire)',
            'p1' => 'L’objectif d’entraînement minimise la log-vraisemblance négative :',
            'equation' => '$$ L(m,b)=-\\frac{1}{n}\\sum_{i=1}^{n}\\left[y_i\\log(\\hat{y_i})+(1-y_i)\\log(1-\\hat{y_i})\\right] $$',
            'p2' => 'Cette perte pénalise fortement les mauvaises prédictions confiantes, améliorant la calibration des probabilités.',
        ],
        '3' => [
            'title' => '3) Mises à jour du gradient',
            'p1' => 'Pour une régression logistique à une seule caractéristique, les gradients par lot sont :',
            'equation1' => '$$ \\frac{\\partial L}{\\partial m}=\\frac{1}{n}\\sum(\\hat{y_i}-y_i)x_i,\\quad \\frac{\\partial L}{\\partial b}=\\frac{1}{n}\\sum(\\hat{y_i}-y_i) $$',
            'equation2' => '$$ m \\leftarrow m-\\eta\\frac{\\partial L}{\\partial m},\\quad b \\leftarrow b-\\eta\\frac{\\partial L}{\\partial b} $$',
            'p2' => 'Des taux d’apprentissage plus faibles améliorent la stabilité, tandis que des taux plus élevés convergent plus vite mais peuvent osciller.',
        ],
        '4' => [
            'title' => '4) Flux de travail pratique',
            'step1' => 'Ajoutez des points de classe manuellement (bande inférieure pour la classe 0, bande supérieure pour la classe 1) ou chargez des données aléatoires.',
            'step2' => 'Entraînez avec Entraînement auto et suivez la baisse de la perte.',
            'step3' => 'Utilisez Pas pour inspecter le comportement à chaque itération.',
            'step4' => 'Activez le Mode test et cliquez pour inspecter la probabilité prédite à n’importe quelle position d’entrée.',
        ],
    ],
    'controls' => [
        'generate_data' => 'Générer des données d’exemple',
        'auto_train' => 'Entraînement auto',
        'step' => 'Pas',
        'test_mode' => 'Mode test',
        'reset' => 'Réinitialiser',
        'learning_rate' => 'LR :',
        'hint' => 'Cliquez sur le canevas pour ajouter des points. Les points près de y=0 représentent la classe 0 et ceux près de y=1 la classe 1.',
    ],
    'loss_title' => 'Courbe de perte',
    'interpretation' => [
        'title' => 'Guide d’interprétation',
        'li1' => 'La courbe en S jaune est la fonction de probabilité apprise.',
        'li2' => 'Les points rouges sont la classe 1, les points cyan la classe 0.',
        'li3' => 'La zone de transition centrale approxime la frontière de décision.',
        'li4' => 'La diminution de la perte indique une meilleure confiance de classification.',
    ],
];
