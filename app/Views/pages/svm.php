<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-4">
    <div class="border-b border-slate-200 pb-3">
        <h2 class="text-2xl font-semibold">Support Vector Machine Lab</h2>
        <p class="text-slate-500">Compare linear max-margin classification and kernel-based nonlinear separation on interactive 2D data.</p>
    </div>

    <div class="space-y-2">
        <section x-data="{ open: true }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span>1) Maximum-Margin Principle</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p>Linear SVM learns a hyperplane \(f(x)=w^Tx+b\) that separates classes while maximizing margin.</p>
                <p class="text-center">$$\min_{w,b}\ \frac{1}{2}\|w\|^2 + C\sum_i \max(0, 1-y_i(w^Tx_i+b))$$</p>
                <p>In this simulator, the linear model uses Pegasos-style stochastic updates to optimize hinge-loss behavior.</p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span>2) Why Kernels Help</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p>When data is not linearly separable, kernel methods compare points in transformed feature space.</p>
                <p>Try <strong>RBF</strong> for smooth local boundaries or <strong>Polynomial</strong> for curved global boundaries.</p>
                <p>Support vectors are highlighted as emphasized samples that define the decision surface.</p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span>3) Parameter Effects</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <ul class="list-disc pl-5 space-y-1">
                    <li><code>lambda</code>: regularization strength for linear Pegasos updates.</li>
                    <li><code>lr</code>: step size controlling update speed and stability.</li>
                    <li><code>gamma</code> (RBF): larger values create tighter, more local boundaries.</li>
                    <li><code>degree</code> (Poly): higher degree increases boundary complexity.</li>
                </ul>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span>4) Suggested Workflow</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700">
                <ol class="list-decimal pl-5 space-y-1">
                    <li>Load demo data and train Linear SVM for several epochs.</li>
                    <li>Inspect margin lines and training accuracy trend.</li>
                    <li>Switch to Kernel Perceptron and compare nonlinear region behavior.</li>
                    <li>Tune kernel parameters and observe support vector growth.</li>
                </ol>
            </div>
        </section>
    </div>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-12">
        <div class="lg:col-span-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <canvas id="svmCanvas" class="w-full rounded border border-slate-200 bg-white" style="height:520px;"></canvas>

                <div class="mt-3 flex flex-wrap items-center gap-2">
                    <button id="btn-classA" class="rounded-lg border border-cyan-300 bg-cyan-100 px-3 py-1.5 text-sm text-cyan-900">Class A</button>
                    <button id="btn-classB" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm">Class B</button>

                    <label class="text-sm">Model:
                        <select id="modelType" class="ml-1 rounded-lg border border-slate-300 px-2 py-1">
                            <option value="linear">Linear SVM (Pegasos)</option>
                            <option value="kernel_perceptron">Kernel Perceptron</option>
                        </select>
                    </label>

                    <label class="text-sm">lambda:
                        <input id="lambda" type="number" value="0.0001" step="0.0001" min="0" class="ml-1 w-24 rounded-lg border border-slate-300 px-2 py-1">
                    </label>
                    <label class="text-sm">LR:
                        <input id="lr" type="number" value="0.5" step="0.1" min="0.001" class="ml-1 w-20 rounded-lg border border-slate-300 px-2 py-1">
                    </label>
                    <label class="text-sm">Epochs:
                        <input id="epochs" type="number" value="5" min="1" class="ml-1 w-20 rounded-lg border border-slate-300 px-2 py-1">
                    </label>

                    <div id="kernelParams" class="flex flex-wrap items-center gap-2">
                        <label class="text-sm">Kernel:
                            <select id="kernel" class="ml-1 rounded-lg border border-slate-300 px-2 py-1">
                                <option value="rbf">RBF</option>
                                <option value="poly">Poly</option>
                            </select>
                        </label>
                        <label class="text-sm">gamma:
                            <input id="gamma" type="number" value="1.0" step="0.1" class="ml-1 w-20 rounded-lg border border-slate-300 px-2 py-1">
                        </label>
                        <label class="text-sm">degree:
                            <input id="degree" type="number" value="3" min="1" class="ml-1 w-16 rounded-lg border border-slate-300 px-2 py-1">
                        </label>
                    </div>

                    <div class="ml-auto flex flex-wrap gap-2">
                        <button id="btn-demo" class="rounded-lg border border-emerald-300 bg-emerald-50 px-3 py-1.5 text-sm text-emerald-800">Load Demo</button>
                        <button id="btn-step" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm">Step</button>
                        <button id="btn-run" class="rounded-lg bg-green-700 px-3 py-1.5 text-sm text-white">Run</button>
                        <button id="btn-stop" class="rounded-lg border border-amber-300 bg-amber-50 px-3 py-1.5 text-sm text-amber-900">Stop</button>
                        <button id="btn-clear" class="rounded-lg border border-rose-300 bg-rose-50 px-3 py-1.5 text-sm text-rose-900">Clear</button>
                    </div>
                </div>

                <p class="mt-2 text-sm text-slate-500">Click to place samples. Use Class A/B toggle first, then train and inspect boundaries.</p>
            </div>
        </div>

        <div class="space-y-4 lg:col-span-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-2 text-lg font-semibold">Status</h5>
                <div><strong>Points:</strong> <span id="countA">0</span> A | <span id="countB">0</span> B</div>
                <div class="mt-1"><strong>Epoch:</strong> <span id="curEpoch">0</span></div>
                <div class="mt-1"><strong>Training Accuracy:</strong> <span id="lastAcc">-</span></div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-2 text-lg font-semibold">Model Info</h5>
                <pre id="modelInfo" class="max-h-64 overflow-auto rounded border border-slate-200 bg-slate-50 p-3 text-xs text-slate-700"></pre>
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
<script src="/assets/js/svm.js"></script>
<?= $this->endSection() ?>
