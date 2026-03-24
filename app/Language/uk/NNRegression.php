<?php

return [
    'title' => 'Лабораторія нелінійної нейронної регресії',
    'subtitle' => 'Підганяйте нелінійні криві за допомогою багатошарового персептрона і спостерігайте розходження train/validation під час overtraining.',
    'accordion' => [
        '1' => [
            'title' => '1) Формулювання моделі',
            'p1' => 'На відміну від лінійної регресії y=ax+b, ця лабораторія використовує приховані шари для навчання нелінійних відображень x -> y.',
            'equation' => '$$\\hat{y}=W_L\\,\\phi(W_{L-1}\\phi(\\cdots\\phi(W_1x+b_1)\\cdots)+b_{L-1})+b_L$$',
            'p2' => 'Обирайте depth, width та activation, щоб керувати ємністю моделі.',
        ],
        '2' => [
            'title' => '2) Loss та сигнал overfitting',
            'p1' => 'Ціль — середньоквадратична помилка на підмножині training:',
            'equation' => '$$\\text{MSE}=\\frac{1}{n}\\sum_{i=1}^{n}(y_i-\\hat{y}_i)^2$$',
            'p2' => 'Overfitting видно, коли train loss знижується, а validation loss вирівнюється або зростає.',
        ],
    ],
    'controls' => [
        'add_point' => 'Додати точку',
        'test_mode' => 'Test Mode',
        'clear' => 'Clear',
        'demo' => [
            'sine' => 'Синусоїда',
            'cubic' => 'Кубічна крива',
            'piecewise' => 'Кускова крива',
        ],
        'load_demo' => 'Load Demo',
        'hint' => 'Клікніть, щоб додати зразки. У Test Mode клікніть по x, щоб побачити прогноз y та залишок.',
    ],
    'params' => [
        'hidden_layers' => 'Приховані шари',
        'units_per_layer' => 'Юніти / шар',
        'activation' => 'Активація',
        'val_ratio' => 'Validation Ratio',
        'lr' => 'LR',
        'batch' => 'Batch',
        'epochs' => 'Epochs',
        'l2_reg' => 'L2 Reg',
        'init_model' => 'Init Model',
    ],
    'actions' => [
        'step' => 'Step',
        'run' => 'Run',
        'stop' => 'Stop',
    ],
    'status' => [
        'title' => 'Статус навчання',
        'points' => 'Точки:',
        'train_val' => 'Train / Val:',
        'epoch' => 'Епоха:',
        'train_loss' => 'Train Loss:',
        'val_loss' => 'Val Loss:',
    ],
    'interpretation' => [
        'title' => 'Інтерпретація',
        'li1' => 'Сині точки: training, помаранчеві: validation.',
        'li2' => 'Жовтий маркер у Test Mode: прогноз для вибраної x.',
        'li3' => 'Якщо train loss падає, а val loss зростає — ємність завелика або training занадто довге.',
        'li4' => 'Спробуйте сильнішу L2 regularization або менші приховані шари для зменшення overfitting.',
    ],
];
