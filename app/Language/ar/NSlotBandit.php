<?php

return [
    'title' => 'مختبر N-Slot Bandit',
    'subtitle' => 'قارن بين استراتيجيات الاستكشاف-الاستغلال في bandit متعدد الأذرع.',
    'accordion' => [
        '1' => [
            'title' => '1) إعداد المشكلة',
            'p1' => 'لكل ذراع احتمال مكافأة برنولي غير معروف. في كل خطوة يختار الوكيل ذراعًا ويلاحظ مكافأة 0 أو 1.',
        ],
        '2' => [
            'title' => '2) الخوارزميات المُقارنة',
            'li1_label' => 'Epsilon-Greedy',
            'li1' => 'استكشاف عشوائي باحتمال epsilon.',
            'li2_label' => 'UCB1',
            'li2' => 'مكافأة تفاؤل للأذرع غير المؤكدة.',
            'li3_label' => 'Thompson Sampling',
            'li3' => 'أخذ عينات بايزية عبر توزيعات Beta.',
        ],
    ],
    'controls' => [
        'algorithm' => 'الخوارزمية',
        'eps_greedy' => 'Epsilon-Greedy',
        'ucb1' => 'UCB1',
        'thompson' => 'Thompson Sampling',
        'arms' => 'الأذرع (N)',
        'steps' => 'الخطوات',
        'runs' => 'التشغيلات',
        'epsilon' => 'Epsilon',
        'seed' => 'البذرة',
        'optional' => 'اختياري',
        'randomize' => 'عشوائية الاحتمالات',
        'apply' => 'تطبيق',
        'run' => 'تشغيل',
        'step' => 'خطوة',
        'stop' => 'إيقاف',
        'reset' => 'إعادة ضبط',
        'export_csv' => 'تصدير CSV',
    ],
    'charts' => [
        'avg_reward' => 'متوسط المكافأة',
        'cum_regret' => 'الندم التراكمي',
    ],
    'arms' => [
        'title' => 'الأذرع (الاحتمالات الحقيقية)',
        'subtitle' => 'حرّر يدويًا أو عشوّئ ثم اضغط تطبيق.',
    ],
    'run_info' => [
        'title' => 'معلومات التشغيل',
        'current_run' => 'التشغيل الحالي:',
        'step' => 'الخطوة:',
        'avg_reward' => 'متوسط المكافأة:',
        'cum_regret' => 'الندم التراكمي:',
    ],
];
