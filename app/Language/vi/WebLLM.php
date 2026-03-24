<?php

return [
    'title' => 'Phòng lab Tiny Web LLM',
    'subtitle' => 'Huấn luyện mô hình dự đoán token kế tiếp nhỏ ngay trong trình duyệt và sinh văn bản.',
    'accordion' => [
        '1' => [
            'title' => '1) Trình mô phỏng dạy gì',
            'p1' => 'Trang này minh họa cơ chế cốt lõi của mô hình ngôn ngữ: tokenization, context window, logits, softmax và cập nhật theo gradient.',
            'p2' => 'Cố ý nhỏ gọn để học tập. Bạn có thể xem loss huấn luyện và so sánh chiến lược giải mã như Greedy, Sampling và Top-k.',
        ],
        '2' => [
            'title' => '2) Thiết kế mô hình',
            'p1' => 'Token là các từ tách theo khoảng trắng. Mô hình lấy trung bình embedding trong ngữ cảnh hiện tại và chiếu ra logits của từ vựng.',
            'equation' => '$$ h = \\frac{1}{K}\\sum E(t_i),\\quad z = W^Th + b,\\quad p = softmax(z) $$',
            'p2' => 'Huấn luyện dùng cross-entropy theo token với cập nhật SGD đơn giản.',
        ],
    ],
    'train' => [
        'title' => '1) Tập văn bản huấn luyện',
        'load_demo' => 'Tải demo:',
    ],
    'hyper' => [
        'title' => '2) Siêu tham số',
        'embed' => 'Kích thước embedding',
        'context' => 'Độ dài ngữ cảnh',
        'epochs' => 'Epochs',
        'lr' => 'Learning Rate',
        'train_embeddings' => 'Huấn luyện embedding',
    ],
    'run' => [
        'title' => '3) Chạy huấn luyện',
        'start' => 'Bắt đầu huấn luyện',
        'stop' => 'Dừng',
    ],
    'generate' => [
        'title' => '4) Sinh văn bản',
        'prompt' => 'Prompt',
        'tokens' => 'Tokens',
        'temperature' => 'Temperature',
        'greedy' => 'Greedy',
        'sampling' => 'Sampling',
        'topk' => 'Top-k',
        'generate' => 'Generate',
    ],
];
