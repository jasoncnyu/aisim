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
        <h2 class="text-2xl font-semibold"><?= lang('LogisticRegression.title') ?></h2>
        <p class="text-slate-500"><?= lang('LogisticRegression.subtitle') ?></p>
    </div>

    <div class="space-y-2">
        <section x-data="{ open: true }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span><?= lang('LogisticRegression.accordion.1.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p><?= lang('LogisticRegression.accordion.1.p1') ?></p>
                <p class="text-center"><?= lang('LogisticRegression.accordion.1.equation') ?></p>
                <p><?= lang('LogisticRegression.accordion.1.p2') ?></p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span><?= lang('LogisticRegression.accordion.2.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p><?= lang('LogisticRegression.accordion.2.p1') ?></p>
                <p class="text-center"><?= lang('LogisticRegression.accordion.2.equation') ?></p>
                <p><?= lang('LogisticRegression.accordion.2.p2') ?></p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span><?= lang('LogisticRegression.accordion.3.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p><?= lang('LogisticRegression.accordion.3.p1') ?></p>
                <p class="text-center"><?= lang('LogisticRegression.accordion.3.equation1') ?></p>
                <p class="text-center"><?= lang('LogisticRegression.accordion.3.equation2') ?></p>
                <p><?= lang('LogisticRegression.accordion.3.p2') ?></p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span><?= lang('LogisticRegression.accordion.4.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700">
                <ol class="list-decimal pl-5 space-y-1">
                    <li><?= lang('LogisticRegression.accordion.4.step1') ?></li>
                    <li><?= lang('LogisticRegression.accordion.4.step2') ?></li>
                    <li><?= lang('LogisticRegression.accordion.4.step3') ?></li>
                    <li><?= lang('LogisticRegression.accordion.4.step4') ?></li>
                </ol>
            </div>
        </section>
    </div>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-12">
        <div class="lg:col-span-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <div class="mb-2 flex flex-wrap items-center gap-2">
                    <button id="btn-random" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('LogisticRegression.controls.generate_data') ?></button>
                    <button id="btn-run" class="rounded-lg bg-green-700 px-3 py-1.5 text-sm text-white"><?= lang('LogisticRegression.controls.auto_train') ?></button>
                    <button id="btn-step" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('LogisticRegression.controls.step') ?></button>
                    <button id="btn-test" class="inline-flex items-center rounded-lg border border-slate-300 px-3 py-1.5 text-sm">
                        <span class="label"><?= lang('LogisticRegression.controls.test_mode') ?></span>
                        <span class="test-spinner ms-2" aria-hidden="true"><span class="dot"></span><span class="dot"></span><span class="dot"></span></span>
                    </button>
                    <button id="btn-reset" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('LogisticRegression.controls.reset') ?></button>
                    <label class="ml-auto text-sm"><?= lang('LogisticRegression.controls.learning_rate') ?>
                        <input type="number" id="lr" value="0.1" step="0.01" min="0.001" class="ml-1 w-24 rounded-lg border border-slate-300 px-2 py-1">
                    </label>
                </div>

                <p class="mb-2 text-sm text-slate-500"><?= lang('LogisticRegression.controls.hint') ?></p>
                <canvas id="cv" class="w-full rounded border border-slate-200 bg-white" style="height:420px;"></canvas>

                <div class="mt-3 text-sm text-slate-700">
                    <div id="status"></div>
                    <div id="equation" class="font-medium"></div>
                </div>
            </div>
        </div>

        <div class="space-y-4 lg:col-span-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-2 text-lg font-semibold"><?= lang('LogisticRegression.loss_title') ?></h5>
                <canvas id="lossChart" class="w-full rounded border border-slate-200 bg-white" style="height:180px;"></canvas>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-2 text-lg font-semibold"><?= lang('LogisticRegression.interpretation.title') ?></h5>
                <ul class="list-disc pl-5 text-sm text-slate-700 space-y-1">
                    <li><?= lang('LogisticRegression.interpretation.li1') ?></li>
                    <li><?= lang('LogisticRegression.interpretation.li2') ?></li>
                    <li><?= lang('LogisticRegression.interpretation.li3') ?></li>
                    <li><?= lang('LogisticRegression.interpretation.li4') ?></li>
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
