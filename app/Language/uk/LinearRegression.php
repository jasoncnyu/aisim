<?php

return [
    'title' => 'Візуалізація лінійної регресії',
    'subtitle' => 'Інтерактивна симуляція для OLS, GD та SGD.',
    'accordion' => [
        '1' => [
            'title' => '1) Що розвʼязує лінійна регресія',
            'p1' => 'Лінійна регресія оцінює прямолінійний звʼязок між входом x та виходом y.',
            'equation' => 'y = ax + b',
            'p2' => 'Тут a — нахил, b — перетин. У цьому симуляторі кожна точка — це training sample, і модель знаходить найкращі a та b.',
        ],
        '2' => [
            'title' => '2) Функція помилки та чому використовується MSE',
            'p1' => 'Модель мінімізує середньоквадратичну помилку (MSE):',
            'equation' => '$$ MSE(a,b) = \\frac{1}{n}\\sum_{i=1}^{n}(y_i-(ax_i+b))^2 $$',
            'p2' => 'Квадрат сильніше штрафує великі помилки і дає гладку ціль оптимізації. Менша loss означає кращий fit.',
        ],
        '3' => [
            'title' => '3) OLS vs GD vs SGD',
            'ols' => 'Closed-form і one-shot.',
            'gd' => 'Використовує всі зразки за епоху, стабільно, але повільніше.',
            'sgd' => 'Оновлення по одному зразку з shuffle, швидше але більш шумно.',
            'p1' => 'Використайте ті самі точки і порівняйте криві навчання для кожного методу.',
        ],
        '4' => [
            'title' => '4) Рекомендований workflow',
            'step1' => 'Додайте точки або завантажте demo data.',
            'step2' => 'Спершу запустіть OLS для baseline.',
            'step3' => 'Перейдіть до GD/SGD і налаштуйте learning rate та epochs.',
            'step4' => 'У Test Mode порівняйте фактичні та передбачені значення.',
        ],
    ],
    'controls' => [
        'add_point' => 'Додати точку',
        'clear_points' => 'Очистити точки',
        'load_demo' => 'Завантажити demo data',
        'hint' => 'Клікніть, щоб додати точки. Довге натискання видаляє точку.',
        'method' => 'Метод регресії',
        'method_ols' => 'OLS',
        'method_gd' => 'Batch Gradient Descent',
        'method_sgd' => 'Stochastic Gradient Descent',
        'learning_rate' => 'Learning Rate',
        'epochs' => 'Epochs',
        'step_train' => 'Step Train',
        'auto_train' => 'Auto Train',
        'test_mode' => 'Test Mode',
    ],
    'loss_title' => 'Loss (MSE)',
    'model' => [
        'title' => 'Модель',
        'points' => 'Точки:',
        'slope' => 'Нахил (a):',
        'intercept' => 'Перетин (b):',
        'r2' => 'R2:',
        'last_loss' => 'Остання loss:',
    ],
    'notes' => [
        'title' => 'Примітки до методів',
        'ols' => [
            'title' => 'OLS',
            'desc' => 'Closed-form розвʼязок з коваріації та дисперсії:',
            'formula' => '$$ a = \\frac{\\sum (x_i-\\bar{x})(y_i-\\bar{y})}{\\sum (x_i-\\bar{x})^2}, \\quad b = \\bar{y} - a\\bar{x} $$',
        ],
        'gd' => [
            'title' => 'Batch GD',
            'desc' => 'Оновлення з градієнтами по всьому набору даних:',
            'formula' => '$$ a \\leftarrow a - \\eta \\frac{\\partial MSE}{\\partial a}, \\quad b \\leftarrow b - \\eta \\frac{\\partial MSE}{\\partial b} $$',
        ],
        'sgd' => [
            'title' => 'SGD',
            'desc' => 'Оновлення по одному зразку з перемішуванням:',
            'formula' => '$$ a \\leftarrow a - \\eta \\cdot 2(ax_j+b-y_j)x_j, \\quad b \\leftarrow b - \\eta \\cdot 2(ax_j+b-y_j) $$',
        ],
    ],
];
