<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-6">
    <section class="relative min-h-[70vh] overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
        <div class="absolute inset-0 bg-gradient-to-br from-slate-950 via-slate-900 to-slate-800"></div>
        <div class="absolute -right-24 -top-20 h-72 w-72 rounded-full bg-amber-400/20 blur-3xl"></div>
        <div class="absolute -left-24 bottom-0 h-72 w-72 rounded-full bg-cyan-400/20 blur-3xl"></div>
        <div class="relative grid gap-6 p-6 lg:grid-cols-[1.2fr_0.8fr]">
            <div class="space-y-4 text-white">
                <p class="text-xs uppercase tracking-[0.3em] text-slate-300">Interactive AI Playground</p>
                <h2 class="text-3xl font-semibold">AI Simulator</h2>
                <p class="text-slate-200">Build intuition for machine learning and deep learning through visual experiments. Train, test, and compare models with live feedback.</p>
                <div class="flex flex-wrap gap-2">
                    <span class="rounded-full bg-white/10 px-3 py-1 text-xs font-semibold text-white">Hands-on Labs</span>
                    <span class="rounded-full bg-white/10 px-3 py-1 text-xs font-semibold text-white">Live Training</span>
                    <span class="rounded-full bg-white/10 px-3 py-1 text-xs font-semibold text-white">Explainable Visuals</span>
                </div>
                <div class="flex flex-wrap gap-2 pt-2">
                    <a href="/linear-regression" class="rounded-lg bg-white px-4 py-2 text-sm font-semibold text-slate-900">Start Learning</a>
                    <a href="/cnn-mnist" class="rounded-lg border border-white/40 px-4 py-2 text-sm text-white">Try CNN MNIST</a>
                </div>
            </div>
            <div class="rounded-2xl border border-white/15 bg-white/10 p-5 text-white backdrop-blur">
                <h3 class="text-lg font-semibold">Launch Message</h3>
                <p class="mt-2 text-sm text-slate-200">Your lab, your pace. Explore classic algorithms and modern neural networks with guided insights and real-time feedback.</p>
                <div class="mt-4 grid grid-cols-2 gap-3 text-sm">
                    <div class="rounded-xl border border-white/15 bg-white/5 p-3">
                        <p class="text-xs uppercase text-slate-300">Labs</p>
                        <p class="mt-1 text-lg font-semibold">14+</p>
                    </div>
                    <div class="rounded-xl border border-white/15 bg-white/5 p-3">
                        <p class="text-xs uppercase text-slate-300">Categories</p>
                        <p class="mt-1 text-lg font-semibold">3 Tracks</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="grid gap-4 lg:grid-cols-3">
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <h3 class="text-lg font-semibold">Machine Learning</h3>
            <p class="mt-1 text-sm text-slate-600">Regression, classification, clustering, and tree-based reasoning.</p>
            <div class="mt-3 flex flex-wrap gap-2">
                <a href="/linear-regression" class="rounded-full border border-slate-300 px-3 py-1 text-xs">Linear Regression</a>
                <a href="/logistic-regression" class="rounded-full border border-slate-300 px-3 py-1 text-xs">Logistic Regression</a>
                <a href="/decision-tree" class="rounded-full border border-slate-300 px-3 py-1 text-xs">Decision Tree</a>
                <a href="/k-means" class="rounded-full border border-slate-300 px-3 py-1 text-xs">K-Means</a>
                <a href="/knn" class="rounded-full border border-slate-300 px-3 py-1 text-xs">K-NN</a>
                <a href="/svm" class="rounded-full border border-slate-300 px-3 py-1 text-xs">SVM</a>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <h3 class="text-lg font-semibold">Deep Learning</h3>
            <p class="mt-1 text-sm text-slate-600">Neural networks, CNNs, and nonlinear function approximation.</p>
            <div class="mt-3 flex flex-wrap gap-2">
                <a href="/nn-regression" class="rounded-full border border-slate-300 px-3 py-1 text-xs">NN Regression</a>
                <a href="/cnn-binary" class="rounded-full border border-slate-300 px-3 py-1 text-xs">CNN Binary</a>
                <a href="/cnn-mnist" class="rounded-full border border-slate-300 px-3 py-1 text-xs">CNN MNIST</a>
                <a href="/xor" class="rounded-full border border-slate-300 px-3 py-1 text-xs">XOR Lab</a>
                <a href="/web-llm" class="rounded-full border border-slate-300 px-3 py-1 text-xs">Tiny Web LLM</a>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <h3 class="text-lg font-semibold">Reinforcement Learning</h3>
            <p class="mt-1 text-sm text-slate-600">Agent decision-making with rewards and exploration.</p>
            <div class="mt-3 flex flex-wrap gap-2">
                <a href="/n-slot" class="rounded-full border border-slate-300 px-3 py-1 text-xs">N-Slot Bandit</a>
                <a href="/grid-world" class="rounded-full border border-slate-300 px-3 py-1 text-xs">Grid World</a>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
