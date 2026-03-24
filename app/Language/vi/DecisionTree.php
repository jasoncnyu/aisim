<?php

return [
    'title' => 'Phòng lab trực quan cây quyết định',
    'subtitle' => 'Mô phỏng tách theo trục cho phân loại nhị phân.',
    'accordion' => [
        '1' => [
            'title' => '1) Cây quyết định học như thế nào',
            'p1' => 'Cây quyết định chia dữ liệu đệ quy thành các vùng nhỏ hơn. Trong mô phỏng này, mỗi lần tách theo trục x hoặc y với một ngưỡng.',
            'p2' => 'Mỗi nút trong hỏi một quy tắc như x <= 22. Nút lá xuất xác suất lớp và nhãn cuối cùng.',
        ],
        '2' => [
            'title' => '2) Chất lượng tách: Gini',
            'p1' => 'Với tỉ lệ lớp p_k, độ nhiễm Gini là:',
            'equation' => '$$ G = 1 - \\sum_k p_k^2 $$',
            'p2' => 'Mô hình thử các tách ứng viên và chọn tách làm nhỏ nhất độ nhiễm có trọng số.',
        ],
        '3' => [
            'title' => '3) Điều kiện dừng và tổng quát hóa',
            'li1' => 'Độ sâu tối đa giới hạn độ phức tạp của cây.',
            'li2' => 'Số mẫu tối thiểu tránh các tách vi mô không ổn định.',
            'li3' => 'Lá thuần (chỉ một lớp) sẽ dừng tự nhiên.',
            'p1' => 'Cây nông thường tổng quát tốt hơn, cây sâu dễ overfit nhiễu cục bộ.',
        ],
        '4' => [
            'title' => '4) Quy trình gợi ý',
            'step1' => 'Thêm điểm lớp A và lớp B, hoặc tải mẫu demo có sẵn.',
            'step2' => 'Huấn luyện với các cấu hình độ sâu tối đa / số mẫu tối thiểu khác nhau.',
            'step3' => 'Quan sát ranh giới vùng, quy tắc cây và nhật ký tách.',
            'step4' => 'So sánh cây đơn giản và cây phức tạp về khả năng diễn giải và độ khớp.',
        ],
    ],
    'controls' => [
        'class_a' => 'Lớp A',
        'class_b' => 'Lớp B',
        'train' => 'Huấn luyện',
        'clear' => 'Xóa',
        'demo' => [
            'random_clusters' => 'Cụm ngẫu nhiên trộn',
            'concentric' => 'Đồng tâm (Tâm vs Vòng)',
            'xor' => 'Mẫu XOR',
            'overlap' => 'Cụm chồng lấp',
        ],
        'load_demo' => 'Tải demo',
        'max_depth' => 'Độ sâu tối đa:',
        'min_samples' => 'Số mẫu tối thiểu:',
        'show_regions' => 'Hiển thị vùng',
        'hint' => 'Nhấp lên canvas để thêm mẫu theo ô lưới, sau đó huấn luyện để tạo quy tắc tách và vùng quyết định.',
    ],
    'model' => [
        'title' => 'Thông tin mô hình',
        'points' => 'Số điểm:',
        'last_split' => 'Điểm tách gần nhất:',
        'points_a' => 'Điểm A',
        'points_b' => 'Điểm B',
    ],
    'tree_title' => 'Cây quyết định (văn bản)',
    'calc_title' => 'Nhật ký tính toán tách',
];
