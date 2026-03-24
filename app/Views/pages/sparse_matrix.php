<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-4">
    <div class="border-b border-slate-200 pb-3">
        <h2 class="text-2xl font-semibold"><?= lang('SparseMatrix.title') ?></h2>
        <p class="text-slate-500"><?= lang('SparseMatrix.subtitle') ?></p>
    </div>

    <div class="space-y-2">
        <section x-data="{ open: true }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="flex w-full items-center justify-between px-4 py-3 text-left font-medium" @click="open = !open">
                <span><?= lang('SparseMatrix.accordion.1.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p><?= lang('SparseMatrix.accordion.1.p1') ?></p>
                <p><?= lang('SparseMatrix.accordion.1.p2') ?></p>
            </div>
        </section>
        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="flex w-full items-center justify-between px-4 py-3 text-left font-medium" @click="open = !open">
                <span><?= lang('SparseMatrix.accordion.2.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p><strong><?= lang('SparseMatrix.accordion.2.li1_label') ?>:</strong> <?= lang('SparseMatrix.accordion.2.li1') ?></p>
                <p><strong><?= lang('SparseMatrix.accordion.2.li2_label') ?>:</strong> <?= lang('SparseMatrix.accordion.2.li2') ?></p>
                <p><strong><?= lang('SparseMatrix.accordion.2.li3_label') ?>:</strong> <?= lang('SparseMatrix.accordion.2.li3') ?></p>
                <p><strong><?= lang('SparseMatrix.accordion.2.li4_label') ?>:</strong> <?= lang('SparseMatrix.accordion.2.li4') ?></p>
            </div>
        </section>
        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="flex w-full items-center justify-between px-4 py-3 text-left font-medium" @click="open = !open">
                <span><?= lang('SparseMatrix.accordion.3.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <ol class="list-decimal space-y-1 pl-5">
                    <li><?= lang('SparseMatrix.accordion.3.step1') ?></li>
                    <li><?= lang('SparseMatrix.accordion.3.step2') ?></li>
                    <li><?= lang('SparseMatrix.accordion.3.step3') ?></li>
                </ol>
            </div>
        </section>
    </div>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-12">
        <div class="space-y-4 lg:col-span-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm space-y-3">
                <h3 class="text-lg font-semibold"><?= lang('SparseMatrix.generator.title') ?></h3>
                <div class="grid grid-cols-2 gap-3">
                    <label class="text-sm"><?= lang('SparseMatrix.generator.rows') ?>
                        <input id="rows" type="number" min="1" max="200" value="6" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">
                    </label>
                    <label class="text-sm"><?= lang('SparseMatrix.generator.cols') ?>
                        <input id="cols" type="number" min="1" max="200" value="12" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">
                    </label>
                </div>
                <div>
                    <label class="text-sm"><?= lang('SparseMatrix.generator.density') ?></label>
                    <input id="density" type="range" min="0" max="50" value="10" class="mt-2 w-full">
                    <div class="text-xs text-slate-500"><?= lang('SparseMatrix.generator.current') ?> <span id="densityVal">10%</span></div>
                </div>
                <label class="text-sm"><?= lang('SparseMatrix.generator.value_mode') ?>
                    <select id="valMode" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">
                        <option value="randInt"><?= lang('SparseMatrix.generator.rand_int') ?></option>
                        <option value="weighted"><?= lang('SparseMatrix.generator.weighted') ?></option>
                    </select>
                </label>
                <div class="flex flex-wrap gap-2">
                    <button id="genRandom" class="rounded-lg bg-slate-900 px-3 py-1.5 text-sm text-white"><?= lang('SparseMatrix.generator.generate') ?></button>
                    <button id="resetMatrix" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('SparseMatrix.generator.reset') ?></button>
                </div>

            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm space-y-3">
                <h3 class="text-lg font-semibold"><?= lang('SparseMatrix.encoding.title') ?></h3>
                <label class="text-sm"><?= lang('SparseMatrix.encoding.format') ?>
                    <select id="encFormat" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">
                        <option value="coo"><?= lang('SparseMatrix.encoding.coo') ?></option>
                        <option value="csr"><?= lang('SparseMatrix.encoding.csr') ?></option>
                        <option value="csc"><?= lang('SparseMatrix.encoding.csc') ?></option>
                        <option value="rle"><?= lang('SparseMatrix.encoding.rle') ?></option>
                        <option value="dict"><?= lang('SparseMatrix.encoding.dict') ?></option>
                        <option value="bitmap"><?= lang('SparseMatrix.encoding.bitmap') ?></option>
                    </select>
                </label>
                <div class="flex flex-wrap gap-2">
                    <button id="encodeBtn" class="rounded-lg bg-emerald-700 px-3 py-1.5 text-sm text-white"><?= lang('SparseMatrix.encoding.encode') ?></button>
                    <button id="reconstructBtn" class="rounded-lg border border-amber-300 bg-amber-50 px-3 py-1.5 text-sm text-amber-800"><?= lang('SparseMatrix.encoding.reconstruct') ?></button>
                    <button id="downloadAll" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('SparseMatrix.encoding.download') ?></button>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm space-y-1 text-sm">
                <h3 class="text-lg font-semibold"><?= lang('SparseMatrix.summary.title') ?></h3>
                <div><strong><?= lang('SparseMatrix.summary.dimensions') ?></strong> <span id="statDim">-</span></div>
                <div><strong><?= lang('SparseMatrix.summary.nnz') ?></strong> <span id="statNNZ">-</span></div>
                <div><strong><?= lang('SparseMatrix.summary.raw_size') ?></strong> <span id="statDenseBytes">-</span> <?= lang('SparseMatrix.summary.bytes') ?></div>
                <div><strong><?= lang('SparseMatrix.summary.compressed_size') ?></strong> <span id="statCompressedBytes">-</span> <?= lang('SparseMatrix.summary.bytes') ?></div>
                <div><strong><?= lang('SparseMatrix.summary.ratio') ?></strong> <span id="statRatio">-</span></div>
                <div><strong><?= lang('SparseMatrix.summary.reconstruction') ?></strong> <span id="statRecon">-</span></div>
            </div>
        </div>

        <div class="space-y-4 lg:col-span-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h3 class="text-lg font-semibold"><?= lang('SparseMatrix.matrix.title') ?></h3>
                <div id="matrixContainer" class="mt-2 max-h-64 overflow-auto rounded border border-slate-200 bg-white p-2"></div>
                <p class="mt-2 text-xs text-slate-500"><?= lang('SparseMatrix.matrix.hint') ?></p>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                    <div class="flex items-center justify-between">
                        <h4 class="text-sm font-semibold"><?= lang('SparseMatrix.encoded.title') ?></h4>
                        <button id="togglePretty" type="button" class="rounded-lg border border-slate-300 px-2.5 py-1 text-xs"><?= lang('SparseMatrix.encoded.pretty') ?></button>
                    </div>
                    <pre id="encResults" class="mt-2 max-h-72 overflow-auto rounded-lg bg-slate-950/5 p-3 text-xs text-slate-700"></pre>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                    <h4 class="text-sm font-semibold"><?= lang('SparseMatrix.matrix_json.title') ?></h4>
                    <pre id="matrixJSON" class="mt-2 max-h-72 overflow-auto rounded-lg bg-slate-950/5 p-3 text-xs text-slate-700"></pre>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h4 class="text-sm font-semibold"><?= lang('SparseMatrix.notes.title') ?></h4>
                <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-slate-700">
                    <li><?= lang('SparseMatrix.notes.li1') ?></li>
                    <li><?= lang('SparseMatrix.notes.li2') ?></li>
                    <li><?= lang('SparseMatrix.notes.li3') ?></li>
                    <li><?= lang('SparseMatrix.notes.li4') ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="/assets/js/sparse_matrix.js"></script>
<?= $this->endSection() ?>

