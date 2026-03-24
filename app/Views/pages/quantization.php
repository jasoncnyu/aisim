<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-4">
    <div class="border-b border-slate-200 pb-3">
        <h2 class="text-2xl font-semibold"><?= lang('Quantization.title') ?></h2>
        <p class="text-slate-500"><?= lang('Quantization.subtitle') ?></p>
    </div>

    <div class="space-y-2">
        <section x-data="{ open: true }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="flex w-full items-center justify-between px-4 py-3 text-left font-medium" @click="open = !open">
                <span><?= lang('Quantization.accordion.1.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p><?= lang('Quantization.accordion.1.p1') ?></p>
                <p><?= lang('Quantization.accordion.1.p2') ?></p>
            </div>
        </section>
        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="flex w-full items-center justify-between px-4 py-3 text-left font-medium" @click="open = !open">
                <span><?= lang('Quantization.accordion.2.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p><strong><?= lang('Quantization.accordion.2.li1_label') ?>:</strong> <?= lang('Quantization.accordion.2.li1') ?></p>
                <p><strong><?= lang('Quantization.accordion.2.li2_label') ?>:</strong> <?= lang('Quantization.accordion.2.li2') ?></p>
                <p><strong><?= lang('Quantization.accordion.2.li3_label') ?>:</strong> <?= lang('Quantization.accordion.2.li3') ?></p>
                <p><strong><?= lang('Quantization.accordion.2.li4_label') ?>:</strong> <?= lang('Quantization.accordion.2.li4') ?></p>
            </div>
        </section>
        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="flex w-full items-center justify-between px-4 py-3 text-left font-medium" @click="open = !open">
                <span><?= lang('Quantization.accordion.3.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <ol class="list-decimal space-y-1 pl-5">
                    <li><?= lang('Quantization.accordion.3.step1') ?></li>
                    <li><?= lang('Quantization.accordion.3.step2') ?></li>
                    <li><?= lang('Quantization.accordion.3.step3') ?></li>
                </ol>
            </div>
        </section>
    </div>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-12">
        <div class="space-y-4 lg:col-span-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm space-y-3">
                <h3 class="text-lg font-semibold"><?= lang('Quantization.generator.title') ?></h3>
                <div class="grid grid-cols-2 gap-3">
                    <label class="text-sm"><?= lang('Quantization.generator.rows') ?>
                        <input id="rows" type="number" min="1" max="256" value="6" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">
                    </label>
                    <label class="text-sm"><?= lang('Quantization.generator.cols') ?>
                        <input id="cols" type="number" min="1" max="256" value="12" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">
                    </label>
                </div>
                <div>
                    <label class="text-sm"><?= lang('Quantization.generator.density') ?></label>
                    <input id="density" type="range" min="50" max="100" value="100" class="mt-2 w-full">
                    <div class="text-xs text-slate-500"><?= lang('Quantization.generator.current') ?> <span id="densityVal">100%</span></div>
                </div>
                <div class="flex flex-wrap gap-2">
                    <button id="genRandom" class="rounded-lg bg-slate-900 px-3 py-1.5 text-sm text-white"><?= lang('Quantization.generator.generate') ?></button>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm space-y-3">
                <h3 class="text-lg font-semibold"><?= lang('Quantization.settings.title') ?></h3>
                <label class="text-sm"><?= lang('Quantization.settings.type') ?>
                    <select id="quantMode" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">
                        <option value="int8_sym"><?= lang('Quantization.settings.int8_sym') ?></option>
                        <option value="uint8_asym"><?= lang('Quantization.settings.uint8_asym') ?></option>
                        <option value="row_dynamic"><?= lang('Quantization.settings.row_dynamic') ?></option>
                        <option value="log"><?= lang('Quantization.settings.log') ?></option>
                        <option value="binary"><?= lang('Quantization.settings.binary') ?></option>
                        <option value="ternary"><?= lang('Quantization.settings.ternary') ?></option>
                    </select>
                </label>
                <label class="text-sm"><?= lang('Quantization.settings.bit_width') ?>
                    <input id="bitWidth" type="number" min="2" max="8" value="4" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">
                </label>
                <div class="flex flex-wrap gap-2">
                    <button id="applyQuant" class="rounded-lg bg-emerald-700 px-3 py-1.5 text-sm text-white"><?= lang('Quantization.settings.apply') ?></button>
                    <button id="resetQuant" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('Quantization.settings.reset') ?></button>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm space-y-1 text-sm">
                <h3 class="text-lg font-semibold"><?= lang('Quantization.summary.title') ?></h3>
                <div><strong><?= lang('Quantization.summary.dimensions') ?></strong> <span id="statDim">-</span></div>
                <div><strong><?= lang('Quantization.summary.value_range') ?></strong> <span id="statRange">-</span></div>
                <div><strong><?= lang('Quantization.summary.quant_range') ?></strong> <span id="statQRange">-</span></div>
                <div><strong><?= lang('Quantization.summary.mse') ?></strong> <span id="statMSE">-</span></div>
                <div><strong><?= lang('Quantization.summary.psnr') ?></strong> <span id="statPSNR">-</span></div>
                <div><strong><?= lang('Quantization.summary.avg_error') ?></strong> <span id="statErr">-</span></div>
                <div><strong><?= lang('Quantization.summary.bitrate') ?></strong> <span id="statBitrate">-</span> <?= lang('Quantization.summary.bits_per_value') ?></div>
                <div><strong><?= lang('Quantization.summary.last_strategy') ?></strong> <span id="statStrategy">-</span></div>
            </div>
        </div>

        <div class="space-y-4 lg:col-span-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h3 class="text-lg font-semibold"><?= lang('Quantization.matrix.title') ?></h3>
                <div id="matrixContainer" class="mt-2 max-h-56 overflow-auto rounded border border-slate-200 bg-white"></div>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                    <h4 class="text-sm font-semibold"><?= lang('Quantization.quantized.title') ?></h4>
                    <div id="quantContainer" class="mt-2 max-h-52 overflow-auto rounded border border-slate-200 bg-white"></div>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                    <h4 class="text-sm font-semibold"><?= lang('Quantization.dequantized.title') ?></h4>
                    <div id="dequantContainer" class="mt-2 max-h-52 overflow-auto rounded border border-slate-200 bg-white"></div>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h4 class="text-sm font-semibold"><?= lang('Quantization.error.title') ?></h4>
                <div id="errorContainer" class="mt-2 max-h-52 overflow-auto rounded border border-slate-200 bg-white"></div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <div class="flex items-center justify-between">
                    <h4 class="text-sm font-semibold"><?= lang('Quantization.json.title') ?></h4>
                    <button id="downloadJSON" type="button" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('Quantization.json.download') ?></button>
                </div>
                <pre id="jsonOut" class="mt-2 max-h-64 overflow-auto rounded-lg bg-slate-950/5 p-3 text-xs text-slate-700"></pre>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="/assets/js/quantization.js"></script>
<?= $this->endSection() ?>
