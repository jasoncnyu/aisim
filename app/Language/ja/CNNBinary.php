<?php

return [
    'title' => 'CNN 二値分類ラボ',
    'subtitle' => 'フィルタと特徴マップを可視化する2クラス画像分類用の小型CNN。',
    'accordion' => [
        '1' => [
            'title' => '1) モデル構成',
            'p1' => 'このページはコンパクトなCNNを学習します：Conv(3x3) -> ReLU -> Flatten -> Dense -> ReLU -> Dense -> Softmax。',
            'p2' => '画像はグレースケール化し 32x32 にリサイズします。',
            'p3' => '二値ラベルはクラス1/2の確率に変換します。',
        ],
        '2' => [
            'title' => '2) 学習目的',
            'p1' => '2クラスの交差エントロピーで最適化します：',
            'equation' => '$$ L = -\\frac{1}{N}\\sum_{i=1}^{N}\\sum_{c=1}^{2} y_{ic}\\log(\\hat{y}_{ic}) $$',
            'p2' => '低いLRは安定、高いLRは高速だがノイズが増えます。',
        ],
        '3' => [
            'title' => '3) 推奨ワークフロー',
            'step1' => 'デモの猫/犬画像を読み込むか、任意画像をアップロードします。',
            'step2' => '重みを初期化し、数エポック回して損失と精度を確認。',
            'step3' => 'フィルタと特徴マップを確認して最初のConv層の学習内容を理解。',
            'step4' => 'テスト画像をアップロードし確率を確認。',
        ],
    ],
    'controls' => [
        'load_demo' => 'デモデータ読み込み',
        'init_weights' => '重み初期化',
        'step' => 'ステップ(1 Epoch)',
        'run' => '実行',
        'stop' => '停止',
        'reset' => 'リセット',
        'lr' => 'LR:',
        'epochs' => 'Epochs:',
        'batch' => 'Batch:',
    ],
    'metrics' => [
        'dataset' => 'データセット：',
        'epoch' => 'Epoch：',
        'loss' => '損失：',
        'accuracy' => '精度：',
    ],
    'training_images_title' => '学習画像',
    'class1_label' => 'クラス1（ラベル0）',
    'class2_label' => 'クラス2（ラベル1）',
    'upload_hint' => 'アップロード画像は学習前に32x32のグレースケールに変換されます。',
    'loading_images' => '画像を読み込み中...',
    'conv_filters_title' => 'Convフィルタ（リアルタイム）',
    'prediction_title' => '予測',
    'predict_button' => 'アップロード画像を予測',
    'feature_maps_title' => '特徴マップ（Conv層）',
];
