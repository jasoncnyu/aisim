<?php

return [
    'title' => 'Лабораторія XOR Neural Network',
    'subtitle' => 'Візуалізація forward/backward pass для маленького багатошарового персептрона.',
    'accordion' => [
        '1' => [
            'title' => '1) Чому XOR — класичний нейронний демо',
            'p1' => 'XOR не може бути розвʼязаний одним лінійним розділювачем. Модель має навчитися нелінійній поверхні рішень.',
            'p2' => 'Це робить XOR стандартною іграшковою задачею для демонстрації прихованих шарів і нелінійних активацій.',
        ],
        '2' => [
            'title' => '2) Структура мережі тут',
            'p1' => 'Симулятор використовує компактний MLP:',
            'structure' => 'Input(2) -> Hidden(4) -> Hidden(2) -> Output(1)',
            'p2' => 'Output activation — sigmoid для бінарної ймовірності. Hidden activation може бути tanh або ReLU.',
        ],
        '3' => [
            'title' => '3) Динаміка навчання',
            'p1' => 'Кожен крок вибирає один XOR випадок, виконує forward pass, рахує loss і застосовує backprop updates.',
            'equation1' => '$$ z^{(l)} = a^{(l-1)}W^{(l)} + b^{(l)}, \\quad a^{(l)} = f(z^{(l)}) $$',
            'equation2' => '$$ W \\leftarrow W - \\eta \\nabla_W L, \\quad b \\leftarrow b - \\eta \\nabla_b L $$',
        ],
        '4' => [
            'title' => '4) Як читати візуалізації',
            'li1' => 'Графік loss показує тренд збіжності під час навчання.',
            'li2' => 'Панель прогнозу показує впевненість виходу для всіх чотирьох XOR входів.',
            'li3' => 'Панель обчислень показує останні значення forward/backward для огляду.',
        ],
    ],
    'controls' => [
        'title' => 'Контролі навчання',
        'learning_rate' => 'Learning Rate',
        'sleep' => 'Sleep (ms)',
        'activation' => 'Activation',
        'step' => '+1 Step',
        'auto_train' => 'Auto Train',
        'reset' => 'Reset',
        'step_label' => 'Step:',
        'loss_label' => 'Loss:',
    ],
    'trace_title' => 'Forward/Backward Trace',
    'prediction_title' => 'Prediction Snapshot',
    'prediction_hint' => 'Більші кола означають вищу ймовірність виходу біля класу 1.',
    'targets_title' => 'XOR Targets',
    'targets' => [
        'li1' => '(0,0) -> 0',
        'li2' => '(0,1) -> 1',
        'li3' => '(1,0) -> 1',
        'li4' => '(1,1) -> 0',
    ],
];
