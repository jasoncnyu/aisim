<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<style {csp-style-nonce}>
    #btn-run { position: relative; color: #fff; transition: background 0.2s; }
    #btn-run .progress-bg { position: absolute; top: 0; left: 0; height: 100%; width: 0%; background-color: rgba(21, 128, 61, 0.45); z-index: 0; transition: width 0.1s linear; }
    #btn-run .btn-label { position: relative; z-index: 1; }
    .test-spinner { display: none; width: 22px; height: 12px; align-items: center; gap: 3px; }
    .test-spinner .dot { width: 6px; height: 6px; border-radius: 50%; background: currentColor; opacity: 0.35; animation: dotPulse 1s infinite ease-in-out; }
    .test-spinner .dot:nth-child(2) { animation-delay: 0.15s; }
    .test-spinner .dot:nth-child(3) { animation-delay: 0.3s; }
    @keyframes dotPulse { 0%, 80%, 100% { opacity: 0.25; transform: scale(0.8); } 40% { opacity: 1; transform: scale(1); } }

    #mode-test.test-on { color: #854d0e !important; background-color: #fef3c7 !important; border-color: #fcd34d !important; }
    #mode-test.test-on .test-spinner { display: inline-flex; }
    #mode-test .label { display: inline-flex; align-items: center; gap: 6px; }
    #mode-add.active { background: #0f172a; color: #fff; border-color: #0f172a; }
</style>

