<?php

return [
    'pageTitle' => 'Trang chủ',
    'tagline' => 'AI Simulator',
    'title' => 'Phòng thí nghiệm trực quan để học AI',
    'description' => 'AI Simulator biến toán học trừu tượng thành các thí nghiệm tương tác. Xây dựng trực giác bằng cách huấn luyện mô hình theo thời gian thực, quan sát đường cong loss và thấy quyết định thay đổi khi bạn điều chỉnh tham số.',
    'labels' => [
        'interactive_labs' => 'Phòng lab tương tác',
        'live_training' => 'Huấn luyện trực tiếp',
        'explainable_visuals' => 'Hình ảnh dễ hiểu',
        'guided_experiments' => 'Thí nghiệm có hướng dẫn',
    ],
    'cta' => [
        'start_learning' => 'Bắt đầu học',
        'try_cnn_mnist' => 'Thử CNN MNIST',
    ],
    
    // How to Use Section
    'howToUse' => [
        'title' => 'Cách sử dụng nền tảng này',
        'subtitle' => 'Một lộ trình ngắn từ tò mò đến trực giác vững chắc.',
        'steps' => [
            [
                'number' => '1',
                'label' => 'Bước',
                'title' => 'Chọn một lab',
                'description' => 'Chọn một lab và đọc phần giới thiệu khái niệm ở phía trên. Nó cho bạn biết mô hình đang cố học gì.',
            ],
            [
                'number' => '2',
                'label' => 'Bước',
                'title' => 'Tạo dữ liệu',
                'description' => 'Tạo dữ liệu bằng cách nhấp chuột, tải demo hoặc dùng ảnh mẫu. Hình dạng dữ liệu quyết định mọi thứ.',
            ],
            [
                'number' => '3',
                'label' => 'Bước',
                'title' => 'Huấn luyện và quan sát',
                'description' => 'Huấn luyện theo bước hoặc tự chạy, rồi quan sát đường cong loss và hành vi mô hình thay đổi.',
            ],
            [
                'number' => '4',
                'label' => 'Bước',
                'title' => 'So sánh và phản chiếu',
                'description' => 'So sánh và phản chiếu bằng cách thay đổi siêu tham số hoặc loại mô hình để thấy bias, variance và overfitting.',
            ],
        ],
    ],
    
    // Learning Tracks Section
    'learningTracks' => [
        'title' => 'Các lộ trình học cốt lõi',
        'machinelearning' => [
            'title' => 'Machine Learning',
            'description' => 'Bắt đầu ở đây để hiểu cách mô hình học từ dữ liệu. Bạn sẽ thấy một đường cong đơn giản uốn theo điểm, cách bộ phân loại vẽ ranh giới và vì sao dung lượng mô hình quan trọng. Lộ trình này giúp xây dựng trực giác về hàm loss, gradient và hình học dữ liệu.',
            'question' => 'Dùng để trả lời: Vì sao mô hình bị underfit hoặc overfit? Phân phối dữ liệu định hình lại ranh giới quyết định như thế nào?',
            'labs' => [
                'Hồi quy tuyến tính',
                'Hồi quy logistic',
                'Cây quyết định',
                'K-Means',
                'K-NN',
                'SVM',
            ],
        ],
        'deeplearning' => [
            'title' => 'Deep Learning',
            'description' => 'Lộ trình này mở rộng trực giác từ đường cong sang mạng. Hãy quan sát neuron biến đổi đầu vào thành biểu diễn, rồi xem bộ lọc tích chập trích xuất đặc trưng thị giác. Trọng tâm là cách độ sâu và phi tuyến thay đổi khả năng biểu diễn của mô hình.',
            'question' => 'Dùng để trả lời: CNN học cạnh như thế nào? Vì sao mô hình neural overfit trong khi loss vẫn giảm?',
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
            'description' => 'Ở đây mô hình là một tác nhân học từ phần thưởng thay vì ví dụ có nhãn. Bạn sẽ khám phá khám phá vs khai thác, phần thưởng thưa và vai trò của động lực môi trường.',
            'question' => 'Dùng để trả lời: Khi nào nên khám phá? Cấu trúc phần thưởng định hình hành vi ra sao?',
            'labs' => [
                'N-Slot Bandit',
                'Grid World',
            ],
        ],
    ],
    'quickStart' => [
        'title' => 'Gợi ý khởi đầu nhanh',
        'items' => [
            [
                'label' => 'Mới học ML?',
                'text' => 'Bắt đầu với Hồi quy tuyến tính và Hồi quy logistic, rồi so sánh với Cây quyết định.',
            ],
            [
                'label' => 'Quan tâm đến đường cong?',
                'text' => 'Dùng NN Regression để xem độ sâu và độ rộng thay đổi độ khớp.',
            ],
            [
                'label' => 'Muốn trực giác thị giác?',
                'text' => 'Vào CNN MNIST và vẽ chữ số để kiểm tra suy luận.',
            ],
        ],
        'cta' => [
            'start_linear' => 'Bắt đầu với Hồi quy tuyến tính',
            'explore_nn' => 'Khám phá NN Regression',
        ],
    ],
];
