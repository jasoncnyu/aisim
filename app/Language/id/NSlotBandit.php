<?php

return [
    'title' => 'Lab N-Slot Bandit',
    'subtitle' => 'Bandingkan strategi eksplorasi-eksploitasi pada bandit multi-lengan stokastik.',
    'accordion' => [
        '1' => [
            'title' => '1) Pengaturan Masalah',
            'p1' => 'Setiap lengan memiliki probabilitas reward Bernoulli yang tidak diketahui. Di setiap langkah agen memilih satu lengan dan melihat reward 0 atau 1.',
        ],
        '2' => [
            'title' => '2) Algoritma yang Dibandingkan',
            'li1_label' => 'Epsilon-Greedy',
            'li1' => 'eksplorasi acak dengan probabilitas epsilon.',
            'li2_label' => 'UCB1',
            'li2' => 'bonus optimisme untuk lengan yang tidak pasti.',
            'li3_label' => 'Thompson Sampling',
            'li3' => 'sampling posterior Bayes melalui distribusi Beta.',
        ],
    ],
    'controls' => [
        'algorithm' => 'Algoritma',
        'eps_greedy' => 'Epsilon-Greedy',
        'ucb1' => 'UCB1',
        'thompson' => 'Thompson Sampling',
        'arms' => 'Lengan (N)',
        'steps' => 'Langkah',
        'runs' => 'Jalankan',
        'epsilon' => 'Epsilon',
        'seed' => 'Seed',
        'optional' => 'opsional',
        'randomize' => 'Acak Probabilitas',
        'apply' => 'Terapkan',
        'run' => 'Jalankan',
        'step' => 'Langkah',
        'stop' => 'Hentikan',
        'reset' => 'Reset',
        'export_csv' => 'Ekspor CSV',
    ],
    'charts' => [
        'avg_reward' => 'Reward rata-rata',
        'cum_regret' => 'Regret kumulatif',
    ],
    'arms' => [
        'title' => 'Lengan (Probabilitas Asli)',
        'subtitle' => 'Edit manual atau acak, lalu klik Terapkan.',
    ],
    'run_info' => [
        'title' => 'Info Jalankan',
        'current_run' => 'Run saat ini:',
        'step' => 'Langkah:',
        'avg_reward' => 'Reward rata-rata:',
        'cum_regret' => 'Regret kumulatif:',
    ],
];
