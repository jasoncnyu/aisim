<?php

return [
    'title' => 'Phòng lab K-Means',
    'subtitle' => 'Mô phỏng phân cụm 2D với vùng Voronoi, cập nhật tâm cụm và theo dõi quán tính.',
    'accordion' => [
        '1' => [
            'title' => '1) K-Means tối ưu gì',
            'p1' => 'K-Means chia dữ liệu thành K cụm bằng cách giảm khoảng cách bình phương trong cụm (inertia).',
            'equation' => '$$ J = \\sum_{i=1}^{N} \\min_{1 \\leq j \\leq K} \\left\\lVert x_i - \\mu_j \\right\\rVert^2 $$',
            'p2' => 'Mỗi mẫu được gán vào tâm gần nhất, sau đó các tâm được tính lại bằng trung bình các mẫu được gán.',
        ],
        '2' => [
            'title' => '2) Lặp Lloyd (Gán rồi cập nhật)',
            'p1' => 'Thuật toán luân phiên giữa hai bước xác định:',
            'equation1' => '$$ c_i \\leftarrow \\arg\\min_j \\lVert x_i - \\mu_j \\rVert^2 $$',
            'equation2' => '$$ \\mu_j \\leftarrow \\frac{1}{|C_j|}\\sum_{x_i \\in C_j} x_i $$',
            'p2' => 'Inertia giảm đơn điệu cho đến khi hội tụ về cực trị cục bộ.',
        ],
        '3' => [
            'title' => '3) Vì sao khởi tạo quan trọng',
            'p1' => 'Khởi tạo ngẫu nhiên đơn giản nhưng có thể bắt đầu từ seed kém.',
            'p2' => 'k-means++ phân tán các tâm ban đầu, thường hội tụ nhanh hơn và có inertia cuối thấp hơn.',
            'p3' => 'Trong thực tế, chạy nhiều lần với seed khác nhau để giảm nhạy cảm cực trị cục bộ.',
        ],
        '4' => [
            'title' => '4) Quy trình thí nghiệm gợi ý',
            'step1' => 'Tải điểm demo, rồi so sánh khởi tạo Random và k-means++.',
            'step2' => 'Thử các giá trị K khác nhau và quan sát ranh giới vùng cùng số cụm.',
            'step3' => 'Dùng Step để xem từng chu kỳ gán/cập nhật.',
            'step4' => 'Chạy đến hội tụ và so sánh inertia cuối giữa các cấu hình.',
        ],
    ],
    'controls' => [
        'k_label' => 'K:',
        'init_label' => 'Khởi tạo:',
        'init_random' => 'Ngẫu nhiên',
        'init_plus' => 'k-means++',
        'region_density' => 'Mật độ vùng:',
        'load_demo' => 'Tải demo',
        'init_centroids' => 'Khởi tạo tâm',
        'step' => 'Bước',
        'run' => 'Chạy',
        'stop' => 'Dừng',
        'clear' => 'Xóa',
        'hint' => 'Nhấp lên canvas để thêm điểm. Nhấn giữ (hoặc chuột phải) để xóa điểm gần nhất.',
    ],
    'status' => [
        'title' => 'Trạng thái',
        'points' => 'Số điểm:',
        'k' => 'K:',
        'iteration' => 'Vòng lặp:',
        'inertia' => 'Inertia:',
        'shift' => 'Dịch chuyển tâm:',
    ],
    'inertia_title' => 'Đường cong inertia',
    'summary_title' => 'Tóm tắt cụm',
];
