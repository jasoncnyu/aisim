<?php

return [
    'title' => 'Phòng lab Quantization',
    'subtitle' => 'Nén trọng số xuống định dạng ít bit và quan sát đánh đổi độ chính xác.',
    'accordion' => [
        '1' => [
            'title' => '1) Vì sao quantization quan trọng',
            'p1' => 'Mô hình hiện đại rất lớn và tốn bộ nhớ. Quantization giảm mỗi trọng số từ float 32-bit xuống ít bit hơn (thường 8, 4 hoặc 1), giúp thu nhỏ mô hình và tăng tốc suy luận.',
            'p2' => 'Đánh đổi cốt lõi là độ chính xác vs hiệu năng. Nếu hiệu chuẩn tốt, mô hình ít bit vẫn giữ phần lớn hiệu năng trong khi chạy nhanh trên phần cứng phổ thông.',
        ],
        '2' => [
            'title' => '2) Các chế độ quantization',
            'li1_label' => 'Uniform Symmetric',
            'li1' => 'tỉ lệ quanh 0; đơn giản, thân thiện phần cứng.',
            'li2_label' => 'Uniform Asymmetric',
            'li2' => 'dịch khoảng để khớp tốt hơn các phân phối không quanh 0.',
            'li3_label' => 'Dynamic Range (per-row)',
            'li3' => 'mỗi hàng có thang riêng, tăng độ chính xác cho ma trận không đồng nhất.',
            'li4_label' => 'Log / Binary / Ternary',
            'li4' => 'nén mạnh để tối ưu hiệu năng, đổi lại méo lớn hơn.',
        ],
        '3' => [
            'title' => '3) Cách dùng lab này',
            'step1' => 'Tạo ma trận ngẫu nhiên hoặc đặt mật độ.',
            'step2' => 'Chọn chế độ quantization và số bit.',
            'step3' => 'Áp dụng và xem MSE, PSNR cùng heatmap lỗi.',
        ],
    ],
    'generator' => [
        'title' => 'Tạo ma trận',
        'rows' => 'Số hàng',
        'cols' => 'Số cột',
        'density' => 'Mật độ (khác 0 %)',
        'current' => 'Hiện tại:',
        'generate' => 'Tạo',
    ],
    'settings' => [
        'title' => 'Thiết lập quantization',
        'type' => 'Loại quantization',
        'int8_sym' => 'Uniform Symmetric (int8)',
        'uint8_asym' => 'Uniform Asymmetric (uint8)',
        'row_dynamic' => 'Dynamic Range (theo hàng)',
        'log' => 'Log Quantization',
        'binary' => 'Binary (dấu)',
        'ternary' => 'Ternary (-1, 0, +1)',
        'bit_width' => 'Số bit',
        'apply' => 'Áp dụng quantization',
        'reset' => 'Đặt lại',
    ],
    'summary' => [
        'title' => 'Tóm tắt',
        'dimensions' => 'Kích thước:',
        'value_range' => 'Miền giá trị:',
        'quant_range' => 'Miền lượng tử:',
        'mse' => 'MSE:',
        'psnr' => 'PSNR (dB):',
        'avg_error' => 'Sai số TB |Error|:',
        'bitrate' => 'Bitrate:',
        'bits_per_value' => 'bit/giá trị',
        'last_strategy' => 'Chiến lược gần nhất:',
    ],
    'matrix' => [
        'title' => 'Ma trận gốc',
    ],
    'quantized' => [
        'title' => 'Ma trận đã lượng tử (số nguyên)',
    ],
    'dequantized' => [
        'title' => 'Ma trận giải lượng tử (float)',
    ],
    'error' => [
        'title' => 'Heatmap lỗi (đỏ = dương, xanh = âm)',
    ],
    'json' => [
        'title' => 'Xuất JSON',
        'download' => 'Tải xuống',
    ],
];
