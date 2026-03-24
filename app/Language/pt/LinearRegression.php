<?php

return [
    'title' => 'Visualizacao de Regressao Linear',
    'subtitle' => 'Simulacao interativa para OLS, GD e SGD.',
    'accordion' => [
        '1' => [
            'title' => '1) O que a regressao linear resolve',
            'p1' => 'A regressao linear estima uma relacao de linha reta entre uma entrada x e uma saida y.',
            'equation' => 'y = ax + b',
            'p2' => 'Aqui, a e a inclinacao e b e o intercepto. Neste simulador, cada ponto que voce adiciona e uma amostra de treino e o modelo encontra os melhores a e b.',
        ],
        '2' => [
            'title' => '2) Funcao de erro e por que usar MSE',
            'p1' => 'O modelo minimiza o erro quadratico medio (MSE):',
            'equation' => '$$ MSE(a,b) = \\frac{1}{n}\\sum_{i=1}^{n}(y_i-(ax_i+b))^2 $$',
            'p2' => 'O quadrado penaliza mais erros grandes e fornece um alvo de otimizacao suave. Menor perda significa melhor ajuste.',
        ],
        '3' => [
            'title' => '3) OLS vs GD vs SGD',
            'ols' => 'Forma fechada e de uma vez.',
            'gd' => 'Usa todas as amostras por epoca, estavel porem mais pesado.',
            'sgd' => 'Atualizacoes com uma unica amostra embaralhada, mais rapido porem mais ruidoso.',
            'p1' => 'Use os mesmos pontos e compare as curvas de aprendizado de cada metodo.',
        ],
        '4' => [
            'title' => '4) Fluxo de aprendizagem sugerido',
            'step1' => 'Adicione pontos ou carregue dados de demonstracao.',
            'step2' => 'Execute OLS primeiro para obter uma linha base.',
            'step3' => 'Troque para GD/SGD e ajuste taxa de aprendizado e epocas.',
            'step4' => 'Use o Modo de teste para inspecionar valores reais vs previstos.',
        ],
    ],
    'controls' => [
        'add_point' => 'Adicionar ponto',
        'clear_points' => 'Limpar pontos',
        'load_demo' => 'Carregar dados de demonstracao',
        'hint' => 'Clique para adicionar pontos. Pressione e segure um ponto para remove-lo.',
        'method' => 'Metodo de regressao',
        'method_ols' => 'OLS',
        'method_gd' => 'Descida do gradiente em lote',
        'method_sgd' => 'Descida do gradiente estocastico',
        'learning_rate' => 'Taxa de aprendizado',
        'epochs' => 'Epocas',
        'step_train' => 'Treinar passo a passo',
        'auto_train' => 'Treinar automaticamente',
        'test_mode' => 'Modo de teste',
    ],
    'loss_title' => 'Perda (MSE)',
    'model' => [
        'title' => 'Modelo',
        'points' => 'Pontos:',
        'slope' => 'Inclinacao (a):',
        'intercept' => 'Intercepto (b):',
        'r2' => 'R2:',
        'last_loss' => 'Ultima perda:',
    ],
    'notes' => [
        'title' => 'Notas do metodo',
        'ols' => [
            'title' => 'OLS',
            'desc' => 'Solucao de forma fechada a partir de covariancia e variancia:',
            'formula' => '$$ a = \\frac{\\sum (x_i-\\bar{x})(y_i-\\bar{y})}{\\sum (x_i-\\bar{x})^2}, \\quad b = \\bar{y} - a\\bar{x} $$',
        ],
        'gd' => [
            'title' => 'Batch GD',
            'desc' => 'Atualiza usando gradientes sobre o conjunto de dados completo:',
            'formula' => '$$ a \\leftarrow a - \\eta \\frac{\\partial MSE}{\\partial a}, \\quad b \\leftarrow b - \\eta \\frac{\\partial MSE}{\\partial b} $$',
        ],
        'sgd' => [
            'title' => 'SGD',
            'desc' => 'Atualizacoes por amostra com pontos embaralhados:',
            'formula' => '$$ a \\leftarrow a - \\eta \\cdot 2(ax_j+b-y_j)x_j, \\quad b \\leftarrow b - \\eta \\cdot 2(ax_j+b-y_j) $$',
        ],
    ],
];
