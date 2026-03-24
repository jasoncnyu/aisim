<?php

return [
    'title' => 'Laboratorio Tiny Web LLM',
    'subtitle' => 'Allena un piccolo modello next-token direttamente nel browser e genera testo.',
    'accordion' => [
        '1' => [
            'title' => '1) Cosa insegna questo simulatore',
            'p1' => 'Questa pagina mostra la meccanica base del language modeling: tokenizzazione, finestre di contesto, logits, softmax e aggiornamenti via gradiente.',
            'p2' => 'E volutamente piccolo ed educativo. Puoi ispezionare la loss di training e confrontare strategie di decoding come Greedy, Sampling e Top-k.',
        ],
        '2' => [
            'title' => '2) Design del modello',
            'p1' => 'I token sono parole separate da spazi. Il modello media gli embedding dei token nel contesto corrente e li proietta ai logits del vocabolario.',
            'equation' => '$$ h = \\frac{1}{K}\\sum E(t_i),\\quad z = W^Th + b,\\quad p = softmax(z) $$',
            'p2' => 'Il training usa cross-entropy per token con semplici aggiornamenti SGD.',
        ],
    ],
    'train' => [
        'title' => '1) Corpus di training',
        'load_demo' => 'Carica demo:',
    ],
    'hyper' => [
        'title' => '2) Iperparametri',
        'embed' => 'Dimensione embedding',
        'context' => 'Lunghezza contesto',
        'epochs' => 'Epoche',
        'lr' => 'Learning Rate',
        'train_embeddings' => 'Allena embedding',
    ],
    'run' => [
        'title' => '3) Esecuzione training',
        'start' => 'Avvia training',
        'stop' => 'Stop',
    ],
    'generate' => [
        'title' => '4) Generazione testo',
        'prompt' => 'Prompt',
        'tokens' => 'Token',
        'temperature' => 'Temperature',
        'greedy' => 'Greedy',
        'sampling' => 'Sampling',
        'topk' => 'Top-k',
        'generate' => 'Genera',
    ],
];
