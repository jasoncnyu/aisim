<?php

return [
    'title' => 'Phòng lab mạng neural XOR',
    'subtitle' => 'Trực quan hóa forward/backward cho MLP nhỏ.',
    'accordion' => [
        '1' => [
            'title' => '1) Vì sao XOR là demo kinh điển',
            'p1' => 'XOR không thể giải bằng một đường phân tách tuyến tính. Mô hình phải học bề mặt quyết định phi tuyến.',
            'p2' => 'Vì vậy XOR là bài toán đồ chơi chuẩn để minh họa lớp ẩn và kích hoạt phi tuyến.',
        ],
        '2' => [
            'title' => '2) Cấu trúc mạng sử dụng',
            'p1' => 'Mô phỏng dùng MLP gọn:',
            'structure' => 'Input(2) -> Hidden(4) -> Hidden(2) -> Output(1)',
            'p2' => 'Kích hoạt đầu ra là sigmoid cho xác suất nhị phân. Kích hoạt ẩn có thể là tanh hoặc ReLU.',
        ],
        '3' => [
            'title' => '3) Động lực huấn luyện',
            'p1' => 'Mỗi bước lấy một trường hợp XOR, chạy forward, tính loss rồi cập nhật backprop.',
            'equation1' => '$$ z^{(l)} = a^{(l-1)}W^{(l)} + b^{(l)}, \\quad a^{(l)} = f(z^{(l)}) $$',
            'equation2' => '$$ W \\leftarrow W - \\eta \\nabla_W L, \\quad b \\leftarrow b - \\eta \\nabla_b L $$',
        ],
        '4' => [
            'title' => '4) Cách đọc trực quan',
            'li1' => 'Biểu đồ loss cho thấy xu hướng hội tụ theo bước huấn luyện.',
            'li2' => 'Bảng dự đoán hiển thị độ tin cậy cho bốn đầu vào XOR.',
            'li3' => 'Bảng tính toán ghi lại các giá trị forward/backward mới nhất để kiểm tra.',
        ],
    ],
    'controls' => [
        'title' => 'Điều khiển huấn luyện',
        'learning_rate' => 'Learning Rate',
        'sleep' => 'Tạm dừng (ms)',
        'activation' => 'Kích hoạt',
        'step' => '+1 bước',
        'auto_train' => 'Tự động huấn luyện',
        'reset' => 'Đặt lại',
        'step_label' => 'Bước:',
        'loss_label' => 'Loss:',
    ],
    'trace_title' => 'Theo dõi forward/backward',
    'prediction_title' => 'Ảnh chụp dự đoán',
    'prediction_hint' => 'Vòng tròn lớn hơn nghĩa là xác suất đầu ra gần lớp 1 cao hơn.',
    'targets_title' => 'Mục tiêu XOR',
    'targets' => [
        'li1' => '(0,0) -> 0',
        'li2' => '(0,1) -> 1',
        'li3' => '(1,0) -> 1',
        'li4' => '(1,1) -> 0',
    ],
];
