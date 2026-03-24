<?php

return [
    'title' => 'Trực quan hồi quy tuyến tính',
    'subtitle' => 'Mô phỏng tương tác cho OLS, GD và SGD.',
    'accordion' => [
        '1' => [
            'title' => '1) Hồi quy tuyến tính giải quyết gì',
            'p1' => 'Hồi quy tuyến tính ước lượng mối quan hệ đường thẳng giữa đầu vào x và đầu ra y.',
            'equation' => 'y = ax + b',
            'p2' => 'Trong đó a là hệ số góc và b là hệ số chặn. Trong mô phỏng này, mỗi điểm bạn thêm là một mẫu huấn luyện và mô hình tìm a, b tốt nhất.',
        ],
        '2' => [
            'title' => '2) Hàm lỗi và lý do dùng MSE',
            'p1' => 'Mô hình tối thiểu hóa sai số bình phương trung bình (MSE):',
            'equation' => '$$ MSE(a,b) = \\frac{1}{n}\\sum_{i=1}^{n}(y_i-(ax_i+b))^2 $$',
            'p2' => 'Bình phương phạt lỗi lớn mạnh hơn và tạo mục tiêu tối ưu trơn. Loss thấp hơn nghĩa là khớp tốt hơn.',
        ],
        '3' => [
            'title' => '3) OLS vs GD vs SGD',
            'ols' => 'Công thức đóng, chạy một lần.',
            'gd' => 'Dùng toàn bộ mẫu mỗi epoch, ổn định nhưng nặng.',
            'sgd' => 'Cập nhật theo từng mẫu đã xáo trộn, nhanh nhưng nhiễu hơn.',
            'p1' => 'Dùng cùng một tập điểm và so sánh đường cong học của từng phương pháp.',
        ],
        '4' => [
            'title' => '4) Quy trình gợi ý',
            'step1' => 'Thêm điểm hoặc tải dữ liệu demo.',
            'step2' => 'Chạy OLS trước để có đường cơ sở.',
            'step3' => 'Chuyển sang GD/SGD và chỉnh learning rate cùng số epoch.',
            'step4' => 'Dùng Test Mode để so sánh giá trị thực vs dự đoán.',
        ],
    ],
    'controls' => [
        'add_point' => 'Thêm điểm',
        'clear_points' => 'Xóa điểm',
        'load_demo' => 'Tải dữ liệu demo',
        'hint' => 'Nhấp để thêm điểm. Nhấn giữ một điểm để xóa.',
        'method' => 'Phương pháp hồi quy',
        'method_ols' => 'OLS',
        'method_gd' => 'Batch Gradient Descent',
        'method_sgd' => 'Stochastic Gradient Descent',
        'learning_rate' => 'Learning Rate',
        'epochs' => 'Epochs',
        'step_train' => 'Huấn luyện theo bước',
        'auto_train' => 'Tự động huấn luyện',
        'test_mode' => 'Chế độ kiểm tra',
    ],
    'loss_title' => 'Loss (MSE)',
    'model' => [
        'title' => 'Mô hình',
        'points' => 'Số điểm:',
        'slope' => 'Hệ số góc (a):',
        'intercept' => 'Hệ số chặn (b):',
        'r2' => 'R2:',
        'last_loss' => 'Loss gần nhất:',
    ],
    'notes' => [
        'title' => 'Ghi chú phương pháp',
        'ols' => [
            'title' => 'OLS',
            'desc' => 'Lời giải đóng từ hiệp phương sai và phương sai:',
            'formula' => '$$ a = \\frac{\\sum (x_i-\\bar{x})(y_i-\\bar{y})}{\\sum (x_i-\\bar{x})^2}, \\quad b = \\bar{y} - a\\bar{x} $$',
        ],
        'gd' => [
            'title' => 'Batch GD',
            'desc' => 'Cập nhật theo gradient trên toàn bộ dữ liệu:',
            'formula' => '$$ a \\leftarrow a - \\eta \\frac{\\partial MSE}{\\partial a}, \\quad b \\leftarrow b - \\eta \\frac{\\partial MSE}{\\partial b} $$',
        ],
        'sgd' => [
            'title' => 'SGD',
            'desc' => 'Cập nhật theo từng mẫu với điểm đã xáo trộn:',
            'formula' => '$$ a \\leftarrow a - \\eta \\cdot 2(ax_j+b-y_j)x_j, \\quad b \\leftarrow b - \\eta \\cdot 2(ax_j+b-y_j) $$',
        ],
    ],
];
