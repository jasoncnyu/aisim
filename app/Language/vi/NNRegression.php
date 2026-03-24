<?php

return [
    'title' => 'Phòng lab hồi quy neural phi tuyến',
    'subtitle' => 'Khớp các đường cong phi tuyến bằng perceptron nhiều lớp, rồi quan sát phân kỳ train/validation khi overtraining.',
    'accordion' => [
        '1' => [
            'title' => '1) Mô hình hóa',
            'p1' => 'Khác với hồi quy tuyến tính y=ax+b, lab này dùng các lớp ẩn để học ánh xạ phi tuyến x → y.',
            'equation' => '$$\\hat{y}=W_L\\,\\phi(W_{L-1}\\phi(\\cdots\\phi(W_1x+b_1)\\cdots)+b_{L-1})+b_L$$',
            'p2' => 'Chọn độ sâu, độ rộng và hàm kích hoạt để kiểm soát dung lượng mô hình.',
        ],
        '2' => [
            'title' => '2) Loss và tín hiệu overfitting',
            'p1' => 'Mục tiêu là sai số bình phương trung bình trên tập huấn luyện:',
            'equation' => '$$\\text{MSE}=\\frac{1}{n}\\sum_{i=1}^{n}(y_i-\\hat{y}_i)^2$$',
            'p2' => 'Overfitting xuất hiện khi loss train giảm nhưng loss validation đứng yên hoặc tăng.',
        ],
    ],
    'controls' => [
        'add_point' => 'Thêm điểm',
        'test_mode' => 'Chế độ kiểm tra',
        'clear' => 'Xóa',
        'demo' => [
            'sine' => 'Đường sine',
            'cubic' => 'Đường bậc ba',
            'piecewise' => 'Đường ghép đoạn',
        ],
        'load_demo' => 'Tải demo',
        'hint' => 'Nhấp để thêm mẫu. Trong Test Mode, nhấp vào vị trí x để xem y dự đoán và sai lệch.',
    ],
    'params' => [
        'hidden_layers' => 'Số lớp ẩn',
        'units_per_layer' => 'Số nút / lớp',
        'activation' => 'Kích hoạt',
        'val_ratio' => 'Tỷ lệ validation',
        'lr' => 'LR',
        'batch' => 'Batch',
        'epochs' => 'Epochs',
        'l2_reg' => 'L2 Reg',
        'init_model' => 'Khởi tạo mô hình',
    ],
    'actions' => [
        'step' => 'Bước',
        'run' => 'Chạy',
        'stop' => 'Dừng',
    ],
    'status' => [
        'title' => 'Trạng thái huấn luyện',
        'points' => 'Số điểm:',
        'train_val' => 'Train / Val:',
        'epoch' => 'Epoch:',
        'train_loss' => 'Loss train:',
        'val_loss' => 'Loss val:',
    ],
    'interpretation' => [
        'title' => 'Diễn giải',
        'li1' => 'Điểm xanh: tập train, điểm cam: tập validation.',
        'li2' => 'Dấu vàng trong Test Mode: đầu ra dự đoán tại x đã nhấp.',
        'li3' => 'Nếu loss train giảm nhưng loss val tăng, dung lượng quá lớn hoặc huấn luyện quá lâu.',
        'li4' => 'Thử L2 mạnh hơn hoặc giảm số lớp ẩn để giảm overfitting.',
    ],
];
