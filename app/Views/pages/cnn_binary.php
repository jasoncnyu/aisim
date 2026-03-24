<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<style {csp-style-nonce}>
    .cnn-spinner { display: none; }
    .cnn-spinner.active { display: flex; }
</style>

<div class="space-y-4">
    <div class="border-b border-slate-200 pb-3">
        <h2 class="text-2xl font-semibold"><?= lang('CNNBinary.title') ?></h2>
        <p class="text-slate-500"><?= lang('CNNBinary.subtitle') ?></p>
    </div>

    <div class="space-y-2">
        <section x-data="{ open: true }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="flex w-full items-center justify-between px-4 py-3 text-left font-medium" @click="open = !open">
                <span><?= lang('CNNBinary.accordion.1.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="space-y-2 px-4 pb-4 text-sm text-slate-700">
                <p><?= lang('CNNBinary.accordion.1.p1') ?></p>
                <p><?= lang('CNNBinary.accordion.1.p2') ?></p>
                <p><?= lang('CNNBinary.accordion.1.p3') ?></p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="flex w-full items-center justify-between px-4 py-3 text-left font-medium" @click="open = !open">
                <span><?= lang('CNNBinary.accordion.2.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="space-y-2 px-4 pb-4 text-sm text-slate-700">
                <p><?= lang('CNNBinary.accordion.2.p1') ?></p>
                <p class="text-center"><?= lang('CNNBinary.accordion.2.equation') ?></p>
                <p><?= lang('CNNBinary.accordion.2.p2') ?></p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="flex w-full items-center justify-between px-4 py-3 text-left font-medium" @click="open = !open">
                <span><?= lang('CNNBinary.accordion.3.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700">
                <ol class="list-decimal space-y-1 pl-5">
                    <li><?= lang('CNNBinary.accordion.3.step1') ?></li>
                    <li><?= lang('CNNBinary.accordion.3.step2') ?></li>
                    <li><?= lang('CNNBinary.accordion.3.step3') ?></li>
                    <li><?= lang('CNNBinary.accordion.3.step4') ?></li>
                </ol>
            </div>
        </section>
    </div>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-12">
        <div class="space-y-4 lg:col-span-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <div class="mb-3 flex flex-wrap items-center gap-2">
                    <button id="btn-demo" class="rounded-lg border border-emerald-300 bg-emerald-50 px-3 py-1.5 text-sm text-emerald-800"><?= lang('CNNBinary.controls.load_demo') ?></button>
                    <button id="btn-init" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('CNNBinary.controls.init_weights') ?></button>
                    <button id="btn-step" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('CNNBinary.controls.step') ?></button>
                    <button id="btn-run" class="rounded-lg bg-green-700 px-3 py-1.5 text-sm text-white"><?= lang('CNNBinary.controls.run') ?></button>
                    <button id="btn-stop" class="rounded-lg border border-amber-300 bg-amber-50 px-3 py-1.5 text-sm text-amber-900"><?= lang('CNNBinary.controls.stop') ?></button>
                    <button id="btn-reset" class="rounded-lg border border-rose-300 bg-rose-50 px-3 py-1.5 text-sm text-rose-900"><?= lang('CNNBinary.controls.reset') ?></button>

                    <label class="ml-auto text-sm"><?= lang('CNNBinary.controls.lr') ?>
                        <input id="lr" value="0.01" step="0.001" min="0.0001" type="number" class="ml-1 w-24 rounded-lg border border-slate-300 px-2 py-1">
                    </label>
                    <label class="text-sm"><?= lang('CNNBinary.controls.epochs') ?>
                        <input id="epochs" value="10" type="number" min="1" class="ml-1 w-20 rounded-lg border border-slate-300 px-2 py-1">
                    </label>
                    <label class="text-sm"><?= lang('CNNBinary.controls.batch') ?>
                        <input id="batch" value="2" type="number" min="1" class="ml-1 w-16 rounded-lg border border-slate-300 px-2 py-1">
                    </label>
                </div>

                <div class="mb-2 flex flex-wrap items-center gap-3 text-sm text-slate-700">
                    <div><?= lang('CNNBinary.metrics.dataset') ?> <span id="dsSize">0</span></div>
                    <div><?= lang('CNNBinary.metrics.epoch') ?> <span id="epoch">0</span></div>
                    <div><?= lang('CNNBinary.metrics.loss') ?> <span id="loss">-</span></div>
                    <div><?= lang('CNNBinary.metrics.accuracy') ?> <span id="acc">-</span></div>
                </div>
                <canvas id="lossChart" class="w-full rounded border border-slate-200 bg-white" style="height:130px;"></canvas>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-2 text-lg font-semibold"><?= lang('CNNBinary.training_images_title') ?></h5>
                <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
                    <div>
                        <label class="mb-1 block text-sm text-slate-700"><?= lang('CNNBinary.class1_label') ?></label>
                        <input id="class1Files" type="file" multiple accept="image/*" class="w-full rounded-lg border border-slate-300 px-2 py-1.5 text-sm">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm text-slate-700"><?= lang('CNNBinary.class2_label') ?></label>
                        <input id="class2Files" type="file" multiple accept="image/*" class="w-full rounded-lg border border-slate-300 px-2 py-1.5 text-sm">
                    </div>
                </div>
                <p class="mt-2 text-sm text-slate-500"><?= lang('CNNBinary.upload_hint') ?></p>

                <div class="relative mt-3 min-h-40 rounded border border-slate-200 bg-slate-50 p-2">
                    <div id="loadingSpinner" class="cnn-spinner absolute inset-0 z-10 items-center justify-center bg-white/70">
                        <div class="text-center">
                            <div class="mx-auto h-8 w-8 animate-spin rounded-full border-4 border-slate-200 border-t-slate-700"></div>
                            <p class="mt-2 text-xs text-slate-600"><?= lang('CNNBinary.loading_images') ?></p>
                        </div>
                    </div>
                    <div id="trainImages" class="flex flex-wrap gap-2"></div>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-2 text-lg font-semibold"><?= lang('CNNBinary.conv_filters_title') ?></h5>
                <div id="filterVis" class="flex flex-wrap gap-3"></div>
            </div>
        </div>

        <div class="space-y-4 lg:col-span-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-2 text-lg font-semibold"><?= lang('CNNBinary.prediction_title') ?></h5>
                <input id="testFile" type="file" accept="image/*" class="mb-2 w-full rounded-lg border border-slate-300 px-2 py-1.5 text-sm">
                <button id="btn-predict" class="rounded-lg bg-slate-900 px-3 py-1.5 text-sm text-white"><?= lang('CNNBinary.predict_button') ?></button>
                <div id="predResult" class="mt-3 text-base font-semibold">-</div>
                <ul id="predList" class="mt-2 list-disc pl-5 text-sm text-slate-700"></ul>
                <div id="inputPreview" class="mt-3"></div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-2 text-lg font-semibold"><?= lang('CNNBinary.feature_maps_title') ?></h5>
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
