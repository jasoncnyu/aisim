<?php

return [
    'title' => 'Laboratorio visual de regresion logistica',
    'subtitle' => 'Simulacion de clasificacion binaria con aprendizaje de frontera sigmoide.',
    'accordion' => [
        '1' => [
            'title' => '1) Que hace la regresion logistica',
            'p1' => 'La regresion logistica predice la probabilidad de pertenencia a una clase para objetivos binarios.',
            'equation' => '$$ \\hat{y} = \\sigma(z), \\quad z = mx + b, \\quad \\sigma(z)=\\frac{1}{1+e^{-z}} $$',
            'p2' => 'El modelo produce valores entre 0 y 1. Un umbral como 0.5 convierte la probabilidad en etiquetas de clase.',
        ],
        '2' => [
            'title' => '2) Funcion objetivo (entropia cruzada binaria)',
            'p1' => 'El objetivo de entrenamiento minimiza la log-verosimilitud negativa:',
            'equation' => '$$ L(m,b)=-\\frac{1}{n}\\sum_{i=1}^{n}\\left[y_i\\log(\\hat{y_i})+(1-y_i)\\log(1-\\hat{y_i})\\right] $$',
            'p2' => 'Esta perdida penaliza fuertemente las predicciones erroneas con alta confianza, mejorando la calibracion de probabilidades.',
        ],
        '3' => [
            'title' => '3) Actualizaciones de gradiente',
            'p1' => 'Para regresion logistica de una sola caracteristica, los gradientes por lote son:',
            'equation1' => '$$ \\frac{\\partial L}{\\partial m}=\\frac{1}{n}\\sum(\\hat{y_i}-y_i)x_i,\\quad \\frac{\\partial L}{\\partial b}=\\frac{1}{n}\\sum(\\hat{y_i}-y_i) $$',
            'equation2' => '$$ m \\leftarrow m-\\eta\\frac{\\partial L}{\\partial m},\\quad b \\leftarrow b-\\eta\\frac{\\partial L}{\\partial b} $$',
            'p2' => 'Tasas de aprendizaje mas bajas mejoran la estabilidad, mientras que tasas mayores convergen mas rapido pero pueden oscilar.',
        ],
        '4' => [
            'title' => '4) Flujo de trabajo practico',
            'step1' => 'Agrega puntos de clase manualmente (banda inferior para clase 0, banda superior para clase 1) o carga datos aleatorios.',
            'step2' => 'Entrena con Entrenamiento automatico y monitorea la caida de la perdida.',
            'step3' => 'Usa Paso para inspeccionar el comportamiento por iteracion.',
            'step4' => 'Activa el Modo de prueba y haz clic para inspeccionar la probabilidad predicha en cualquier posicion de entrada.',
        ],
    ],
    'controls' => [
        'generate_data' => 'Generar datos de muestra',
        'auto_train' => 'Entrenamiento automatico',
        'step' => 'Paso',
        'test_mode' => 'Modo de prueba',
        'reset' => 'Restablecer',
        'learning_rate' => 'LR:',
        'hint' => 'Haz clic en el lienzo para agregar puntos. Los puntos cerca de y=0 representan la clase 0 y los puntos cerca de y=1 representan la clase 1.',
    ],
    'loss_title' => 'Curva de perdida',
    'interpretation' => [
        'title' => 'Guia de interpretacion',
        'li1' => 'La curva en S amarilla es la funcion de probabilidad aprendida.',
        'li2' => 'Los puntos rojos son clase 1, los puntos cian son clase 0.',
        'li3' => 'La zona de transicion central aproxima el limite de decision.',
        'li4' => 'La disminucion de la perdida indica mayor confianza de clasificacion.',
    ],
];
