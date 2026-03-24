<?php

return [
    'title' => 'Laboratoire visuel de regression logistique',
    'subtitle' => 'Simulation de classification binaire avec apprentissage de frontiere sigmoide.',
    'accordion' => [
        '1' => [
            'title' => '1) Ce que fait la regression logistique',
            'p1' => 'La regression logistique predit la probabilite d¡¯appartenance a une classe pour des cibles binaires.',
            'equation' => '$$ \\hat{y} = \\sigma(z), \\quad z = mx + b, \\quad \\sigma(z)=\\frac{1}{1+e^{-z}} $$',
            'p2' => 'Le modele produit des valeurs entre 0 et 1. Un seuil comme 0,5 convertit la probabilite en etiquettes de classe.',
        ],
        '2' => [
            'title' => '2) Fonction objectif (entropie croisee binaire)',
            'p1' => 'L¡¯objectif d¡¯entrainement minimise la log-vraisemblance negative :',
            'equation' => '$$ L(m,b)=-\\frac{1}{n}\\sum_{i=1}^{n}\\left[y_i\\log(\\hat{y_i})+(1-y_i)\\log(1-\\hat{y_i})\\right] $$',
            'p2' => 'Cette perte penalise fortement les mauvaises predictions confiantes, ameliorant la calibration des probabilites.',
        ],
        '3' => [
            'title' => '3) Mises a jour du gradient',
            'p1' => 'Pour une regression logistique a une seule caracteristique, les gradients par lot sont :',
            'equation1' => '$$ \\frac{\\partial L}{\\partial m}=\\frac{1}{n}\\sum(\\hat{y_i}-y_i)x_i,\\quad \\frac{\\partial L}{\\partial b}=\\frac{1}{n}\\sum(\\hat{y_i}-y_i) $$',
            'equation2' => '$$ m \\leftarrow m-\\eta\\frac{\\partial L}{\\partial m},\\quad b \\leftarrow b-\\eta\\frac{\\partial L}{\\partial b} $$',
            'p2' => 'Des taux d¡¯apprentissage plus faibles ameliorent la stabilite, tandis que des taux plus eleves convergent plus vite mais peuvent osciller.',
        ],
        '4' => [
            'title' => '4) Flux de travail pratique',
            'step1' => 'Ajoutez des points de classe manuellement (bande inferieure pour la classe 0, bande superieure pour la classe 1) ou chargez des donnees aleatoires.',
            'step2' => 'Entrainez avec Entrainement auto et suivez la baisse de la perte.',
            'step3' => 'Utilisez Pas pour inspecter le comportement a chaque iteration.',
            'step4' => 'Activez le Mode test et cliquez pour inspecter la probabilite predite a n¡¯importe quelle position d¡¯entree.',
        ],
    ],
    'controls' => [
        'generate_data' => 'Generer des donnees d¡¯exemple',
        'auto_train' => 'Entrainement auto',
        'step' => 'Pas',
        'test_mode' => 'Mode test',
        'reset' => 'Reinitialiser',
        'learning_rate' => 'LR :',
        'hint' => 'Cliquez sur le canevas pour ajouter des points. Les points pres de y=0 representent la classe 0 et ceux pres de y=1 la classe 1.',
    ],
    'loss_title' => 'Courbe de perte',
    'interpretation' => [
        'title' => 'Guide d¡¯interpretation',
        'li1' => 'La courbe en S jaune est la fonction de probabilite apprise.',
        'li2' => 'Les points rouges sont la classe 1, les points cyan la classe 0.',
        'li3' => 'La zone de transition centrale approxime la frontiere de decision.',
        'li4' => 'La diminution de la perte indique une meilleure confiance de classification.',
    ],
];
