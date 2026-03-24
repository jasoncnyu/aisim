<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-4">
    <div class="border-b border-slate-200 pb-3">
        <h2 class="text-2xl font-semibold"><?= lang('SVM.title') ?></h2>
        <p class="text-slate-500"><?= lang('SVM.subtitle') ?></p>
    </div>

    <div class="space-y-2">
        <section x-data="{ open: true }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span><?= lang('SVM.accordion.1.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p><?= lang('SVM.accordion.1.p1') ?></p>
                <p class="text-center"><?= lang('SVM.accordion.1.equation') ?></p>
                <p><?= lang('SVM.accordion.1.p2') ?></p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span><?= lang('SVM.accordion.2.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p><?= lang('SVM.accordion.2.p1') ?></p>
                <p><?= lang('SVM.accordion.2.p2') ?></p>
                <p><?= lang('SVM.accordion.2.p3') ?></p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span><?= lang('SVM.accordion.3.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <ul class="list-disc pl-5 space-y-1">
                    <li><?= lang('SVM.accordion.3.li1') ?></li>
                    <li><?= lang('SVM.accordion.3.li2') ?></li>
                    <li><?= lang('SVM.accordion.3.li3') ?></li>
                    <li><?= lang('SVM.accordion.3.li4') ?></li>
                </ul>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span><?= lang('SVM.accordion.4.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700">
                <ol class="list-decimal pl-5 space-y-1">
                    <li><?= lang('SVM.accordion.4.step1') ?></li>
                    <li><?= lang('SVM.accordion.4.step2') ?></li>
                    <li><?= lang('SVM.accordion.4.step3') ?></li>
                    <li><?= lang('SVM.accordion.4.step4') ?></li>
                </ol>
            </div>
        </section>
    </div>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-12">
        <div class="lg:col-span-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <canvas id="svmCanvas" class="w-full rounded border border-slate-200 bg-white" style="height:520px;"></canvas>

                <div class="mt-3 flex flex-wrap items-center gap-2">
                    <button id="btn-classA" class="rounded-lg border border-cyan-300 bg-cyan-100 px-3 py-1.5 text-sm text-cyan-900"><?= lang('SVM.controls.class_a') ?></button>
                    <button id="btn-classB" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('SVM.controls.class_b') ?></button>

                    <label class="text-sm"><?= lang('SVM.controls.model_label') ?>
                        <select id="modelType" class="ml-1 rounded-lg border border-slate-300 px-2 py-1">
                            <option value="linear"><?= lang('SVM.controls.model_linear') ?></option>
                            <option value="kernel_perceptron"><?= lang('SVM.controls.model_kernel') ?></option>
                        </select>
                    </label>

                    <label class="text-sm"><?= lang('SVM.controls.lambda_label') ?>
                        <input id="lambda" type="number" value="0.0001" step="0.0001" min="0" class="ml-1 w-24 rounded-lg border border-slate-300 px-2 py-1">
                    </label>
                    <label class="text-sm"><?= lang('SVM.controls.lr_label') ?>
                        <input id="lr" type="number" value="0.5" step="0.1" min="0.001" class="ml-1 w-20 rounded-lg border border-slate-300 px-2 py-1">
                    </label>
                    <label class="text-sm"><?= lang('SVM.controls.epochs_label') ?>
                        <input id="epochs" type="number" value="5" min="1" class="ml-1 w-20 rounded-lg border border-slate-300 px-2 py-1">
                    </label>

                    <div id="kernelParams" class="flex flex-wrap items-center gap-2">
                        <label class="text-sm"><?= lang('SVM.controls.kernel_label') ?>
                            <select id="kernel" class="ml-1 rounded-lg border border-slate-300 px-2 py-1">
                                <option value="rbf"><?= lang('SVM.controls.kernel_rbf') ?></option>
                                <option value="poly"><?= lang('SVM.controls.kernel_poly') ?></option>
                            </select>
                        </label>
                        <label class="text-sm"><?= lang('SVM.controls.gamma_label') ?>
                            <input id="gamma" type="number" value="1.0" step="0.1" class="ml-1 w-20 rounded-lg border border-slate-300 px-2 py-1">
                        </label>
                        <label class="text-sm"><?= lang('SVM.controls.degree_label') ?>
                            <input id="degree" type="number" value="3" min="1" class="ml-1 w-16 rounded-lg border border-slate-300 px-2 py-1">
                        </label>
                    </div>

                    <div class="ml-auto flex flex-wrap gap-2">
                        <button id="btn-demo" class="rounded-lg border border-emerald-300 bg-emerald-50 px-3 py-1.5 text-sm text-emerald-800"><?= lang('SVM.controls.load_demo') ?></button>
                        <button id="btn-step" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('SVM.controls.step') ?></button>
                        <button id="btn-run" class="rounded-lg bg-green-700 px-3 py-1.5 text-sm text-white"><?= lang('SVM.controls.run') ?></button>
                        <button id="btn-stop" class="rounded-lg border border-amber-300 bg-amber-50 px-3 py-1.5 text-sm text-amber-900"><?= lang('SVM.controls.stop') ?></button>
                        <button id="btn-clear" class="rounded-lg border border-rose-300 bg-rose-50 px-3 py-1.5 text-sm text-rose-900"><?= lang('SVM.controls.clear') ?></button>
                    </div>
                </div>

                <p class="mt-2 text-sm text-slate-500"><?= lang('SVM.controls.hint') ?></p>
            </div>
        </div>

        <div class="space-y-4 lg:col-span-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-2 text-lg font-semibold"><?= lang('SVM.status.title') ?></h5>
                <div><strong><?= lang('SVM.status.points') ?></strong> <span id="countA">0</span> A | <span id="countB">0</span> B</div>
                <div class="mt-1"><strong><?= lang('SVM.status.epoch') ?></strong> <span id="curEpoch">0</span></div>
                <div class="mt-1"><strong><?= lang('SVM.status.accuracy') ?></strong> <span id="lastAcc">-</span></div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-2 text-lg font-semibold"><?= lang('SVM.model_info_title') ?></h5>
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
