<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<style {csp-style-nonce}>
    .mnist-spinner { display: none; }
    .mnist-spinner.active { display: flex; }
</style>

<div class="space-y-4">
    <div class="border-b border-slate-200 pb-3">
        <h2 class="text-2xl font-semibold">CNN MNIST Lab</h2>
        <p class="text-slate-500">Train a compact multi-class CNN on 10 digit classes, then draw a digit and run live inference.</p>
    </div>

    <div class="space-y-2">
        <section x-data="{ open: true }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="flex w-full items-center justify-between px-4 py-3 text-left font-medium" @click="open = !open">
                <span>1) Dataset Loading Policy</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="space-y-2 px-4 pb-4 text-sm text-slate-700">
                <p>Demo samples are pre-packaged by class <code>0..9</code>. The base load pulls <code>10 images per class</code> (100 total).</p>
                <p>Use <strong>Add +10 per Class</strong> to incrementally scale to <code>20, 30, 40, 50</code> per class (max 500 total).</p>
                <p>This setup is designed for fast educational experiments while preserving class balance.</p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="flex w-full items-center justify-between px-4 py-3 text-left font-medium" @click="open = !open">
                <span>2) CNN Objective for 10 Classes</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="space-y-2 px-4 pb-4 text-sm text-slate-700">
                <p>The model outputs a 10-way softmax distribution.</p>
                <p class="text-center">$$\hat{y}_c = \frac{e^{z_c}}{\sum_{k=0}^{9} e^{z_k}}, \quad L = -\frac{1}{N}\sum_i\sum_{c=0}^{9} y_{ic}\log(\hat{y}_{ic})$$</p>
                <p>Use learning rate, batch size, optimizer, and architecture options to trade off speed and stability.</p>
            </div>
        </section>
    </div>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-12">
        <div class="space-y-4 lg:col-span-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <div class="mb-3 flex flex-wrap items-center gap-2">
                    <button id="btn-load-base" class="rounded-lg border border-emerald-300 bg-emerald-50 px-3 py-1.5 text-sm text-emerald-800">Load 10 / Class</button>
                    <button id="btn-add-10" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm">Add +10 / Class</button>
                    <button id="btn-clear-data" class="rounded-lg border border-rose-300 bg-rose-50 px-3 py-1.5 text-sm text-rose-900">Clear Data</button>

                    <span class="ml-auto rounded bg-slate-100 px-2 py-1 text-xs text-slate-600">Loaded per class: <span id="perClass">0</span> / 50</span>
                </div>

                <div class="mb-3 flex flex-wrap items-center gap-2">
                    <button id="btn-init" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm">Init Weights</button>
                    <button id="btn-step" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm">Step (1 Epoch)</button>
                    <button id="btn-run" class="rounded-lg bg-green-700 px-3 py-1.5 text-sm text-white">Run</button>
                    <button id="btn-stop" class="rounded-lg border border-amber-300 bg-amber-50 px-3 py-1.5 text-sm text-amber-900">Stop</button>

                    <label class="ml-auto text-sm">LR:
                        <input id="lr" type="number" value="0.01" min="0.0001" step="0.001" class="ml-1 w-24 rounded-lg border border-slate-300 px-2 py-1">
                    </label>
                    <label class="text-sm">Epochs:
                        <input id="epochs" type="number" value="8" min="1" class="ml-1 w-20 rounded-lg border border-slate-300 px-2 py-1">
                    </label>
                    <label class="text-sm">Batch:
                        <input id="batch" type="number" value="16" min="1" class="ml-1 w-20 rounded-lg border border-slate-300 px-2 py-1">
                    </label>
                </div>

                <div class="mb-3 flex flex-wrap items-center gap-2">
                    <label class="text-sm">Optimizer:
                        <select id="optimizer" class="ml-1 rounded-lg border border-slate-300 px-2 py-1">
                            <option value="sgd">SGD</option>
                            <option value="momentum">Momentum</option>
                        </select>
                    </label>
                    <label class="text-sm">Momentum:
                        <input id="momentum" type="number" value="0.9" min="0" max="0.99" step="0.01" class="ml-1 w-20 rounded-lg border border-slate-300 px-2 py-1">
                    </label>
                    <label class="text-sm">Conv Filters:
                        <input id="convFilters" type="number" value="4" min="2" max="8" step="1" class="ml-1 w-20 rounded-lg border border-slate-300 px-2 py-1">
                    </label>
                    <label class="text-sm">Hidden Units:
                        <input id="hiddenUnits" type="number" value="32" min="8" max="96" step="8" class="ml-1 w-20 rounded-lg border border-slate-300 px-2 py-1">
                    </label>
                    <button id="btn-apply-arch" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm">Apply Architecture</button>
                </div>

                <div class="grid grid-cols-2 gap-2 text-sm text-slate-700 md:grid-cols-4">
                    <div>Dataset: <span id="dsSize">0</span></div>
                    <div>Epoch: <span id="epoch">0</span></div>
                    <div>Loss: <span id="loss">-</span></div>
                    <div>Accuracy: <span id="acc">-</span></div>
                </div>

                <canvas id="lossChart" class="mt-2 w-full rounded border border-slate-200 bg-white" style="height:140px;"></canvas>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <div class="mb-2 flex items-center justify-between">
                    <h5 class="text-lg font-semibold">Demo Samples</h5>
                    <span id="classDist" class="text-xs text-slate-500"></span>
                </div>
                <div class="relative min-h-28 rounded border border-slate-200 bg-slate-50 p-2">
                    <div id="loadingSpinner" class="mnist-spinner absolute inset-0 z-10 items-center justify-center bg-white/70">
                        <div class="text-center">
                            <div class="mx-auto h-8 w-8 animate-spin rounded-full border-4 border-slate-200 border-t-slate-700"></div>
                            <p class="mt-2 text-xs text-slate-600">Loading digit images...</p>
                        </div>
                    </div>
                    <div id="sampleGrid" class="grid grid-cols-5 gap-2 md:grid-cols-10"></div>
                </div>
            </div>
        </div>

        <div class="space-y-4 lg:col-span-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-2 text-lg font-semibold">Draw and Predict</h5>
                <canvas id="drawCanvas" width="280" height="280" class="w-full rounded border border-slate-300 bg-black"></canvas>
                <div class="mt-2 flex gap-2">
                    <button id="btn-clear-draw" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm">Clear</button>
                    <button id="btn-predict-draw" class="rounded-lg bg-slate-900 px-3 py-1.5 text-sm text-white">Predict</button>
                </div>
                <div id="drawPred" class="mt-3 text-base font-semibold">-</div>
                <ul id="drawTop3" class="mt-2 list-disc pl-5 text-sm text-slate-700"></ul>
                <div id="drawPreview" class="mt-2"></div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-2 text-lg font-semibold">Confusion Matrix</h5>
                <div id="confusionWrap" class="overflow-auto"></div>
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
<script src="/assets/js/cnn_mnist.js"></script>
<?= $this->endSection() ?>
