<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<style {csp-style-nonce}>
    .test-spinner { display: none; width: 22px; height: 12px; align-items: center; gap: 3px; }
    .test-spinner .dot { width: 6px; height: 6px; border-radius: 999px; background: currentColor; opacity: 0.35; animation: dotPulse 1s infinite ease-in-out; }
    .test-spinner .dot:nth-child(2) { animation-delay: 0.15s; }
    .test-spinner .dot:nth-child(3) { animation-delay: 0.30s; }
    #btn-test.test-on .test-spinner { display: inline-flex; }
    @keyframes dotPulse { 0%, 80%, 100% { opacity: 0.25; transform: scale(0.8); } 40% { opacity: 1; transform: scale(1.0); } }
</style>

<div class="space-y-4">
    <div class="border-b border-slate-200 pb-3">
        <h2 class="text-2xl font-semibold">Logistic Regression Visual Lab</h2>
        <p class="text-slate-500">Binary classification simulation with sigmoid boundary learning.</p>
    </div>

    <div class="space-y-2">
        <section x-data="{ open: true }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span>1) What Logistic Regression Does</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p>Logistic regression predicts the probability of class membership for binary targets.</p>
                <p class="text-center">$$ \hat{y} = \sigma(z), \quad z = mx + b, \quad \sigma(z)=\frac{1}{1+e^{-z}} $$</p>
                <p>The model outputs values between 0 and 1. A threshold such as 0.5 converts probability into class labels.</p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span>2) Objective Function (Binary Cross-Entropy)</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p>The training objective minimizes negative log likelihood:</p>
                <p class="text-center">$$ L(m,b)=-\frac{1}{n}\sum_{i=1}^{n}\left[y_i\log(\hat{y_i})+(1-y_i)\log(1-\hat{y_i})\right] $$</p>
                <p>This loss penalizes confident wrong predictions heavily, which improves calibrated probability outputs.</p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span>3) Gradient Updates</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p>For one-feature logistic regression, batch gradients are:</p>
                <p class="text-center">$$ \frac{\partial L}{\partial m}=\frac{1}{n}\sum(\hat{y_i}-y_i)x_i,\quad \frac{\partial L}{\partial b}=\frac{1}{n}\sum(\hat{y_i}-y_i) $$</p>
                <p class="text-center">$$ m \leftarrow m-\eta\frac{\partial L}{\partial m},\quad b \leftarrow b-\eta\frac{\partial L}{\partial b} $$</p>
                <p>Lower learning rates improve stability, while larger rates converge faster but may oscillate.</p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span>4) Practical Workflow</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700">
                <ol class="list-decimal pl-5 space-y-1">
                    <li>Add class points manually (lower band for class 0, upper band for class 1) or load random data.</li>
                    <li>Train with <strong>Auto Train</strong> and monitor loss decay.</li>
                    <li>Use <strong>Step</strong> to inspect per-iteration behavior.</li>
                    <li>Enable <strong>Test Mode</strong> and click to inspect predicted probability at any input position.</li>
                </ol>
            </div>
        </section>
    </div>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-12">
        <div class="lg:col-span-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <div class="mb-2 flex flex-wrap items-center gap-2">
                    <button id="btn-random" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm">Generate Sample Data</button>
                    <button id="btn-run" class="rounded-lg bg-green-700 px-3 py-1.5 text-sm text-white">Auto Train</button>
                    <button id="btn-step" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm">Step</button>
                    <button id="btn-test" class="inline-flex items-center rounded-lg border border-slate-300 px-3 py-1.5 text-sm">
                        <span class="label">Test Mode</span>
                        <span class="test-spinner ms-2" aria-hidden="true"><span class="dot"></span><span class="dot"></span><span class="dot"></span></span>
                    </button>
                    <button id="btn-reset" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm">Reset</button>
                    <label class="ml-auto text-sm">LR:
                        <input type="number" id="lr" value="0.1" step="0.01" min="0.001" class="ml-1 w-24 rounded-lg border border-slate-300 px-2 py-1">
                    </label>
                </div>

                <p class="mb-2 text-sm text-slate-500">Click canvas to add points. Points near y=0 represent class 0 and points near y=1 represent class 1.</p>
                <canvas id="cv" class="w-full rounded border border-slate-200 bg-white" style="height:420px;"></canvas>

                <div class="mt-3 text-sm text-slate-700">
                    <div id="status"></div>
                    <div id="equation" class="font-medium"></div>
                </div>
            </div>
        </div>

        <div class="space-y-4 lg:col-span-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-2 text-lg font-semibold">Loss Curve</h5>
                <canvas id="lossChart" class="w-full rounded border border-slate-200 bg-white" style="height:180px;"></canvas>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-2 text-lg font-semibold">Interpretation Guide</h5>
                <ul class="list-disc pl-5 text-sm text-slate-700 space-y-1">
                    <li>The yellow S-curve is the learned probability function.</li>
                    <li>Red points are class 1, cyan points are class 0.</li>
                    <li>The center transition zone approximates the decision boundary.</li>
                    <li>Decreasing loss indicates improving classification confidence.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
window.MathJax = {
    tex: { inlineMath: [['$', '$'], ['\\(', '\\)']], displayMath: [['$$', '$$'], ['\\[', '\\]']] },
    svg: { fontCache: 'global' }
};
</script>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js" async></script>
<script src="/assets/js/logistic_regression.js"></script>
<?= $this->endSection() ?>
