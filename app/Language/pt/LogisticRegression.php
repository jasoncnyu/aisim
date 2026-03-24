<?php

return [
    'title' => 'Laboratorio visual de regressao logistica',
    'subtitle' => 'Simulacao de classificacao binaria com aprendizado de fronteira sigmoide.',
    'accordion' => [
        '1' => [
            'title' => '1) O que a regressao logistica faz',
            'p1' => 'A regressao logistica preve a probabilidade de pertencimento a uma classe para alvos binarios.',
            'equation' => '$$ \\hat{y} = \\sigma(z), \\quad z = mx + b, \\quad \\sigma(z)=\\frac{1}{1+e^{-z}} $$',
            'p2' => 'O modelo produz valores entre 0 e 1. Um limiar como 0.5 converte probabilidade em rotulos de classe.',
        ],
        '2' => [
            'title' => '2) Funcao objetivo (entropia cruzada binaria)',
            'p1' => 'O objetivo de treino minimiza a log-verossimilhanca negativa:',
            'equation' => '$$ L(m,b)=-\\frac{1}{n}\\sum_{i=1}^{n}\\left[y_i\\log(\\hat{y_i})+(1-y_i)\\log(1-\\hat{y_i})\\right] $$',
            'p2' => 'Essa perda penaliza fortemente previsoes erradas com alta confianca, melhorando a calibracao de probabilidades.',
        ],
        '3' => [
            'title' => '3) Atualizacoes de gradiente',
            'p1' => 'Para regressao logistica de um atributo, os gradientes em lote sao:',
            'equation1' => '$$ \\frac{\\partial L}{\\partial m}=\\frac{1}{n}\\sum(\\hat{y_i}-y_i)x_i,\\quad \\frac{\\partial L}{\\partial b}=\\frac{1}{n}\\sum(\\hat{y_i}-y_i) $$',
            'equation2' => '$$ m \\leftarrow m-\\eta\\frac{\\partial L}{\\partial m},\\quad b \\leftarrow b-\\eta\\frac{\\partial L}{\\partial b} $$',
            'p2' => 'Taxas de aprendizado menores aumentam a estabilidade, enquanto taxas maiores convergem mais rapido, mas podem oscilar.',
        ],
        '4' => [
            'title' => '4) Fluxo de trabalho pratico',
            'step1' => 'Adicione pontos de classe manualmente (faixa inferior para classe 0, faixa superior para classe 1) ou carregue dados aleatorios.',
            'step2' => 'Treine com Treino automatico e monitore a queda da perda.',
            'step3' => 'Use Passo para inspecionar o comportamento por iteracao.',
            'step4' => 'Ative o Modo de teste e clique para inspecionar a probabilidade prevista em qualquer posicao de entrada.',
        ],
    ],
    'controls' => [
        'generate_data' => 'Gerar dados de amostra',
        'auto_train' => 'Treino automatico',
        'step' => 'Passo',
        'test_mode' => 'Modo de teste',
        'reset' => 'Redefinir',
        'learning_rate' => 'LR:',
        'hint' => 'Clique no canvas para adicionar pontos. Pontos perto de y=0 representam a classe 0 e pontos perto de y=1 representam a classe 1.',
    ],
    'loss_title' => 'Curva de perda',
    'interpretation' => [
        'title' => 'Guia de interpretacao',
        'li1' => 'A curva em S amarela e a funcao de probabilidade aprendida.',
        'li2' => 'Pontos vermelhos sao classe 1, pontos cianos sao classe 0.',
        'li3' => 'A zona de transicao central aproxima a fronteira de decisao.',
        'li4' => 'A diminuicao da perda indica maior confianca na classificacao.',
    ],
];
