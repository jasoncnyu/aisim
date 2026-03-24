<?php

return [
    'title' => 'Phòng lab trực quan hồi quy logistic',
    'subtitle' => 'Mô phỏng phân loại nhị phân với học ranh giới sigmoid.',
    'accordion' => [
        '1' => [
            'title' => '1) Hồi quy logistic làm gì',
            'p1' => 'Hồi quy logistic dự đoán xác suất thuộc lớp cho mục tiêu nhị phân.',
            'equation' => '$$ \\hat{y} = \\sigma(z), \\quad z = mx + b, \\quad \\sigma(z)=\\frac{1}{1+e^{-z}} $$',
            'p2' => 'Mô hình cho đầu ra từ 0 đến 1. Ngưỡng như 0.5 chuyển xác suất thành nhãn lớp.',
        ],
        '2' => [
            'title' => '2) Hàm mục tiêu (Binary Cross-Entropy)',
            'p1' => 'Mục tiêu huấn luyện tối thiểu hóa log-likelihood âm:',
            'equation' => '$$ L(m,b)=-\\frac{1}{n}\\sum_{i=1}^{n}\\left[y_i\\log(\\hat{y_i})+(1-y_i)\\log(1-\\hat{y_i})\\right] $$',
            'p2' => 'Loss này phạt nặng các dự đoán sai nhưng tự tin, giúp hiệu chỉnh xác suất tốt hơn.',
        ],
        '3' => [
            'title' => '3) Cập nhật gradient',
            'p1' => 'Với hồi quy logistic một đặc trưng, gradient theo batch là:',
            'equation1' => '$$ \\frac{\\partial L}{\\partial m}=\\frac{1}{n}\\sum(\\hat{y_i}-y_i)x_i,\\quad \\frac{\\partial L}{\\partial b}=\\frac{1}{n}\\sum(\\hat{y_i}-y_i) $$',
            'equation2' => '$$ m \\leftarrow m-\\eta\\frac{\\partial L}{\\partial m},\\quad b \\leftarrow b-\\eta\\frac{\\partial L}{\\partial b} $$',
            'p2' => 'Learning rate nhỏ giúp ổn định, rate lớn hội tụ nhanh hơn nhưng dễ dao động.',
        ],
        '4' => [
            'title' => '4) Quy trình thực hành',
            'step1' => 'Thêm điểm lớp thủ công (dải dưới cho lớp 0, dải trên cho lớp 1) hoặc tải dữ liệu ngẫu nhiên.',
            'step2' => 'Huấn luyện với Auto Train và theo dõi loss giảm.',
            'step3' => 'Dùng Step để quan sát hành vi từng vòng lặp.',
            'step4' => 'Bật Test Mode và nhấp để xem xác suất dự đoán tại bất kỳ vị trí đầu vào.',
        ],
    ],
    'controls' => [
        'generate_data' => 'Tạo dữ liệu mẫu',
        'auto_train' => 'Tự động huấn luyện',
        'step' => 'Bước',
        'test_mode' => 'Chế độ kiểm tra',
        'reset' => 'Đặt lại',
        'learning_rate' => 'LR:',
        'hint' => 'Nhấp lên canvas để thêm điểm. Điểm gần y=0 là lớp 0 và điểm gần y=1 là lớp 1.',
    ],
    'loss_title' => 'Đường cong loss',
    'interpretation' => [
        'title' => 'Hướng dẫn diễn giải',
        'li1' => 'Đường cong S màu vàng là hàm xác suất đã học.',
        'li2' => 'Điểm đỏ là lớp 1, điểm cyan là lớp 0.',
        'li3' => 'Vùng chuyển tiếp ở giữa xấp xỉ ranh giới quyết định.',
        'li4' => 'Loss giảm cho thấy độ tin cậy phân loại tăng.',
    ],
];
