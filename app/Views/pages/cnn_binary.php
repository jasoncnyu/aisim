<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<style {csp-style-nonce}>
    .cnn-spinner { display: none; }
    .cnn-spinner.active { display: flex; }
</style>

<div class="space-y-4">
    <div class="border-b border-slate-200 pb-3">
        <h2 class="text-2xl font-semibold">CNN Binary Lab</h2>
        <p class="text-slate-500">Tiny convolutional neural network for two-class image classification with filter and feature-map visualization.</p>
    </div>

    <div class="space-y-2">
        <section x-data="{ open: true }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="flex w-full items-center justify-between px-4 py-3 text-left font-medium" @click="open = !open">
                <span>1) Model Architecture</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="space-y-2 px-4 pb-4 text-sm text-slate-700">
                <p>This page trains a compact CNN: <code>Conv(3x3) -> ReLU -> Flatten -> Dense -> ReLU -> Dense -> Softmax</code>.</p>
                <p>Input images are converted to grayscale and resized to <code>32x32</code>, so each sample is a 1024-dimensional vector before convolution.</p>
                <p>Binary labels are mapped to class probabilities: <code>P(class 1)</code> and <code>P(class 2)</code>.</p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="flex w-full items-center justify-between px-4 py-3 text-left font-medium" @click="open = !open">
                <span>2) Learning Objective</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="space-y-2 px-4 pb-4 text-sm text-slate-700">
                <p>The network is optimized with cross-entropy over two classes:</p>
                <p class="text-center">$$ L = -\frac{1}{N}\sum_{i=1}^{N}\sum_{c=1}^{2} y_{ic}\log(\hat{y}_{ic}) $$</p>
                <p>Use a lower learning rate for stable convergence, or a higher learning rate for faster but noisier updates.</p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="flex w-full items-center justify-between px-4 py-3 text-left font-medium" @click="open = !open">
                <span>3) Suggested Workflow</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700">
                <ol class="list-decimal space-y-1 pl-5">
                    <li>Load demo cat/dog images or upload custom files into each class bucket.</li>
                    <li>Initialize weights, run a few epochs, and monitor loss and accuracy.</li>
                    <li>Check filter values and feature maps to understand what the first conv layer captures.</li>
                    <li>Upload a test image and inspect class probabilities.</li>
                </ol>
            </div>
        </section>
    </div>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-12">
        <div class="space-y-4 lg:col-span-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <div class="mb-3 flex flex-wrap items-center gap-2">
                    <button id="btn-demo" class="rounded-lg border border-emerald-300 bg-emerald-50 px-3 py-1.5 text-sm text-emerald-800">Load Demo Data</button>
                    <button id="btn-init" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm">Init Weights</button>
                    <button id="btn-step" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm">Step (1 Epoch)</button>
                    <button id="btn-run" class="rounded-lg bg-green-700 px-3 py-1.5 text-sm text-white">Run</button>
                    <button id="btn-stop" class="rounded-lg border border-amber-300 bg-amber-50 px-3 py-1.5 text-sm text-amber-900">Stop</button>
                    <button id="btn-reset" class="rounded-lg border border-rose-300 bg-rose-50 px-3 py-1.5 text-sm text-rose-900">Reset</button>

                    <label class="ml-auto text-sm">LR:
                        <input id="lr" value="0.01" step="0.001" min="0.0001" type="number" class="ml-1 w-24 rounded-lg border border-slate-300 px-2 py-1">
                    </label>
                    <label class="text-sm">Epochs:
                        <input id="epochs" value="10" type="number" min="1" class="ml-1 w-20 rounded-lg border border-slate-300 px-2 py-1">
                    </label>
                    <label class="text-sm">Batch:
                        <input id="batch" value="2" type="number" min="1" class="ml-1 w-16 rounded-lg border border-slate-300 px-2 py-1">
                    </label>
                </div>

                <div class="mb-2 flex flex-wrap items-center gap-3 text-sm text-slate-700">
                    <div>Dataset: <span id="dsSize">0</span></div>
                    <div>Epoch: <span id="epoch">0</span></div>
                    <div>Loss: <span id="loss">-</span></div>
                    <div>Accuracy: <span id="acc">-</span></div>
                </div>
                <canvas id="lossChart" class="w-full rounded border border-slate-200 bg-white" style="height:130px;"></canvas>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-2 text-lg font-semibold">Training Images</h5>
                <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
                    <div>
                        <label class="mb-1 block text-sm text-slate-700">Class 1 (label 0)</label>
                        <input id="class1Files" type="file" multiple accept="image/*" class="w-full rounded-lg border border-slate-300 px-2 py-1.5 text-sm">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm text-slate-700">Class 2 (label 1)</label>
                        <input id="class2Files" type="file" multiple accept="image/*" class="w-full rounded-lg border border-slate-300 px-2 py-1.5 text-sm">
                    </div>
                </div>
                <p class="mt-2 text-sm text-slate-500">Uploaded images are resized to 32x32 grayscale before training.</p>

                <div class="relative mt-3 min-h-40 rounded border border-slate-200 bg-slate-50 p-2">
                    <div id="loadingSpinner" class="cnn-spinner absolute inset-0 z-10 items-center justify-center bg-white/70">
                        <div class="text-center">
                            <div class="mx-auto h-8 w-8 animate-spin rounded-full border-4 border-slate-200 border-t-slate-700"></div>
                            <p class="mt-2 text-xs text-slate-600">Loading images...</p>
                        </div>
                    </div>
                    <div id="trainImages" class="flex flex-wrap gap-2"></div>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-2 text-lg font-semibold">Conv Filters (Realtime)</h5>
                <div id="filterVis" class="flex flex-wrap gap-3"></div>
            </div>
        </div>

        <div class="space-y-4 lg:col-span-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-2 text-lg font-semibold">Prediction</h5>
                <input id="testFile" type="file" accept="image/*" class="mb-2 w-full rounded-lg border border-slate-300 px-2 py-1.5 text-sm">
                <button id="btn-predict" class="rounded-lg bg-slate-900 px-3 py-1.5 text-sm text-white">Predict Uploaded Image</button>
                <div id="predResult" class="mt-3 text-base font-semibold">-</div>
                <ul id="predList" class="mt-2 list-disc pl-5 text-sm text-slate-700"></ul>
                <div id="inputPreview" class="mt-3"></div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-2 text-lg font-semibold">Feature Maps (Conv Layer)</h5>
                <div id="featureVis" class="flex flex-wrap gap-3"></div>
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
<script src="/assets/js/cnn_binary.js"></script>
<?= $this->endSection() ?>
