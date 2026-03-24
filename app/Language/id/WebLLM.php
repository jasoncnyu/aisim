<?php

return [
    'title' => 'Tiny Web LLM Lab',
    'subtitle' => 'Latih model next-token kecil di browser dan hasilkan teks.',
    'accordion' => [
        '1' => [
            'title' => '1) Apa yang Dipelajari Simulator Ini',
            'p1' => 'Halaman ini menunjukkan mekanik inti pemodelan bahasa: tokenisasi, jendela konteks, logits, softmax, dan update berbasis gradien.',
            'p2' => 'Sengaja dibuat kecil dan edukatif. Kamu bisa melihat loss dan membandingkan Greedy, Sampling, dan Top-k.',
        ],
        '2' => [
            'title' => '2) Desain Model',
            'p1' => 'Token adalah kata yang dipisahkan spasi. Model merata-ratakan embedding dalam konteks lalu memproyeksikannya ke logits vocab.',
            'equation' => '$$ h = \\frac{1}{K}\\sum E(t_i),\\quad z = W^Th + b,\\quad p = softmax(z) $$',
            'p2' => 'Training menggunakan cross-entropy per token dengan update SGD sederhana.',
        ],
    ],
    'train' => [
        'title' => '1) Korpus Training',
        'load_demo' => 'Muat demo:',
    ],
    'hyper' => [
        'title' => '2) Hyperparameter',
        'embed' => 'Ukuran embedding',
        'context' => 'Panjang konteks',
        'epochs' => 'Epoch',
        'lr' => 'Learning Rate',
        'train_embeddings' => 'Latih embeddings',
    ],
    'run' => [
        'title' => '3) Jalankan Training',
        'start' => 'Mulai training',
        'stop' => 'Hentikan',
    ],
    'generate' => [
        'title' => '4) Generasi Teks',
        'prompt' => 'Prompt',
        'tokens' => 'Tokens',
        'temperature' => 'Temperature',
        'greedy' => 'Greedy',
        'sampling' => 'Sampling',
        'topk' => 'Top-k',
        'generate' => 'Generate',
    ],
];
