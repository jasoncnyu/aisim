<?php

return [
    'title' => 'Phòng lab N-Slot Bandit',
    'subtitle' => 'So sánh chiến lược khám phá–khai thác trong bài toán bandit đa tay.',
    'accordion' => [
        '1' => [
            'title' => '1) Thiết lập bài toán',
            'p1' => 'Mỗi tay có xác suất thưởng Bernoulli chưa biết. Mỗi bước tác nhân chọn một tay và nhận thưởng 0 hoặc 1.',
        ],
        '2' => [
            'title' => '2) Thuật toán so sánh',
            'li1_label' => 'Epsilon-Greedy',
            'li1' => 'khám phá ngẫu nhiên với xác suất epsilon.',
            'li2_label' => 'UCB1',
            'li2' => 'cộng thêm bonus lạc quan cho tay chưa chắc chắn.',
            'li3_label' => 'Thompson Sampling',
            'li3' => 'lấy mẫu hậu nghiệm Bayes bằng phân phối Beta.',
        ],
    ],
    'controls' => [
        'algorithm' => 'Thuật toán',
        'eps_greedy' => 'Epsilon-Greedy',
        'ucb1' => 'UCB1',
        'thompson' => 'Thompson Sampling',
        'arms' => 'Số tay (N)',
        'steps' => 'Bước',
        'runs' => 'Lượt chạy',
        'epsilon' => 'Epsilon',
        'seed' => 'Seed',
        'optional' => 'tùy chọn',
        'randomize' => 'Ngẫu nhiên hóa xác suất',
        'apply' => 'Áp dụng',
        'run' => 'Chạy',
        'step' => 'Bước',
        'stop' => 'Dừng',
        'reset' => 'Đặt lại',
        'export_csv' => 'Xuất CSV',
    ],
    'charts' => [
        'avg_reward' => 'Thưởng trung bình',
        'cum_regret' => 'Hối tiếc tích lũy',
    ],
    'arms' => [
        'title' => 'Các tay (xác suất thật)',
        'subtitle' => 'Chỉnh thủ công hoặc ngẫu nhiên hóa, rồi nhấn Áp dụng.',
    ],
    'run_info' => [
        'title' => 'Thông tin chạy',
        'current_run' => 'Lượt chạy hiện tại:',
        'step' => 'Bước:',
        'avg_reward' => 'Thưởng TB:',
        'cum_regret' => 'Hối tiếc TL:',
    ],
];
