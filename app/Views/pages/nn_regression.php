<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-4">
    <div class="border-b border-slate-200 pb-3">
        <h2 class="text-2xl font-semibold">Nonlinear Neural Regression Lab</h2>
        <p class="text-slate-500">Fit nonlinear curves with a multilayer perceptron, then observe train/validation divergence under overtraining.</p>
    </div>

    <div class="space-y-2">
        <section x-data="{ open: true }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="flex w-full items-center justify-between px-4 py-3 text-left font-medium" @click="open = !open">
                <span>1) Model Formulation</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="space-y-2 px-4 pb-4 text-sm text-slate-700">
                <p>Unlike linear regression \(y=ax+b\), this lab uses hidden layers to learn nonlinear mappings \(x \mapsto y\).</p>
                <p class="text-center">$$\hat{y}=W_L\,\phi(W_{L-1}\phi(\cdots\phi(W_1x+b_1)\cdots)+b_{L-1})+b_L$$</p>
                <p>Choose depth, width, and activation to control model capacity.</p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="flex w-full items-center justify-between px-4 py-3 text-left font-medium" @click="open = !open">
                <span>2) Loss and Overfitting Signal</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="space-y-2 px-4 pb-4 text-sm text-slate-700">
                <p>The objective is mean squared error on the training subset:</p>
                <p class="text-center">$$\text{MSE}=\frac{1}{n}\sum_{i=1}^{n}(y_i-\hat{y}_i)^2$$</p>
                <p>Overfitting appears when train loss keeps decreasing while validation loss flattens or rises.</p>
            </div>
        </section>
    </div>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-12">
        <div class="lg:col-span-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <div class="mb-2 flex flex-wrap items-center gap-2">
                    <button id="mode-add" class="rounded-lg border border-slate-300 bg-slate-900 px-3 py-1.5 text-sm text-white">Add Point</button>
                    <button id="mode-test" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm">Test Mode</button>
                    <button id="btn-clear" class="rounded-lg border border-rose-300 bg-rose-50 px-3 py-1.5 text-sm text-rose-900">Clear</button>
                    <select id="demoType" class="ml-auto rounded-lg border border-slate-300 px-2 py-1.5 text-sm">
                        <option value="sine">Sine Curve</option>
                        <option value="cubic">Cubic Curve</option>
                        <option value="piecewise">Piecewise Curve</option>
                    </select>
                    <button id="btn-demo" class="rounded-lg border border-emerald-300 bg-emerald-50 px-3 py-1.5 text-sm text-emerald-800">Load Demo</button>
                </div>

                <canvas id="nnCanvas" class="w-full rounded border border-slate-200 bg-white" style="height:420px;"></canvas>
                <p class="mt-2 text-sm text-slate-500">Click to add samples. In Test Mode, click an x-position to inspect predicted y and residual.</p>

                <div class="mt-3 grid grid-cols-2 gap-2 md:grid-cols-4">
                    <label class="text-sm">Hidden Layers
                        <input id="hiddenLayers" type="number" value="2" min="1" max="3" class="mt-1 w-full rounded-lg border border-slate-300 px-2 py-1">
                    </label>
                    <label class="text-sm">Units / Layer
                        <input id="hiddenUnits" type="number" value="32" min="4" max="128" step="4" class="mt-1 w-full rounded-lg border border-slate-300 px-2 py-1">
                    </label>
                    <label class="text-sm">Activation
                        <select id="activation" class="mt-1 w-full rounded-lg border border-slate-300 px-2 py-1">
                            <option value="tanh">tanh</option>
                            <option value="relu">relu</option>
                        </select>
                    </label>
                    <label class="text-sm">Validation Ratio
                        <input id="valRatio" type="number" value="0.3" min="0" max="0.5" step="0.05" class="mt-1 w-full rounded-lg border border-slate-300 px-2 py-1">
                    </label>
                </div>

                <div class="mt-2 grid grid-cols-2 gap-2 md:grid-cols-5">
                    <label class="text-sm">LR
                        <input id="lr" type="number" value="0.01" min="0.0001" step="0.001" class="mt-1 w-full rounded-lg border border-slate-300 px-2 py-1">
                    </label>
                    <label class="text-sm">Batch
                        <input id="batch" type="number" value="16" min="1" class="mt-1 w-full rounded-lg border border-slate-300 px-2 py-1">
                    </label>
                    <label class="text-sm">Epochs
                        <input id="epochs" type="number" value="200" min="1" class="mt-1 w-full rounded-lg border border-slate-300 px-2 py-1">
                    </label>
                    <label class="text-sm">L2 Reg
                        <input id="l2" type="number" value="0" min="0" step="0.0001" class="mt-1 w-full rounded-lg border border-slate-300 px-2 py-1">
                    </label>
                    <div class="flex items-end">
                        <button id="btn-init" class="w-full rounded-lg border border-slate-300 px-3 py-1.5 text-sm">Init Model</button>
                    </div>
                </div>

                <div class="mt-3 flex flex-wrap justify-end gap-2">
                    <button id="btn-step" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm">Step</button>
                    <button id="btn-run" class="rounded-lg bg-green-700 px-3 py-1.5 text-sm text-white">Run</button>
                    <button id="btn-stop" class="rounded-lg border border-amber-300 bg-amber-50 px-3 py-1.5 text-sm text-amber-900">Stop</button>
                </div>

                <canvas id="lossChart" class="mt-3 w-full rounded border border-slate-200 bg-white" style="height:150px;"></canvas>
            </div>
        </div>

        <div class="space-y-4 lg:col-span-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-2 text-lg font-semibold">Training Status</h5>
                <div><strong>Points:</strong> <span id="countPts">0</span></div>
                <div class="mt-1"><strong>Train / Val:</strong> <span id="splitInfo">0 / 0</span></div>
                <div class="mt-1"><strong>Epoch:</strong> <span id="epoch">0</span></div>
                <div class="mt-1"><strong>Train Loss:</strong> <span id="trainLoss">-</span></div>
                <div class="mt-1"><strong>Val Loss:</strong> <span id="valLoss">-</span></div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-2 text-lg font-semibold">Interpretation</h5>
                <ul class="list-disc space-y-1 pl-5 text-sm text-slate-700">
                    <li>Blue points: training subset, orange points: validation subset.</li>
                    <li>Yellow marker in Test Mode: predicted output at clicked x.</li>
                    <li>If train loss drops but val loss rises, capacity is too high or training is too long.</li>
                    <li>Try stronger L2 regularization or smaller hidden layers to reduce overfitting.</li>
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
<script src="/assets/js/nn_regression.js"></script>
<?= $this->endSection() ?>
