<?php

return [
    'title' => 'Phòng lab CNN nhị phân',
    'subtitle' => 'CNN nhỏ cho phân loại ảnh hai lớp, có trực quan hóa bộ lọc và feature map.',
    'accordion' => [
        '1' => [
            'title' => '1) Kiến trúc mô hình',
            'p1' => 'Trang này huấn luyện CNN gọn: Conv(3x3) -> ReLU -> Flatten -> Dense -> ReLU -> Dense -> Softmax.',
            'p2' => 'Ảnh đầu vào được chuyển sang thang xám và resize 32x32, nên mỗi mẫu là vector 1024 chiều trước khi qua convolution.',
            'p3' => 'Nhãn nhị phân được ánh xạ thành xác suất lớp: P(lớp 1) và P(lớp 2).',
        ],
        '2' => [
            'title' => '2) Mục tiêu học',
            'p1' => 'Mạng được tối ưu bằng cross-entropy cho hai lớp:',
            'equation' => '$$ L = -\\frac{1}{N}\\sum_{i=1}^{N}\\sum_{c=1}^{2} y_{ic}\\log(\\hat{y}_{ic}) $$',
            'p2' => 'Dùng learning rate thấp để hội tụ ổn định, hoặc cao để cập nhật nhanh nhưng nhiễu hơn.',
        ],
        '3' => [
            'title' => '3) Quy trình gợi ý',
            'step1' => 'Tải ảnh demo mèo/chó hoặc tải file của bạn vào từng lớp.',
            'step2' => 'Khởi tạo trọng số, chạy vài epoch và theo dõi loss/accuracy.',
            'step3' => 'Xem giá trị bộ lọc và feature map để hiểu lớp conv đầu tiên học gì.',
            'step4' => 'Tải ảnh kiểm tra và xem xác suất lớp.',
        ],
    ],
    'controls' => [
        'load_demo' => 'Tải dữ liệu demo',
        'init_weights' => 'Khởi tạo trọng số',
        'step' => 'Bước (1 epoch)',
        'run' => 'Chạy',
        'stop' => 'Dừng',
        'reset' => 'Đặt lại',
        'lr' => 'LR:',
        'epochs' => 'Epochs:',
        'batch' => 'Batch:',
    ],
    'metrics' => [
        'dataset' => 'Dataset:',
        'epoch' => 'Epoch:',
        'loss' => 'Loss:',
        'accuracy' => 'Accuracy:',
    ],
    'training_images_title' => 'Ảnh huấn luyện',
    'class1_label' => 'Lớp 1 (nhãn 0)',
    'class2_label' => 'Lớp 2 (nhãn 1)',
    'upload_hint' => 'Ảnh tải lên sẽ được resize 32x32 thang xám trước khi huấn luyện.',
    'loading_images' => 'Đang tải ảnh...',
    'conv_filters_title' => 'Bộ lọc conv (realtime)',
    'prediction_title' => 'Dự đoán',
    'predict_button' => 'Dự đoán ảnh đã tải',
    'feature_maps_title' => 'Feature map (lớp conv)',
];