<div class="space-y-4">
    <div class="border-b border-slate-200 pb-3">
        <h2 class="text-2xl font-semibold">Linear Regression Visualization</h2>
        <p class="text-slate-500">Interactive simulation for OLS, GD, and SGD.</p>
    </div>

    <div id="lrAccordion" class="space-y-2">
        <section x-data="{ open: true }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span>1) What Linear Regression Solves</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p>Linear regression estimates a straight-line relationship between an input <code>x</code> and output <code>y</code>.</p>
                <p class="text-center"><code>y = ax + b</code></p>
                <p>Here, <code>a</code> is the slope and <code>b</code> is the intercept. In this simulator, each point you add is a training sample and the model finds the best-fitting <code>a</code> and <code>b</code>.</p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span>2) Error Function and Why MSE Is Used</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p>The model minimizes mean squared error (MSE):</p>
                <p class="text-center">$$ MSE(a,b) = \frac{1}{n}\sum_{i=1}^{n}(y_i-(ax_i+b))^2 $$</p>
                <p>Squaring penalizes large errors more strongly and gives a smooth optimization target. Lower loss means a better fit.</p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span>3) OLS vs GD vs SGD</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <ul class="list-disc pl-5 space-y-1">
                    <li><strong>OLS</strong>: Closed-form and one-shot.</li>
                    <li><strong>Batch GD</strong>: Uses all samples per epoch, stable but heavier.</li>
                    <li><strong>SGD</strong>: Uses shuffled single-sample updates, faster but noisier.</li>
                </ul>
                <p>Use the same points and compare learning curves for each method.</p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span>4) Suggested Learning Workflow</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <ol class="list-decimal pl-5 space-y-1">
                    <li>Add points or load demo data.</li>
                    <li>Run OLS first to get a baseline line.</li>
                    <li>Switch to GD/SGD and tune learning rate and epochs.</li>
                    <li>Use Test Mode to inspect actual vs predicted values.</li>
                </ol>
            </div>
        </section>
    </div>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-12">
        <div class="lg:col-span-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <div class="mb-2 flex flex-wrap items-center gap-2">
                    <button id="mode-add" class="active rounded-lg border border-slate-300 px-3 py-1.5 text-sm">Add Point</button>
                    <button id="mode-clear" class="rounded-lg border border-red-300 bg-red-50 px-3 py-1.5 text-sm text-red-700">Clear Points</button>
                    <button id="btn-demo" class="ml-auto rounded-lg border border-slate-300 px-3 py-1.5 text-sm">Load Demo Data</button>
                </div>
                <p class="mb-2 text-sm text-slate-500">Click to add points. Long-press on a point to remove it.</p>

                <canvas id="plot" class="w-full rounded border border-slate-200 bg-white" style="height:420px;"></canvas>

                <div class="mt-3 grid grid-cols-1 gap-2 xl:grid-cols-2 xl:items-end">
                    <div>
                        <label class="mb-1 block text-sm font-medium">Regression Method</label>
                        <select id="fitMethod" class="w-full rounded-lg border border-slate-300 px-2 py-1.5 text-sm xl:max-w-xs">
                            <option value="ols">OLS</option>
                            <option value="gd">Batch Gradient Descent</option>
                            <option value="sgd">Stochastic Gradient Descent</option>
                        </select>
                    </div>

                    <div id="learningParams" class="flex flex-wrap items-end gap-2">
                        <div>
                            <label class="mb-1 block text-sm font-medium">Learning Rate</label>
                            <input id="lr" type="number" value="0.01" step="0.005" class="w-28 rounded-lg border border-slate-300 px-2 py-1.5 text-sm">
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-medium">Epochs</label>
                            <input id="epochs" type="number" value="50" min="1" class="w-28 rounded-lg border border-slate-300 px-2 py-1.5 text-sm">
                        </div>
                    </div>
                </div>

                <div class="mt-3 flex flex-wrap justify-end gap-2">
                    <button id="btn-step" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm">Step Train</button>
                    <button id="btn-run" class="relative overflow-hidden rounded-lg bg-green-700 px-3 py-1.5 text-sm text-white" style="width:120px;">
                        <span class="btn-label">Auto Train</span>
                        <div class="progress-bg"></div>
                    </button>
                    <button id="mode-test" class="inline-flex items-center rounded-lg border border-slate-300 px-3 py-1.5 text-sm">
                        <span class="label">Test Mode</span>
                        <span class="test-spinner ms-2" aria-hidden="true"><span class="dot"></span><span class="dot"></span><span class="dot"></span></span>
                    </button>
                </div>

                <hr class="my-4 border-slate-200">
                <h6 class="mb-2 font-semibold">Loss (MSE)</h6>
                <canvas id="lossChart" class="w-full rounded border border-slate-200 bg-white" height="90"></canvas>
            </div>
        </div>

        <div class="space-y-4 lg:col-span-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-3 text-lg font-semibold">Model</h5>
                <div><strong>Points:</strong> <span id="countPts">0</span></div>
                <div class="mt-2"><strong>Slope (a):</strong> <span id="slope">-</span></div>
                <div class="mt-2"><strong>Intercept (b):</strong> <span id="intercept">-</span></div>
                <div class="mt-2" id="r2Row"><strong>R2:</strong> <span id="r2">-</span></div>
                <div class="mt-2" id="lossRow"><strong>Last Loss:</strong> <span id="lastLoss">-</span></div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-3 text-lg font-semibold">Method Notes</h5>
                <div id="ex-ols">
                    <h6 class="font-medium">OLS</h6>
                    <p class="text-sm text-slate-600 mb-2">Closed-form solution from covariance and variance:</p>
                    <p class="text-sm text-slate-700">$$ a = \frac{\sum (x_i-\bar{x})(y_i-\bar{y})}{\sum (x_i-\bar{x})^2}, \quad b = \bar{y} - a\bar{x} $$</p>
                </div>
                <div id="ex-gd" style="display:none">
                    <h6 class="font-medium">Batch GD</h6>
                    <p class="text-sm text-slate-600 mb-2">Update using gradients over the full dataset:</p>
                    <p class="text-sm text-slate-700">$$ a \leftarrow a - \eta \frac{\partial MSE}{\partial a}, \quad b \leftarrow b - \eta \frac{\partial MSE}{\partial b} $$</p>
                </div>
                <div id="ex-sgd" style="display:none">
                    <h6 class="font-medium">SGD</h6>
                    <p class="text-sm text-slate-600 mb-2">Per-sample updates with shuffled points:</p>
                    <p class="text-sm text-slate-700">$$ a \leftarrow a - \eta \cdot 2(ax_j+b-y_j)x_j, \quad b \leftarrow b - \eta \cdot 2(ax_j+b-y_j) $$</p>
                </div>
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
<script src="/assets/js/linear_regression.js"></script>
<?= $this->endSection() ?>
