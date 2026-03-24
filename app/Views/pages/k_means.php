<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-4">
    <div class="border-b border-slate-200 pb-3">
        <h2 class="text-2xl font-semibold"><?= lang('KMeans.title') ?></h2>
        <p class="text-slate-500"><?= lang('KMeans.subtitle') ?></p>
    </div>

    <div class="space-y-2">
        <section x-data="{ open: true }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span><?= lang('KMeans.accordion.1.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p><?= lang('KMeans.accordion.1.p1') ?></p>
                <p class="text-center"><?= lang('KMeans.accordion.1.equation') ?></p>
                <p><?= lang('KMeans.accordion.1.p2') ?></p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span><?= lang('KMeans.accordion.2.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p><?= lang('KMeans.accordion.2.p1') ?></p>
                <p class="text-center"><?= lang('KMeans.accordion.2.equation1') ?></p>
                <p class="text-center"><?= lang('KMeans.accordion.2.equation2') ?></p>
                <p><?= lang('KMeans.accordion.2.p2') ?></p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span><?= lang('KMeans.accordion.3.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p><?= lang('KMeans.accordion.3.p1') ?></p>
                <p><?= lang('KMeans.accordion.3.p2') ?></p>
                <p><?= lang('KMeans.accordion.3.p3') ?></p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span><?= lang('KMeans.accordion.4.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700">
                <ol class="list-decimal pl-5 space-y-1">
                    <li><?= lang('KMeans.accordion.4.step1') ?></li>
                    <li><?= lang('KMeans.accordion.4.step2') ?></li>
                    <li><?= lang('KMeans.accordion.4.step3') ?></li>
                    <li><?= lang('KMeans.accordion.4.step4') ?></li>
                </ol>
            </div>
        </section>
    </div>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-12">
        <div class="lg:col-span-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <canvas id="kmeansCanvas" class="w-full rounded border border-slate-200 bg-white" style="height:520px;"></canvas>

                <div class="mt-3 flex flex-wrap items-center gap-2">
                    <label class="text-sm"><?= lang('KMeans.controls.k_label') ?>
                        <input id="kVal" type="number" value="3" min="1" max="12" class="ml-1 w-20 rounded-lg border border-slate-300 px-2 py-1">
                    </label>
                    <label class="text-sm"><?= lang('KMeans.controls.init_label') ?>
                        <select id="initMethod" class="ml-1 rounded-lg border border-slate-300 px-2 py-1">
                            <option value="random"><?= lang('KMeans.controls.init_random') ?></option>
                            <option value="kmeans++"><?= lang('KMeans.controls.init_plus') ?></option>
                        </select>
                    </label>
                    <label class="text-sm"><?= lang('KMeans.controls.region_density') ?>
                        <input id="res" type="number" value="120" min="40" max="300" class="ml-1 w-24 rounded-lg border border-slate-300 px-2 py-1">
                    </label>

                    <div class="ml-auto flex flex-wrap gap-2">
                        <button id="btn-demo" class="rounded-lg border border-emerald-300 bg-emerald-50 px-3 py-1.5 text-sm text-emerald-800"><?= lang('KMeans.controls.load_demo') ?></button>
                        <button id="btn-init" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('KMeans.controls.init_centroids') ?></button>
                        <button id="btn-step" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('KMeans.controls.step') ?></button>
                        <button id="btn-run" class="rounded-lg bg-green-700 px-3 py-1.5 text-sm text-white"><?= lang('KMeans.controls.run') ?></button>
                        <button id="btn-stop" class="rounded-lg border border-amber-300 bg-amber-50 px-3 py-1.5 text-sm text-amber-900"><?= lang('KMeans.controls.stop') ?></button>
                        <button id="btn-clear" class="rounded-lg border border-rose-300 bg-rose-50 px-3 py-1.5 text-sm text-rose-900"><?= lang('KMeans.controls.clear') ?></button>
                    </div>
                </div>

                <p class="mt-2 text-sm text-slate-500"><?= lang('KMeans.controls.hint') ?></p>
            </div>
        </div>

        <div class="space-y-4 lg:col-span-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-2 text-lg font-semibold"><?= lang('KMeans.status.title') ?></h5>
                <div><strong><?= lang('KMeans.status.points') ?></strong> <span id="countPts">0</span></div>
                <div class="mt-1"><strong><?= lang('KMeans.status.k') ?></strong> <span id="curK">3</span></div>
                <div class="mt-1"><strong><?= lang('KMeans.status.iteration') ?></strong> <span id="iter">0</span></div>
                <div class="mt-1"><strong><?= lang('KMeans.status.inertia') ?></strong> <span id="inertia">-</span></div>
                <div class="mt-1"><strong><?= lang('KMeans.status.shift') ?></strong> <span id="shift">-</span></div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-2 text-lg font-semibold"><?= lang('KMeans.inertia_title') ?></h5>
                <canvas id="inertiaChart" class="w-full rounded border border-slate-200 bg-white" style="height:180px;"></canvas>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-2 text-lg font-semibold"><?= lang('KMeans.summary_title') ?></h5>
                <pre id="clusterText" class="max-h-64 overflow-auto rounded border border-slate-200 bg-slate-50 p-3 text-xs text-slate-700"></pre>
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
<script src="/assets/js/k_means.js"></script>
<?= $this->endSection() ?>
