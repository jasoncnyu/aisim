<?php

return [
    'pageTitle' => 'होम',
    'tagline' => 'AI Simulator',
    'title' => 'AI सीखने के लिए एक विज़ुअल लैब',
    'description' => 'AI Simulator अमूर्त गणित को इंटरैक्टिव प्रयोगों में बदलता है। रियल टाइम में मॉडल ट्रेन करें, लॉस कर्व्स देखें, और पैरामीटर बदलने पर निर्णय कैसे बदलते हैं यह समझें।',
    'labels' => [
        'interactive_labs' => 'इंटरैक्टिव लैब्स',
        'live_training' => 'लाइव ट्रेनिंग',
        'explainable_visuals' => 'Explainable विज़ुअल्स',
        'guided_experiments' => 'Guided एक्सपेरिमेंट्स',
    ],
    'cta' => [
        'start_learning' => 'सीखना शुरू करें',
        'try_cnn_mnist' => 'CNN MNIST आज़माएं',
    ],
    
    // How to Use Section
    'howToUse' => [
        'title' => 'इस प्लेटफॉर्म का उपयोग कैसे करें',
        'subtitle' => 'जिज्ञासा से आत्मविश्वासी समझ तक एक छोटा रास्ता।',
        'steps' => [
            [
                'number' => '1',
                'label' => 'स्टेप',
                'title' => 'लैब चुनें',
                'description' => 'एक लैब चुनें और ऊपर दिया गया कॉन्सेप्ट प्राइमर पढ़ें। यह बताता है कि मॉडल क्या सीखना चाहता है।',
            ],
            [
                'number' => '2',
                'label' => 'स्टेप',
                'title' => 'डेटा बनाएं',
                'description' => 'क्लिक करके, डेमो लोड करके, या सैंपल इमेज से डेटा बनाएं। डेटा का आकार सब कुछ तय करता है।',
            ],
            [
                'number' => '3',
                'label' => 'स्टेप',
                'title' => 'ट्रेन करें और देखें',
                'description' => 'Step या Auto-run से ट्रेन करें, फिर लॉस कर्व और मॉडल बिहेवियर का बदलाव देखें।',
            ],
            [
                'number' => '4',
                'label' => 'स्टेप',
                'title' => 'तुलना करें और सोचें',
                'description' => 'हाइपरपैरामीटर या मॉडल टाइप बदलकर बायस, वैरिएंस और ओवरफिटिंग देखें।',
            ],
        ],
    ],
    
    // Learning Tracks Section
    'learningTracks' => [
        'title' => 'Core Learning Tracks',
        'machinelearning' => [
            'title' => 'Machine Learning',
            'description' => 'यहां से शुरू करें कि मॉडल डेटा से कैसे सीखते हैं। आप देखेंगे कि सरल कर्व पॉइंट्स पर कैसे फिट होता है, क्लासिफायर्स बॉर्डर्स कैसे खींचते हैं, और मॉडल क्षमता क्यों मायने रखती है। यह ट्रैक loss, gradients और डेटा geometry की समझ बनाता है।',
            'question' => 'इससे उत्तर दें: मॉडल underfit या overfit क्यों करता है? डेटा वितरण decision boundary को कैसे बदलता है?',
            'labs' => [
                'Linear Regression',
                'Logistic Regression',
                'Decision Tree',
                'K-Means',
                'K-NN',
                'SVM',
            ],
        ],
        'deeplearning' => [
            'title' => 'Deep Learning',
            'description' => 'यह ट्रैक कर्व्स से नेटवर्क्स तक समझ बढ़ाता है। देखें कि न्यूरॉन्स inputs को representations में बदलते हैं और convolutional filters विज़ुअल फीचर्स कैसे निकालते हैं। फोकस है कि depth और nonlinearity मॉडल की अभिव्यक्ति क्षमता कैसे बदलते हैं।',
            'question' => 'इससे उत्तर दें: CNN किनारों को कैसे सीखती है? लॉस घटते हुए भी न्यूरल मॉडल overfit क्यों करता है?',
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
            'description' => 'यहां मॉडल एक एजेंट है जो लेबल्ड उदाहरणों के बजाय रिवार्ड्स से सीखता है। आप exploration बनाम exploitation, sparse rewards और environment dynamics की भूमिका समझेंगे।',
            'question' => 'इससे उत्तर दें: कब explore करना बेहतर है? reward संरचना व्यवहार को कैसे आकार देती है?',
            'labs' => [
                'N-Slot Bandit',
                'Grid World',
            ],
        ],
    ],
    'quickStart' => [
        'title' => 'Quick Start Prompts',
        'items' => [
            [
                'label' => 'ML में नए?',
                'text' => 'Linear Regression और Logistic Regression से शुरू करें, फिर Decision Tree से तुलना करें।',
            ],
            [
                'label' => 'कर्व्स में दिलचस्पी?',
                'text' => 'NN Regression से देखें कि depth और width fit को कैसे बदलते हैं।',
            ],
            [
                'label' => 'विज़ुअल समझ चाहिए?',
                'text' => 'CNN MNIST पर जाएं और अंक बनाकर inference टेस्ट करें।',
            ],
        ],
        'cta' => [
            'start_linear' => 'Linear Regression से शुरू करें',
            'explore_nn' => 'NN Regression एक्सप्लोर करें',
        ],
    ],
];
