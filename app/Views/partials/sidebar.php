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
            <i class="fa-solid fa-xmark fa-lg"></i>
        </button>
    </div>

    <nav class="p-4 space-y-4 overflow-y-auto h-[calc(100vh-4rem)]">
        <a href="/" class="flex items-center gap-3 rounded-xl px-3 py-2.5 <?= ($activeMenu ?? '') === 'dashboard' ? 'bg-slate-900 text-white' : 'hover:bg-slate-100' ?>">
            <i class="fa-solid fa-house fa-fw"></i>
            <span>Home</span>
        </a>

        <div>
            <p class="px-3 text-xs font-semibold uppercase tracking-wide text-slate-500">Machine Learning</p>
            <div class="mt-1 space-y-1">
                <a href="/linear-regression" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm <?= ($activeMenu ?? '') === 'linear_regression' ? 'bg-slate-900 text-white' : 'hover:bg-slate-100' ?>">
                    <i class="fa-solid fa-chart-line fa-fw"></i>
                    <span>Linear Regression</span>
                </a>
                <a href="/logistic-regression" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm <?= ($activeMenu ?? '') === 'logistic_regression' ? 'bg-slate-900 text-white' : 'hover:bg-slate-100' ?>">
                    <i class="fa-solid fa-wave-square fa-fw"></i>
                    <span>Logistic Regression</span>
                </a>
                <a href="/decision-tree" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm <?= ($activeMenu ?? '') === 'decision_tree' ? 'bg-slate-900 text-white' : 'hover:bg-slate-100' ?>">
                    <i class="fa-solid fa-sitemap fa-fw"></i>
                    <span>Decision Tree</span>
                </a>
                <a href="/k-means" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm <?= ($activeMenu ?? '') === 'k_means' ? 'bg-slate-900 text-white' : 'hover:bg-slate-100' ?>">
                    <i class="fa-solid fa-braille fa-fw"></i>
                    <span>K-Means</span>
                </a>
                <a href="/knn" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm <?= ($activeMenu ?? '') === 'knn' ? 'bg-slate-900 text-white' : 'hover:bg-slate-100' ?>">
                    <i class="fa-solid fa-people-group fa-fw"></i>
                    <span>K-NN</span>
                </a>
                <a href="/svm" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm <?= ($activeMenu ?? '') === 'svm' ? 'bg-slate-900 text-white' : 'hover:bg-slate-100' ?>">
                    <i class="fa-solid fa-vector-square fa-fw"></i>
                    <span>SVM</span>
                </a>
            </div>
        </div>

        <div>
            <p class="px-3 text-xs font-semibold uppercase tracking-wide text-slate-500">Deep Learning</p>
            <div class="mt-1 space-y-1">
                <a href="/cnn-binary" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm <?= ($activeMenu ?? '') === 'cnn_binary' ? 'bg-slate-900 text-white' : 'hover:bg-slate-100' ?>">
                    <i class="fa-solid fa-border-all fa-fw"></i>
                    <span>CNN Binary</span>
                </a>
                <a href="/cnn-mnist" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm <?= ($activeMenu ?? '') === 'cnn_mnist' ? 'bg-slate-900 text-white' : 'hover:bg-slate-100' ?>">
                    <i class="fa-solid fa-table-cells-large fa-fw"></i>
                    <span>CNN MNIST</span>
                </a>
                <a href="/nn-regression" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm <?= ($activeMenu ?? '') === 'nn_regression' ? 'bg-slate-900 text-white' : 'hover:bg-slate-100' ?>">
                    <i class="fa-solid fa-diagram-project fa-fw"></i>
                    <span>NN Regression</span>
                </a>
                <a href="/xor" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm <?= ($activeMenu ?? '') === 'xor_lab' ? 'bg-slate-900 text-white' : 'hover:bg-slate-100' ?>">
                    <i class="fa-solid fa-xmark fa-fw"></i>
                    <span>XOR Lab</span>
                </a>
                <a href="/web-llm" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm <?= ($activeMenu ?? '') === 'web_llm' ? 'bg-slate-900 text-white' : 'hover:bg-slate-100' ?>">
                    <i class="fa-solid fa-language fa-fw"></i>
                    <span>Tiny Web LLM</span>
                </a>
            </div>
        </div>

        <div>
            <p class="px-3 text-xs font-semibold uppercase tracking-wide text-slate-500">Efficiency</p>
            <div class="mt-1 space-y-1">
                <a href="/quantization" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm <?= ($activeMenu ?? '') === 'quantization' ? 'bg-slate-900 text-white' : 'hover:bg-slate-100' ?>">
                    <i class="fa-solid fa-sliders fa-fw"></i>
                    <span>Quantization</span>
                </a>
                <a href="/pruning" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm <?= ($activeMenu ?? '') === 'pruning' ? 'bg-slate-900 text-white' : 'hover:bg-slate-100' ?>">
                    <i class="fa-solid fa-scissors fa-fw"></i>
                    <span>Pruning</span>
                </a>
                <a href="/sparse-matrix" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm <?= ($activeMenu ?? '') === 'sparse_matrix' ? 'bg-slate-900 text-white' : 'hover:bg-slate-100' ?>">
                    <i class="fa-solid fa-border-none fa-fw"></i>
                    <span>Sparse Matrix</span>
                </a>
            </div>
        </div>

        <div>
            <p class="px-3 text-xs font-semibold uppercase tracking-wide text-slate-500">Reinforcement Learning</p>
            <div class="mt-1 space-y-1">
                <a href="/n-slot" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm <?= ($activeMenu ?? '') === 'n_slot_bandit' ? 'bg-slate-900 text-white' : 'hover:bg-slate-100' ?>">
                    <i class="fa-solid fa-dice fa-fw"></i>
                    <span>N-Slot Bandit</span>
                </a>
                <a href="/grid-world" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm <?= ($activeMenu ?? '') === 'grid_world' ? 'bg-slate-900 text-white' : 'hover:bg-slate-100' ?>">
                    <i class="fa-solid fa-chess-board fa-fw"></i>
                    <span>Grid World</span>
                </a>
            </div>
        </div>
    </nav>
</aside>
