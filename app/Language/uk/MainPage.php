<?php

return [
    'pageTitle' => 'Головна',
    'tagline' => 'AI Simulator',
    'title' => 'Візуальна лабораторія для вивчення ШІ',
    'description' => 'AI Simulator перетворює абстрактну математику на інтерактивні експерименти. Розвивайте інтуїцію, тренуючи моделі в реальному часі, спостерігаючи за кривими loss і бачачи, як змінюються рішення під час налаштування параметрів.',
    'labels' => [
        'interactive_labs' => 'Інтерактивні лабораторії',
        'live_training' => 'Живе навчання',
        'explainable_visuals' => 'Пояснювальні візуалізації',
        'guided_experiments' => 'Керовані експерименти',
    ],
    'cta' => [
        'start_learning' => 'Почати навчання',
        'try_cnn_mnist' => 'Спробувати CNN MNIST',
    ],
    
    // How to Use Section
    'howToUse' => [
        'title' => 'Як користуватися платформою',
        'subtitle' => 'Короткий шлях від цікавості до впевненої інтуїції.',
        'steps' => [
            [
                'number' => '1',
                'label' => 'Крок',
                'title' => 'Оберіть лабораторію',
                'description' => 'Оберіть лабораторію і прочитайте опис концепції зверху. Він пояснює, чого модель намагається навчитися.',
            ],
            [
                'number' => '2',
                'label' => 'Крок',
                'title' => 'Створіть дані',
                'description' => 'Створюйте дані кліками, завантаженням демо або використанням зразкових зображень. Форма даних визначає все.',
            ],
            [
                'number' => '3',
                'label' => 'Крок',
                'title' => 'Тренуйте та спостерігайте',
                'description' => 'Тренуйте за допомогою step або auto-run і спостерігайте за кривою loss та еволюцією поведінки моделі.',
            ],
            [
                'number' => '4',
                'label' => 'Крок',
                'title' => 'Порівнюйте та аналізуйте',
                'description' => 'Змінюйте гіперпараметри або тип моделі, щоб побачити bias, variance та overfitting.',
            ],
        ],
    ],
    
    // Learning Tracks Section
    'learningTracks' => [
        'title' => 'Основні треки навчання',
        'machinelearning' => [
            'title' => 'Machine Learning',
            'description' => 'Почніть тут, щоб зрозуміти, як моделі навчаються з даних. Ви побачите, як проста крива підлаштовується під точки, як класифікатори проводять межі та чому потужність моделі має значення. Цей трек формує інтуїцію щодо loss, градієнтів і геометрії даних.',
            'question' => 'Відповісти: Чому модель underfit або overfit? Як розподіл даних змінює decision boundary?',
            'labs' => [
                'Linear Regression',
                'Logistic Regression',
                'Decision Tree',
                'K-Means',
                'K-NN',
                'SVM',
            ],
        ],
        'deeplearning' => [
            'title' => 'Deep Learning',
            'description' => 'Цей трек масштабує інтуїцію від кривих до мереж. Спостерігайте, як нейрони перетворюють входи на представлення, і як згорткові фільтри витягують візуальні ознаки. Фокус на тому, як depth і нелінійність змінюють виразність моделі.',
            'question' => 'Відповісти: Як CNN вчиться межам? Чому нейронна модель overfit, навіть коли loss продовжує знижуватися?',
            'labs' => [
                'NN Regression',
                'CNN Binary',
                'CNN MNIST',
                'XOR Lab',
                'Tiny Web LLM',
            ],
        ],
        'reinforcement' => [
            'title' => 'Reinforcement Learning',
            'description' => 'Тут модель — агент, що вчиться з винагород, а не з розмічених прикладів. Ви дослідите exploration vs exploitation, sparse rewards і роль динаміки середовища.',
            'question' => 'Відповісти: Коли краще досліджувати? Як структура винагород формує поведінку?',
            'labs' => [
                'N-Slot Bandit',
                'Grid World',
            ],
        ],
    ],
    'quickStart' => [
        'title' => 'Швидкий старт',
        'items' => [
            [
                'label' => 'Новачок у ML?',
                'text' => 'Почніть з Linear Regression та Logistic Regression, потім порівняйте з Decision Tree.',
            ],
            [
                'label' => 'Цікавлять криві?',
                'text' => 'Спробуйте NN Regression, щоб побачити як depth і width змінюють fit.',
            ],
            [
                'label' => 'Хочете візуальну інтуїцію?',
                'text' => 'Перейдіть до CNN MNIST і намалюйте цифри для тесту inference.',
            ],
        ],
        'cta' => [
            'start_linear' => 'Почати з Linear Regression',
            'explore_nn' => 'Дослідити NN Regression',
        ],
    ],
];
