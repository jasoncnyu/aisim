<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-4">
    <div class="border-b border-slate-200 pb-3">
        <h2 class="text-2xl font-semibold"><?= lang('XORLab.title') ?></h2>
        <p class="text-slate-500"><?= lang('XORLab.subtitle') ?></p>
    </div>

    <div class="space-y-2">
        <section x-data="{ open: true }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span><?= lang('XORLab.accordion.1.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p><?= lang('XORLab.accordion.1.p1') ?></p>
                <p><?= lang('XORLab.accordion.1.p2') ?></p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span><?= lang('XORLab.accordion.2.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p><?= lang('XORLab.accordion.2.p1') ?></p>
                <p class="text-center"><?= lang('XORLab.accordion.2.structure') ?></p>
                <p><?= lang('XORLab.accordion.2.p2') ?></p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span><?= lang('XORLab.accordion.3.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p><?= lang('XORLab.accordion.3.p1') ?></p>
                <p class="text-center"><?= lang('XORLab.accordion.3.equation1') ?></p>
                <p class="text-center"><?= lang('XORLab.accordion.3.equation2') ?></p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span><?= lang('XORLab.accordion.4.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700">
                <ul class="list-disc pl-5 space-y-1">
                    <li><?= lang('XORLab.accordion.4.li1') ?></li>
                    <li><?= lang('XORLab.accordion.4.li2') ?></li>
                    <li><?= lang('XORLab.accordion.4.li3') ?></li>
                </ul>
            </div>
        </section>
    </div>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-12">
        <div class="space-y-4 lg:col-span-7">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h3 class="mb-3 text-lg font-semibold"><?= lang('XORLab.controls.title') ?></h3>
                <div class="flex flex-wrap items-end gap-3">
                    <label class="text-sm"><?= lang('XORLab.controls.learning_rate') ?>
                        <input id="lr" type="number" value="0.05" step="0.01" class="mt-1 block w-28 rounded-lg border border-slate-300 px-2 py-1.5">
                    </label>
                    <label class="text-sm"><?= lang('XORLab.controls.sleep') ?>
                        <input id="sleep" type="number" value="5" min="0" class="mt-1 block w-24 rounded-lg border border-slate-300 px-2 py-1.5">
                    </label>
                    <label class="text-sm"><?= lang('XORLab.controls.activation') ?>
                        <select id="act" class="mt-1 block w-28 rounded-lg border border-slate-300 px-2 py-1.5">
                            <option value="tanh">tanh</option>
                            <option value="relu">ReLU</option>
                        </select>
                    </label>
                </div>

                <div class="mt-3 flex flex-wrap gap-2">
                    <button id="train1" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('XORLab.controls.step') ?></button>
                    <button id="auto" class="rounded-lg bg-slate-900 px-3 py-1.5 text-sm text-white"><?= lang('XORLab.controls.auto_train') ?></button>
                    <button id="reset" class="rounded-lg border border-red-300 bg-red-50 px-3 py-1.5 text-sm text-red-700"><?= lang('XORLab.controls.reset') ?></button>
                </div>

                <div class="mt-3 text-sm text-slate-700"><?= lang('XORLab.controls.step_label') ?> <span id="step">0</span> | <?= lang('XORLab.controls.loss_label') ?> <span id="loss">-</span></div>
                <canvas id="lossChart" class="mt-3 w-full rounded border border-slate-200 bg-white" style="height:220px;"></canvas>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h3 class="mb-2 text-lg font-semibold"><?= lang('XORLab.trace_title') ?></h3>
                <pre id="calcFlow" class="max-h-[420px] overflow-auto rounded border border-slate-200 bg-slate-50 p-3 text-xs text-slate-700"></pre>
            </div>
        </div>

        <div class="space-y-4 lg:col-span-5">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm text-center">
                <h3 class="mb-2 text-lg font-semibold"><?= lang('XORLab.prediction_title') ?></h3>
                <canvas id="predChart" class="mx-auto w-full max-w-[340px] rounded border border-slate-200 bg-white" style="height:320px;"></canvas>
                <p class="mt-2 text-xs text-slate-500"><?= lang('XORLab.prediction_hint') ?></p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h3 class="mb-2 text-lg font-semibold"><?= lang('XORLab.targets_title') ?></h3>
                <ul class="list-disc pl-5 text-sm text-slate-700 space-y-1">
                    <li><?= lang('XORLab.targets.li1') ?></li>
                    <li><?= lang('XORLab.targets.li2') ?></li>
                    <li><?= lang('XORLab.targets.li3') ?></li>
                    <li><?= lang('XORLab.targets.li4') ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="/assets/js/xor_lab.js"></script>
<?= $this->endSection() ?>
