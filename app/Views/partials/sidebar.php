<aside
    class="fixed inset-y-0 left-0 z-40 w-72 bg-white border-r border-slate-200 shadow-xl transform transition-transform duration-300 lg:static lg:translate-x-0 lg:shadow-none"
    :class="open ? 'translate-x-0' : '-translate-x-full'"
>
    <div class="h-16 px-5 flex items-center justify-between border-b border-slate-200">
        <div class="flex items-center gap-2">
            <img src="/assets/brand/logo.svg" alt="AI Simulator" class="h-8 w-8 rounded-lg">
            <p class="font-semibold">AI Simulator</p>
        </div>
        <button class="lg:hidden p-2 rounded-md hover:bg-slate-100" @click="open = false" aria-label="Close menu">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>

    <nav class="p-4 space-y-4 overflow-y-auto h-[calc(100vh-4rem)]">
        <a href="/" class="flex items-center gap-3 rounded-xl px-3 py-2.5 <?= ($activeMenu ?? '') === 'dashboard' ? 'bg-slate-900 text-white' : 'hover:bg-slate-100' ?>">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 10.5l9-7 9 7M5.25 9.75V20.25h13.5V9.75"/></svg>
            <span>Home</span>
        </a>

        <div>
            <p class="px-3 text-xs font-semibold uppercase tracking-wide text-slate-500">Machine Learning</p>
            <div class="mt-1 space-y-1">
                <a href="/linear-regression" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm <?= ($activeMenu ?? '') === 'linear_regression' ? 'bg-slate-900 text-white' : 'hover:bg-slate-100' ?>">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 18l6-6 4 4 6-8"/></svg>
                    <span>Linear Regression</span>
                </a>
                <a href="/logistic-regression" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm <?= ($activeMenu ?? '') === 'logistic_regression' ? 'bg-slate-900 text-white' : 'hover:bg-slate-100' ?>">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 12c3 0 3-8 8-8s5 16 8 16"/></svg>
                    <span>Logistic Regression</span>
                </a>
                <a href="/decision-tree" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm <?= ($activeMenu ?? '') === 'decision_tree' ? 'bg-slate-900 text-white' : 'hover:bg-slate-100' ?>">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 3v6m0 0h6m-6 0L3 6m15 6v6m0 0h-6m6 0l3-3M9 18h6"/></svg>
                    <span>Decision Tree</span>
                </a>
                <a href="/k-means" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm <?= ($activeMenu ?? '') === 'k_means' ? 'bg-slate-900 text-white' : 'hover:bg-slate-100' ?>">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><circle cx="7" cy="8" r="2.2" stroke-width="1.8"/><circle cx="17" cy="7" r="2.2" stroke-width="1.8"/><circle cx="12" cy="16" r="2.2" stroke-width="1.8"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8.8 9.3l1.9 4.3m2.4-4.8l2.2 5"/></svg>
                    <span>K-Means</span>
                </a>
                <a href="/knn" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm <?= ($activeMenu ?? '') === 'knn' ? 'bg-slate-900 text-white' : 'hover:bg-slate-100' ?>">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><circle cx="8" cy="8" r="2.1" stroke-width="1.8"/><circle cx="16" cy="7" r="2.1" stroke-width="1.8"/><circle cx="13" cy="15" r="2.1" stroke-width="1.8"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M11.2 9.6l2.2 3.2m-4.9-.9l-2.5 2.5"/></svg>
                    <span>K-NN</span>
                </a>
                <a href="/svm" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm <?= ($activeMenu ?? '') === 'svm' ? 'bg-slate-900 text-white' : 'hover:bg-slate-100' ?>">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 14l4-4 4 4 8-8"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 20h16"/></svg>
                    <span>SVM</span>
                </a>
            </div>
        </div>

        <div>
            <p class="px-3 text-xs font-semibold uppercase tracking-wide text-slate-500">Deep Learning</p>
            <div class="mt-1 space-y-1">
                <a href="/cnn-binary" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm <?= ($activeMenu ?? '') === 'cnn_binary' ? 'bg-slate-900 text-white' : 'hover:bg-slate-100' ?>">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><rect x="4" y="4" width="6" height="6" rx="1" stroke-width="1.8"/><rect x="14" y="4" width="6" height="6" rx="1" stroke-width="1.8"/><rect x="9" y="14" width="6" height="6" rx="1" stroke-width="1.8"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10 7h4M12 10v4"/></svg>
                    <span>CNN Binary</span>
                </a>
                <a href="/cnn-mnist" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm <?= ($activeMenu ?? '') === 'cnn_mnist' ? 'bg-slate-900 text-white' : 'hover:bg-slate-100' ?>">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M5 4h14v16H5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 8h6M9 12h6M9 16h4"/></svg>
                    <span>CNN MNIST</span>
                </a>
                <a href="/nn-regression" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm <?= ($activeMenu ?? '') === 'nn_regression' ? 'bg-slate-900 text-white' : 'hover:bg-slate-100' ?>">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 18c3-8 6-8 9 0s6 8 7-2"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 20h16"/></svg>
                    <span>NN Regression</span>
                </a>
                <a href="/xor" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm <?= ($activeMenu ?? '') === 'xor_lab' ? 'bg-slate-900 text-white' : 'hover:bg-slate-100' ?>">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 7l10 10M17 7L7 17"/></svg>
                    <span>XOR Lab</span>
                </a>
                <a href="/web-llm" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm <?= ($activeMenu ?? '') === 'web_llm' ? 'bg-slate-900 text-white' : 'hover:bg-slate-100' ?>">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6h16M4 12h10M4 18h13"/></svg>
                    <span>Tiny Web LLM</span>
                </a>
            </div>
        </div>

        <div>
            <p class="px-3 text-xs font-semibold uppercase tracking-wide text-slate-500">Efficiency</p>
            <div class="mt-1 space-y-1">
                <a href="/quantization" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm <?= ($activeMenu ?? '') === 'quantization' ? 'bg-slate-900 text-white' : 'hover:bg-slate-100' ?>">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6h16M4 12h8M4 18h12"/><circle cx="18" cy="6" r="2" stroke-width="1.8"/><circle cx="14" cy="12" r="2" stroke-width="1.8"/><circle cx="16" cy="18" r="2" stroke-width="1.8"/></svg>
                    <span>Quantization</span>
                </a>
                <a href="/pruning" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm <?= ($activeMenu ?? '') === 'pruning' ? 'bg-slate-900 text-white' : 'hover:bg-slate-100' ?>">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 4h10v4H7z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M5 12h14"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 20h6"/></svg>
                    <span>Pruning</span>
                </a>
                <a href="/sparse-matrix" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm <?= ($activeMenu ?? '') === 'sparse_matrix' ? 'bg-slate-900 text-white' : 'hover:bg-slate-100' ?>">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 4h16v16H4z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 4v16M15 4v16M4 9h16M4 15h16"/></svg>
                    <span>Sparse Matrix</span>
                </a>
            </div>
        </div>

        <div>
            <p class="px-3 text-xs font-semibold uppercase tracking-wide text-slate-500">Reinforcement Learning</p>
            <div class="mt-1 space-y-1">
                <a href="/n-slot" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm <?= ($activeMenu ?? '') === 'n_slot_bandit' ? 'bg-slate-900 text-white' : 'hover:bg-slate-100' ?>">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 6h4v4H6zM14 6h4v4h-4zM6 14h4v4H6zM14 14h4v4h-4z"/></svg>
                    <span>N-Slot Bandit</span>
                </a>
                <a href="/grid-world" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm <?= ($activeMenu ?? '') === 'grid_world' ? 'bg-slate-900 text-white' : 'hover:bg-slate-100' ?>">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 4h16v16H4zM9 4v16M15 4v16M4 9h16M4 15h16"/></svg>
                    <span>Grid World</span>
                </a>
            </div>
        </div>
    </nav>
</aside>
