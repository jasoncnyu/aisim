<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-4">
    <div class="border-b border-slate-200 pb-3">
        <h2 class="text-2xl font-semibold"><?= lang('DecisionTree.title') ?></h2>
        <p class="text-slate-500"><?= lang('DecisionTree.subtitle') ?></p>
    </div>

    <div class="space-y-2">
        <section x-data="{ open: true }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span><?= lang('DecisionTree.accordion.1.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p><?= lang('DecisionTree.accordion.1.p1') ?></p>
                <p><?= lang('DecisionTree.accordion.1.p2') ?></p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span><?= lang('DecisionTree.accordion.2.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p><?= lang('DecisionTree.accordion.2.p1') ?></p>
                <p class="text-center"><?= lang('DecisionTree.accordion.2.equation') ?></p>
                <p><?= lang('DecisionTree.accordion.2.p2') ?></p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span><?= lang('DecisionTree.accordion.3.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <ul class="list-disc pl-5 space-y-1">
                    <li><?= lang('DecisionTree.accordion.3.li1') ?></li>
                    <li><?= lang('DecisionTree.accordion.3.li2') ?></li>
                    <li><?= lang('DecisionTree.accordion.3.li3') ?></li>
                </ul>
                <p><?= lang('DecisionTree.accordion.3.p1') ?></p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span><?= lang('DecisionTree.accordion.4.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700">
                <ol class="list-decimal pl-5 space-y-1">
                    <li><?= lang('DecisionTree.accordion.4.step1') ?></li>
                    <li><?= lang('DecisionTree.accordion.4.step2') ?></li>
                    <li><?= lang('DecisionTree.accordion.4.step3') ?></li>
                    <li><?= lang('DecisionTree.accordion.4.step4') ?></li>
                </ol>
            </div>
        </section>
    </div>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-12">
        <div class="lg:col-span-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <canvas id="canvas" class="w-full rounded border border-slate-200 bg-white" style="height:440px;"></canvas>

                <div class="mt-3 flex flex-wrap items-center gap-2">
                    <button id="btn-classA" class="rounded-lg border border-cyan-300 bg-cyan-100 px-3 py-1.5 text-sm text-cyan-900"><?= lang('DecisionTree.controls.class_a') ?></button>
                    <button id="btn-classB" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('DecisionTree.controls.class_b') ?></button>
                    <button id="btn-train" class="rounded-lg bg-slate-900 px-3 py-1.5 text-sm text-white"><?= lang('DecisionTree.controls.train') ?></button>
                    <button id="btn-clear" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('DecisionTree.controls.clear') ?></button>

                    <select id="demoType" class="rounded-lg border border-slate-300 px-2 py-1.5 text-sm">
                        <option value="random_clusters"><?= lang('DecisionTree.controls.demo.random_clusters') ?></option>
                        <option value="concentric"><?= lang('DecisionTree.controls.demo.concentric') ?></option>
                        <option value="xor"><?= lang('DecisionTree.controls.demo.xor') ?></option>
                        <option value="overlap"><?= lang('DecisionTree.controls.demo.overlap') ?></option>
                    </select>
                    <button id="btn-demo-load" class="rounded-lg border border-emerald-300 bg-emerald-50 px-3 py-1.5 text-sm text-emerald-800"><?= lang('DecisionTree.controls.load_demo') ?></button>

                    <label class="text-sm"><?= lang('DecisionTree.controls.max_depth') ?>
                        <input id="maxDepth" type="number" value="4" min="1" max="12" class="ml-1 w-20 rounded-lg border border-slate-300 px-2 py-1">
                    </label>
                    <label class="text-sm"><?= lang('DecisionTree.controls.min_samples') ?>
                        <input id="minSamples" type="number" value="5" min="1" class="ml-1 w-20 rounded-lg border border-slate-300 px-2 py-1">
                    </label>
                    <label class="inline-flex items-center gap-2 text-sm">
                        <input type="checkbox" id="showRegions" checked class="h-4 w-4 rounded border-slate-300">
                        <span><?= lang('DecisionTree.controls.show_regions') ?></span>
                    </label>
                </div>

                <p class="mt-2 text-sm text-slate-500"><?= lang('DecisionTree.controls.hint') ?></p>
            </div>
        </div>

        <div class="space-y-4 lg:col-span-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-2 text-lg font-semibold"><?= lang('DecisionTree.model.title') ?></h5>
                <div><strong><?= lang('DecisionTree.model.points') ?></strong> <span id="countA">0</span> A | <span id="countB">0</span> B</div>
                <div class="mt-2"><strong><?= lang('DecisionTree.model.last_split') ?></strong> <span id="score">-</span></div>
                <div class="mt-2">
                    <label class="mb-1 block text-xs uppercase tracking-wide text-slate-500"><?= lang('DecisionTree.model.points_a') ?></label>
                    <input id="pointsAList" class="w-full rounded border border-slate-300 px-2 py-1 text-xs font-mono" readonly>
                </div>
                <div class="mt-2">
                    <label class="mb-1 block text-xs uppercase tracking-wide text-slate-500"><?= lang('DecisionTree.model.points_b') ?></label>
                    <input id="pointsBList" class="w-full rounded border border-slate-300 px-2 py-1 text-xs font-mono" readonly>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-2 text-lg font-semibold"><?= lang('DecisionTree.tree_title') ?></h5>
                <pre id="treeText" class="max-h-64 overflow-auto rounded border border-slate-200 bg-slate-50 p-3 text-xs text-slate-700"></pre>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-2 text-lg font-semibold"><?= lang('DecisionTree.calc_title') ?></h5>
                <pre id="calcLog" class="max-h-64 overflow-auto rounded border border-slate-200 bg-slate-50 p-3 text-xs text-slate-700"></pre>
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
<script src="/assets/js/decision_tree.js"></script>
<?= $this->endSection() ?>
