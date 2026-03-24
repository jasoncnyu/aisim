<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-4">
    <div class="border-b border-slate-200 pb-3">
        <h2 class="text-2xl font-semibold"><?= lang('NNRegression.title') ?></h2>
        <p class="text-slate-500"><?= lang('NNRegression.subtitle') ?></p>
    </div>

    <div class="space-y-2">
        <section x-data="{ open: true }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="flex w-full items-center justify-between px-4 py-3 text-left font-medium" @click="open = !open">
                <span><?= lang('NNRegression.accordion.1.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="space-y-2 px-4 pb-4 text-sm text-slate-700">
                <p><?= lang('NNRegression.accordion.1.p1') ?></p>
                <p class="text-center"><?= lang('NNRegression.accordion.1.equation') ?></p>
                <p><?= lang('NNRegression.accordion.1.p2') ?></p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="flex w-full items-center justify-between px-4 py-3 text-left font-medium" @click="open = !open">
                <span><?= lang('NNRegression.accordion.2.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="space-y-2 px-4 pb-4 text-sm text-slate-700">
                <p><?= lang('NNRegression.accordion.2.p1') ?></p>
                <p class="text-center"><?= lang('NNRegression.accordion.2.equation') ?></p>
                <p><?= lang('NNRegression.accordion.2.p2') ?></p>
            </div>
        </section>
    </div>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-12">
        <div class="lg:col-span-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <div class="mb-2 flex flex-wrap items-center gap-2">
                    <button id="mode-add" class="rounded-lg border border-slate-300 bg-slate-900 px-3 py-1.5 text-sm text-white"><?= lang('NNRegression.controls.add_point') ?></button>
                    <button id="mode-test" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('NNRegression.controls.test_mode') ?></button>
                    <button id="btn-clear" class="rounded-lg border border-rose-300 bg-rose-50 px-3 py-1.5 text-sm text-rose-900"><?= lang('NNRegression.controls.clear') ?></button>
                    <select id="demoType" class="ml-auto rounded-lg border border-slate-300 px-2 py-1.5 text-sm">
                        <option value="sine"><?= lang('NNRegression.controls.demo.sine') ?></option>
                        <option value="cubic"><?= lang('NNRegression.controls.demo.cubic') ?></option>
                        <option value="piecewise"><?= lang('NNRegression.controls.demo.piecewise') ?></option>
                    </select>
                    <button id="btn-demo" class="rounded-lg border border-emerald-300 bg-emerald-50 px-3 py-1.5 text-sm text-emerald-800"><?= lang('NNRegression.controls.load_demo') ?></button>
                </div>

                <canvas id="nnCanvas" class="w-full rounded border border-slate-200 bg-white" style="height:420px;"></canvas>
                <p class="mt-2 text-sm text-slate-500"><?= lang('NNRegression.controls.hint') ?></p>

                <div class="mt-3 grid grid-cols-2 gap-2 md:grid-cols-4">
                    <label class="text-sm"><?= lang('NNRegression.params.hidden_layers') ?>
                        <input id="hiddenLayers" type="number" value="2" min="1" max="3" class="mt-1 w-full rounded-lg border border-slate-300 px-2 py-1">
                    </label>
                    <label class="text-sm"><?= lang('NNRegression.params.units_per_layer') ?>
                        <input id="hiddenUnits" type="number" value="32" min="4" max="128" step="4" class="mt-1 w-full rounded-lg border border-slate-300 px-2 py-1">
                    </label>
                    <label class="text-sm"><?= lang('NNRegression.params.activation') ?>
                        <select id="activation" class="mt-1 w-full rounded-lg border border-slate-300 px-2 py-1">
                            <option value="tanh">tanh</option>
                            <option value="relu">relu</option>
                        </select>
                    </label>
                    <label class="text-sm"><?= lang('NNRegression.params.val_ratio') ?>
                        <input id="valRatio" type="number" value="0.3" min="0" max="0.5" step="0.05" class="mt-1 w-full rounded-lg border border-slate-300 px-2 py-1">
                    </label>
                </div>

                <div class="mt-2 grid grid-cols-2 gap-2 md:grid-cols-5">
                    <label class="text-sm"><?= lang('NNRegression.params.lr') ?>
                        <input id="lr" type="number" value="0.01" min="0.0001" step="0.001" class="mt-1 w-full rounded-lg border border-slate-300 px-2 py-1">
                    </label>
                    <label class="text-sm"><?= lang('NNRegression.params.batch') ?>
                        <input id="batch" type="number" value="16" min="1" class="mt-1 w-full rounded-lg border border-slate-300 px-2 py-1">
                    </label>
                    <label class="text-sm"><?= lang('NNRegression.params.epochs') ?>
                        <input id="epochs" type="number" value="200" min="1" class="mt-1 w-full rounded-lg border border-slate-300 px-2 py-1">
                    </label>
                    <label class="text-sm"><?= lang('NNRegression.params.l2_reg') ?>
                        <input id="l2" type="number" value="0" min="0" step="0.0001" class="mt-1 w-full rounded-lg border border-slate-300 px-2 py-1">
                    </label>
                    <div class="flex items-end">
                        <button id="btn-init" class="w-full rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('NNRegression.params.init_model') ?></button>
                    </div>
                </div>

                <div class="mt-3 flex flex-wrap justify-end gap-2">
                    <button id="btn-step" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('NNRegression.actions.step') ?></button>
                    <button id="btn-run" class="rounded-lg bg-green-700 px-3 py-1.5 text-sm text-white"><?= lang('NNRegression.actions.run') ?></button>
                    <button id="btn-stop" class="rounded-lg border border-amber-300 bg-amber-50 px-3 py-1.5 text-sm text-amber-900"><?= lang('NNRegression.actions.stop') ?></button>
                </div>

                <canvas id="lossChart" class="mt-3 w-full rounded border border-slate-200 bg-white" style="height:150px;"></canvas>
            </div>
        </div>

        <div class="space-y-4 lg:col-span-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-2 text-lg font-semibold"><?= lang('NNRegression.status.title') ?></h5>
                <div><strong><?= lang('NNRegression.status.points') ?></strong> <span id="countPts">0</span></div>
                <div class="mt-1"><strong><?= lang('NNRegression.status.train_val') ?></strong> <span id="splitInfo">0 / 0</span></div>
                <div class="mt-1"><strong><?= lang('NNRegression.status.epoch') ?></strong> <span id="epoch">0</span></div>
                <div class="mt-1"><strong><?= lang('NNRegression.status.train_loss') ?></strong> <span id="trainLoss">-</span></div>
                <div class="mt-1"><strong><?= lang('NNRegression.status.val_loss') ?></strong> <span id="valLoss">-</span></div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-2 text-lg font-semibold"><?= lang('NNRegression.interpretation.title') ?></h5>
                <ul class="list-disc space-y-1 pl-5 text-sm text-slate-700">
                    <li><?= lang('NNRegression.interpretation.li1') ?></li>
                    <li><?= lang('NNRegression.interpretation.li2') ?></li>
                    <li><?= lang('NNRegression.interpretation.li3') ?></li>
                    <li><?= lang('NNRegression.interpretation.li4') ?></li>
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
