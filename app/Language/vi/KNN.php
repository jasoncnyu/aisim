<?php

return [
    'title' => 'Phòng lab K-Nearest Neighbors',
    'subtitle' => 'Phân loại theo mẫu với vùng quyết định, kiểm tra láng giềng và bỏ phiếu có trọng số.',
    'accordion' => [
        '1' => [
            'title' => '1) Ý tưởng cốt lõi của K-NN',
            'p1' => 'K-NN không học tham số mô hình toàn cục. Nó dự đoán dựa trên nhãn của các điểm huấn luyện gần trong không gian đặc trưng.',
            'p2' => 'Với điểm truy vấn x, chọn K mẫu gần nhất và tổng hợp nhãn bằng đa số (hoặc bỏ phiếu có trọng số).',
            'equation' => '$$\\hat{y}(x)=\\arg\\max_c \\sum_{i\\in \\mathcal{N}_K(x)} w_i\\,\\mathbf{1}(y_i=c)$$',
        ],
        '2' => [
            'title' => '2) Ảnh hưởng của K và trọng số theo khoảng cách',
            'li1' => 'K nhỏ: ranh giới linh hoạt nhưng nhạy với nhiễu cục bộ.',
            'li2' => 'K lớn: ranh giới mượt hơn, phương sai thấp hơn, có thể tăng bias.',
            'li3' => 'Bỏ phiếu có trọng số (w=1/d) tăng ảnh hưởng của láng giềng rất gần.',
        ],
        '3' => [
            'title' => '3) Ghi chú thực tế',
            'p1' => 'Vì K-NN dựa trên khoảng cách, chuẩn hóa đặc trưng rất quan trọng. Chuẩn hóa thường tăng độ tin cậy.',
            'p2' => 'Chi phí dự đoán tăng theo kích thước dữ liệu do phải tính khoảng cách với nhiều mẫu.',
            'p3' => 'Dùng tập kiểm tra để chọn K và đánh giá độ bền với dữ liệu nhiễu hoặc chồng lấp.',
        ],
        '4' => [
            'title' => '4) Quy trình gợi ý',
            'step1' => 'Tải phân phối demo (dọc, XOR, đồng tâm, chồng lấp, ngẫu nhiên).',
            'step2' => 'Chỉnh K và bật/tắt bỏ phiếu trọng số để so sánh ranh giới.',
            'step3' => 'Bật Test Mode và nhấp để xem láng giềng gần nhất và xác suất lớp.',
            'step4' => 'Tăng mật độ vùng để xem chi tiết ranh giới, sau đó giảm để render nhanh hơn.',
        ],
    ],
    'controls' => [
        'class_a' => 'Lớp A',
        'class_b' => 'Lớp B',
        'test_mode' => 'Chế độ kiểm tra',
        'k_label' => 'K:',
        'weighted' => 'Trọng số (1/d)',
        'region_density' => 'Mật độ vùng:',
        'demo' => [
            'vertical' => 'Trộn dọc',
            'xor' => 'XOR (4 cụm)',
            'concentric' => 'Đồng tâm (Tâm vs Vòng)',
            'overlap' => 'Chồng lấp (khó)',
            'random' => 'Cụm ngẫu nhiên',
        ],
        'load_demo' => 'Tải demo',
        'refresh' => 'Làm mới',
        'clear' => 'Xóa',
        'hint' => 'Nhấp để thêm mẫu huấn luyện. Trong Test Mode, nhấp để phân loại điểm truy vấn và xem láng giềng gần nhất.',
    ],
    'model' => [
        'title' => 'Thông tin mô hình',
        'points' => 'Số điểm:',
        'last_prob' => 'P(B) gần nhất:',
    ],
    'neighbors_title' => 'Láng giềng gần nhất',
];
