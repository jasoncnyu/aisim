<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-4">
    <div class="border-b border-slate-200 pb-3">
        <h2 class="text-2xl font-semibold"><?= lang('Pruning.title') ?></h2>
        <p class="text-slate-500"><?= lang('Pruning.subtitle') ?></p>
    </div>

    <div class="space-y-2">
        <section x-data="{ open: true }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="flex w-full items-center justify-between px-4 py-3 text-left font-medium" @click="open = !open">
                <span><?= lang('Pruning.accordion.1.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p><?= lang('Pruning.accordion.1.p1') ?></p>
                <p><?= lang('Pruning.accordion.1.p2') ?></p>
            </div>
        </section>
        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="flex w-full items-center justify-between px-4 py-3 text-left font-medium" @click="open = !open">
                <span><?= lang('Pruning.accordion.2.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p><strong><?= lang('Pruning.accordion.2.li1_label') ?>:</strong> <?= lang('Pruning.accordion.2.li1') ?></p>
                <p><strong><?= lang('Pruning.accordion.2.li2_label') ?>:</strong> <?= lang('Pruning.accordion.2.li2') ?></p>
                <p><strong><?= lang('Pruning.accordion.2.li3_label') ?>:</strong> <?= lang('Pruning.accordion.2.li3') ?></p>
                <p><strong><?= lang('Pruning.accordion.2.li4_label') ?>:</strong> <?= lang('Pruning.accordion.2.li4') ?></p>
                <p><strong><?= lang('Pruning.accordion.2.li5_label') ?>:</strong> <?= lang('Pruning.accordion.2.li5') ?></p>
            </div>
        </section>
        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="flex w-full items-center justify-between px-4 py-3 text-left font-medium" @click="open = !open">
                <span><?= lang('Pruning.accordion.3.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <ol class="list-decimal space-y-1 pl-5">
                    <li><?= lang('Pruning.accordion.3.step1') ?></li>
                    <li><?= lang('Pruning.accordion.3.step2') ?></li>
                    <li><?= lang('Pruning.accordion.3.step3') ?></li>
                </ol>
            </div>
        </section>
    </div>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-12">
        <div class="space-y-4 lg:col-span-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm space-y-3">
                <h3 class="text-lg font-semibold"><?= lang('Pruning.generator.title') ?></h3>
                <div class="grid grid-cols-2 gap-3">
                    <label class="text-sm"><?= lang('Pruning.generator.rows') ?>
                        <input id="rows" type="number" min="1" max="256" value="6" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">
                    </label>
                    <label class="text-sm"><?= lang('Pruning.generator.cols') ?>
                        <input id="cols" type="number" min="1" max="256" value="12" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">
                    </label>
                </div>
                <div>
                    <label class="text-sm"><?= lang('Pruning.generator.density') ?></label>
                    <input id="density" type="range" min="50" max="100" value="100" class="mt-2 w-full">
                    <div class="text-xs text-slate-500" style="position:absolute; right:0px"><?= lang('Pruning.generator.current') ?> <span id="densityVal">100%</span></div>
                </div>
                <label class="text-sm"><?= lang('Pruning.generator.value_mode') ?>
                    <select id="valMode" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">
                        <option value="randInt"><?= lang('Pruning.generator.rand_int') ?></option>
                        <option value="weighted"><?= lang('Pruning.generator.weighted') ?></option>
                    </select>
                </label>
                <div class="flex flex-wrap gap-2">
                    <button id="genRandom" class="rounded-lg bg-slate-900 px-3 py-1.5 text-sm text-white"><?= lang('Pruning.generator.generate') ?></button>
                    <button id="resetMatrix" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('Pruning.generator.reset') ?></button>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm space-y-3">
                <h3 class="text-lg font-semibold"><?= lang('Pruning.settings.title') ?></h3>
                <label class="text-sm"><?= lang('Pruning.settings.strategy') ?>
                    <select id="pruneMode" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">
                        <option value="threshold"><?= lang('Pruning.settings.threshold') ?></option>
                        <option value="global_topk"><?= lang('Pruning.settings.global_topk') ?></option>
                        <option value="target_sparsity"><?= lang('Pruning.settings.target_sparsity') ?></option>
                        <option value="row_topk"><?= lang('Pruning.settings.row_topk') ?></option>
                        <option value="col_topk"><?= lang('Pruning.settings.col_topk') ?></option>
                        <option value="random"><?= lang('Pruning.settings.random') ?></option>
                        <option value="iterative"><?= lang('Pruning.settings.iterative') ?></option>
                    </select>
                </label>

                <div id="param_threshold" class="space-y-1">
                    <label class="text-sm"><?= lang('Pruning.settings.tau') ?>
                        <input id="tau" type="number" step="0.001" value="0.15" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">
                    </label>
                </div>

                <div id="param_topk" class="space-y-1 hidden">
                    <label class="text-sm"><?= lang('Pruning.settings.k_keep') ?>
                        <input id="topk" type="number" min="0" value="20" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">
                    </label>
                </div>

                <div id="param_target" class="space-y-1 hidden">
                    <label class="text-sm"><?= lang('Pruning.settings.target') ?>
                        <input id="targetSparsity" type="number" min="0" max="99" value="80" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">
                    </label>
                </div>

                <div id="param_rowk" class="space-y-1 hidden">
                    <label class="text-sm"><?= lang('Pruning.settings.row_topk_label') ?>
                        <input id="rowK" type="number" min="0" value="2" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">
                    </label>
                </div>

                <div id="param_colk" class="space-y-1 hidden">
                    <label class="text-sm"><?= lang('Pruning.settings.col_topk_label') ?>
                        <input id="colK" type="number" min="0" value="2" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">
                    </label>
                </div>

                <div id="param_random" class="space-y-1 hidden">
                    <label class="text-sm"><?= lang('Pruning.settings.random_ratio') ?>
                        <input id="randRatio" type="number" min="0" max="100" value="50" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">
                    </label>
                </div>

                <div id="param_iter" class="space-y-2 hidden">
                    <label class="text-sm"><?= lang('Pruning.settings.steps') ?>
                        <input id="iterSteps" type="number" min="1" max="50" value="4" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">
                    </label>
                    <label class="text-sm"><?= lang('Pruning.settings.final_sparsity') ?>
                        <input id="iterFinalSparsity" type="number" min="0" max="99" value="90" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">
                    </label>
                    <label class="text-sm"><?= lang('Pruning.settings.schedule') ?>
                        <select id="iterSchedule" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">
                            <option value="linear"><?= lang('Pruning.settings.schedule_linear') ?></option>
                            <option value="poly3"><?= lang('Pruning.settings.schedule_poly3') ?></option>
                        </select>
                    </label>
                </div>

                <div class="flex flex-wrap gap-2">
                    <button id="applyPrune" class="rounded-lg bg-emerald-700 px-3 py-1.5 text-sm text-white"><?= lang('Pruning.settings.apply') ?></button>
                    <button id="resetPrune" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('Pruning.settings.reset') ?></button>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm space-y-1 text-sm">
                <h3 class="text-lg font-semibold"><?= lang('Pruning.summary.title') ?></h3>
                <div><strong><?= lang('Pruning.summary.dimensions') ?></strong> <span id="statDim">-</span></div>
                <div><strong><?= lang('Pruning.summary.nnz') ?></strong> <span id="statNNZ">-</span></div>
                <div><strong><?= lang('Pruning.summary.sparsity') ?></strong> <span id="statSparsity">-</span></div>
                <div><strong><?= lang('Pruning.summary.dense_size') ?></strong> <span id="statDenseBytes">-</span> <?= lang('Pruning.summary.bytes') ?></div>
                <div><strong><?= lang('Pruning.summary.mask_size') ?></strong> <span id="statMaskBits">-</span> <?= lang('Pruning.summary.bits') ?></div>
                <div><strong><?= lang('Pruning.summary.last_strategy') ?></strong> <span id="statStrategy">-</span></div>
            </div>
        </div>

        <div class="space-y-4 lg:col-span-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h3 class="text-lg font-semibold"><?= lang('Pruning.matrix.title') ?></h3>
                <div id="matrixContainer" class="mt-2 max-h-60 overflow-auto rounded border border-slate-200 bg-white p-2"></div>
                <p class="mt-2 text-xs text-slate-500"><?= lang('Pruning.matrix.hint') ?></p>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                    <h4 class="text-sm font-semibold"><?= lang('Pruning.pruned.title') ?></h4>
                    <div id="prunedContainer" class="mt-2 max-h-56 overflow-auto rounded border border-slate-200 bg-white p-2"></div>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                    <h4 class="text-sm font-semibold"><?= lang('Pruning.mask.title') ?></h4>
                    <div id="maskContainer" class="mt-2 max-h-56 overflow-auto rounded border border-slate-200 bg-white p-2"></div>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <div class="flex flex-wrap items-center justify-between gap-2">
                    <h4 class="text-sm font-semibold"><?= lang('Pruning.json.title') ?></h4>
                    <div class="flex flex-wrap gap-2">
                        <button id="togglePretty" type="button" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('Pruning.json.pretty') ?></button>
                        <button id="downloadJSON" type="button" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('Pruning.json.download') ?></button>
                    </div>
                </div>
                <pre id="jsonOut" class="mt-2 max-h-72 overflow-auto rounded-lg bg-slate-950/5 p-3 text-xs text-slate-700"></pre>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h4 class="text-sm font-semibold"><?= lang('Pruning.notes.title') ?></h4>
                <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-slate-700">
                    <li><?= lang('Pruning.notes.li1') ?></li>
                    <li><?= lang('Pruning.notes.li2') ?></li>
                    <li><?= lang('Pruning.notes.li3') ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="/assets/js/pruning.js"></script>
<?= $this->endSection() ?>
