<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-4">
    <div class="border-b border-slate-200 pb-3">
        <h2 class="text-2xl font-semibold"><?= lang('KNN.title') ?></h2>
        <p class="text-slate-500"><?= lang('KNN.subtitle') ?></p>
    </div>

    <div class="space-y-2">
        <section x-data="{ open: true }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span><?= lang('KNN.accordion.1.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p><?= lang('KNN.accordion.1.p1') ?></p>
                <p><?= lang('KNN.accordion.1.p2') ?></p>
                <p class="text-center"><?= lang('KNN.accordion.1.equation') ?></p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span><?= lang('KNN.accordion.2.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <ul class="list-disc pl-5 space-y-1">
                    <li><?= lang('KNN.accordion.2.li1') ?></li>
                    <li><?= lang('KNN.accordion.2.li2') ?></li>
                    <li><?= lang('KNN.accordion.2.li3') ?></li>
                </ul>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span><?= lang('KNN.accordion.3.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p><?= lang('KNN.accordion.3.p1') ?></p>
                <p><?= lang('KNN.accordion.3.p2') ?></p>
                <p><?= lang('KNN.accordion.3.p3') ?></p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span><?= lang('KNN.accordion.4.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700">
                <ol class="list-decimal pl-5 space-y-1">
                    <li><?= lang('KNN.accordion.4.step1') ?></li>
                    <li><?= lang('KNN.accordion.4.step2') ?></li>
                    <li><?= lang('KNN.accordion.4.step3') ?></li>
                    <li><?= lang('KNN.accordion.4.step4') ?></li>
                </ol>
            </div>
        </section>
    </div>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-12">
        <div class="lg:col-span-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <canvas id="knnCanvas" class="w-full rounded border border-slate-200 bg-white" style="height:560px;"></canvas>

                <div class="mt-3 flex flex-wrap items-center gap-2">
                    <button id="btn-classA" class="rounded-lg border border-cyan-300 bg-cyan-100 px-3 py-1.5 text-sm text-cyan-900"><?= lang('KNN.controls.class_a') ?></button>
                    <button id="btn-classB" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('KNN.controls.class_b') ?></button>
                    <button id="btn-testmode" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('KNN.controls.test_mode') ?></button>

                    <label class="text-sm"><?= lang('KNN.controls.k_label') ?>
                        <input id="kVal" type="number" value="5" min="1" max="99" class="ml-1 w-20 rounded-lg border border-slate-300 px-2 py-1">
                    </label>
                    <label class="inline-flex items-center gap-2 text-sm">
                        <input type="checkbox" id="weighted" class="h-4 w-4 rounded border-slate-300">
                        <span><?= lang('KNN.controls.weighted') ?></span>
                    </label>
                    <label class="text-sm"><?= lang('KNN.controls.region_density') ?>
                        <input id="res" type="number" value="120" min="40" max="300" class="ml-1 w-24 rounded-lg border border-slate-300 px-2 py-1">
                    </label>

                    <select id="demoType" class="ml-auto rounded-lg border border-slate-300 px-2 py-1.5 text-sm">
                        <option value="vertical"><?= lang('KNN.controls.demo.vertical') ?></option>
                        <option value="xor"><?= lang('KNN.controls.demo.xor') ?></option>
                        <option value="concentric"><?= lang('KNN.controls.demo.concentric') ?></option>
                        <option value="overlap"><?= lang('KNN.controls.demo.overlap') ?></option>
                        <option value="random"><?= lang('KNN.controls.demo.random') ?></option>
                    </select>
                    <button id="btn-demo" class="rounded-lg border border-emerald-300 bg-emerald-50 px-3 py-1.5 text-sm text-emerald-800"><?= lang('KNN.controls.load_demo') ?></button>
                    <button id="btn-refresh" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('KNN.controls.refresh') ?></button>
                    <button id="btn-clear" class="rounded-lg border border-rose-300 bg-rose-50 px-3 py-1.5 text-sm text-rose-900"><?= lang('KNN.controls.clear') ?></button>
                </div>

                <p class="mt-2 text-sm text-slate-500"><?= lang('KNN.controls.hint') ?></p>
            </div>
        </div>

        <div class="space-y-4 lg:col-span-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-2 text-lg font-semibold"><?= lang('KNN.model.title') ?></h5>
                <div><strong><?= lang('KNN.model.points') ?></strong> <span id="countA">0</span> A | <span id="countB">0</span> B</div>
                <div class="mt-1"><strong><?= lang('KNN.model.last_prob') ?></strong> <span id="lastProb">-</span></div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-2 text-lg font-semibold"><?= lang('KNN.neighbors_title') ?></h5>
                <pre id="neighbors" class="max-h-80 overflow-auto rounded border border-slate-200 bg-slate-50 p-3 text-xs text-slate-700"></pre>
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
<script src="/assets/js/knn.js"></script>
<?= $this->endSection() ?>
