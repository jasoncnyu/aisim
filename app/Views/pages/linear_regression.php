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
        <h2 class="text-2xl font-semibold"><?= lang('LinearRegression.title') ?></h2>
        <p class="text-slate-500"><?= lang('LinearRegression.subtitle') ?></p>
    </div>

    <div id="lrAccordion" class="space-y-2">
        <section x-data="{ open: true }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span><?= lang('LinearRegression.accordion.1.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p><?= lang('LinearRegression.accordion.1.p1') ?></p>
                <p class="text-center"><code><?= lang('LinearRegression.accordion.1.equation') ?></code></p>
                <p><?= lang('LinearRegression.accordion.1.p2') ?></p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span><?= lang('LinearRegression.accordion.2.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p><?= lang('LinearRegression.accordion.2.p1') ?></p>
                <p class="text-center"><?= lang('LinearRegression.accordion.2.equation') ?></p>
                <p><?= lang('LinearRegression.accordion.2.p2') ?></p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span><?= lang('LinearRegression.accordion.3.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <ul class="list-disc pl-5 space-y-1">
                    <li><strong>OLS</strong>: <?= lang('LinearRegression.accordion.3.ols') ?></li>
                    <li><strong>Batch GD</strong>: <?= lang('LinearRegression.accordion.3.gd') ?></li>
                    <li><strong>SGD</strong>: <?= lang('LinearRegression.accordion.3.sgd') ?></li>
                </ul>
                <p><?= lang('LinearRegression.accordion.3.p1') ?></p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span><?= lang('LinearRegression.accordion.4.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <ol class="list-decimal pl-5 space-y-1">
                    <li><?= lang('LinearRegression.accordion.4.step1') ?></li>
                    <li><?= lang('LinearRegression.accordion.4.step2') ?></li>
                    <li><?= lang('LinearRegression.accordion.4.step3') ?></li>
                    <li><?= lang('LinearRegression.accordion.4.step4') ?></li>
                </ol>
            </div>
        </section>
    </div>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-12">
        <div class="lg:col-span-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <div class="mb-2 flex flex-wrap items-center gap-2">
                    <button id="mode-add" class="active rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('LinearRegression.controls.add_point') ?></button>
                    <button id="mode-clear" class="rounded-lg border border-red-300 bg-red-50 px-3 py-1.5 text-sm text-red-700"><?= lang('LinearRegression.controls.clear_points') ?></button>
                    <button id="btn-demo" class="ml-auto rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('LinearRegression.controls.load_demo') ?></button>
                </div>
                <p class="mb-2 text-sm text-slate-500"><?= lang('LinearRegression.controls.hint') ?></p>

                <canvas id="plot" class="w-full rounded border border-slate-200 bg-white" style="height:420px;"></canvas>

                <div class="mt-3 grid grid-cols-1 gap-2 xl:grid-cols-2 xl:items-end">
                    <div>
                        <label class="mb-1 block text-sm font-medium"><?= lang('LinearRegression.controls.method') ?></label>
                        <select id="fitMethod" class="w-full rounded-lg border border-slate-300 px-2 py-1.5 text-sm xl:max-w-xs">
                            <option value="ols"><?= lang('LinearRegression.controls.method_ols') ?></option>
                            <option value="gd"><?= lang('LinearRegression.controls.method_gd') ?></option>
                            <option value="sgd"><?= lang('LinearRegression.controls.method_sgd') ?></option>
                        </select>
                    </div>

                    <div id="learningParams" class="flex flex-wrap items-end gap-2">
                        <div>
                            <label class="mb-1 block text-sm font-medium"><?= lang('LinearRegression.controls.learning_rate') ?></label>
                            <input id="lr" type="number" value="0.01" step="0.005" class="w-28 rounded-lg border border-slate-300 px-2 py-1.5 text-sm">
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-medium"><?= lang('LinearRegression.controls.epochs') ?></label>
                            <input id="epochs" type="number" value="50" min="1" class="w-28 rounded-lg border border-slate-300 px-2 py-1.5 text-sm">
                        </div>
                    </div>
                </div>

                <div class="mt-3 flex flex-wrap justify-end gap-2">
                    <button id="btn-step" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('LinearRegression.controls.step_train') ?></button>
                    <button id="btn-run" class="relative overflow-hidden rounded-lg bg-green-700 px-3 py-1.5 text-sm text-white" style="width:120px;">
                        <span class="btn-label"><?= lang('LinearRegression.controls.auto_train') ?></span>
                        <div class="progress-bg"></div>
                    </button>
                    <button id="mode-test" class="inline-flex items-center rounded-lg border border-slate-300 px-3 py-1.5 text-sm">
                        <span class="label"><?= lang('LinearRegression.controls.test_mode') ?></span>
                        <span class="test-spinner ms-2" aria-hidden="true"><span class="dot"></span><span class="dot"></span><span class="dot"></span></span>
                    </button>
                </div>

                <hr class="my-4 border-slate-200">
                <h6 class="mb-2 font-semibold"><?= lang('LinearRegression.loss_title') ?></h6>
                <canvas id="lossChart" class="w-full rounded border border-slate-200 bg-white" height="90"></canvas>
            </div>
        </div>

        <div class="space-y-4 lg:col-span-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-3 text-lg font-semibold"><?= lang('LinearRegression.model.title') ?></h5>
                <div><strong><?= lang('LinearRegression.model.points') ?></strong> <span id="countPts">0</span></div>
                <div class="mt-2"><strong><?= lang('LinearRegression.model.slope') ?></strong> <span id="slope">-</span></div>
                <div class="mt-2"><strong><?= lang('LinearRegression.model.intercept') ?></strong> <span id="intercept">-</span></div>
                <div class="mt-2" id="r2Row"><strong><?= lang('LinearRegression.model.r2') ?></strong> <span id="r2">-</span></div>
                <div class="mt-2" id="lossRow"><strong><?= lang('LinearRegression.model.last_loss') ?></strong> <span id="lastLoss">-</span></div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-3 text-lg font-semibold"><?= lang('LinearRegression.notes.title') ?></h5>
                <div id="ex-ols">
                    <h6 class="font-medium"><?= lang('LinearRegression.notes.ols.title') ?></h6>
                    <p class="text-sm text-slate-600 mb-2"><?= lang('LinearRegression.notes.ols.desc') ?></p>
                    <p class="text-sm text-slate-700"><?= lang('LinearRegression.notes.ols.formula') ?></p>
                </div>
                <div id="ex-gd" style="display:none">
                    <h6 class="font-medium"><?= lang('LinearRegression.notes.gd.title') ?></h6>
                    <p class="text-sm text-slate-600 mb-2"><?= lang('LinearRegression.notes.gd.desc') ?></p>
                    <p class="text-sm text-slate-700"><?= lang('LinearRegression.notes.gd.formula') ?></p>
                </div>
                <div id="ex-sgd" style="display:none">
                    <h6 class="font-medium"><?= lang('LinearRegression.notes.sgd.title') ?></h6>
                    <p class="text-sm text-slate-600 mb-2"><?= lang('LinearRegression.notes.sgd.desc') ?></p>
                    <p class="text-sm text-slate-700"><?= lang('LinearRegression.notes.sgd.formula') ?></p>
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
