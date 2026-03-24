<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-4">
    <div class="border-b border-slate-200 pb-3">
        <h2 class="text-2xl font-semibold"><?= lang('NSlotBandit.title') ?></h2>
        <p class="text-slate-500"><?= lang('NSlotBandit.subtitle') ?></p>
    </div>

    <div class="space-y-2">
        <section x-data="{ open: true }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span><?= lang('NSlotBandit.accordion.1.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700">
                <p><?= lang('NSlotBandit.accordion.1.p1') ?></p>
            </div>
        </section>
        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span><?= lang('NSlotBandit.accordion.2.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700">
                <ul class="list-disc pl-5 space-y-1">
                    <li><strong><?= lang('NSlotBandit.accordion.2.li1_label') ?>:</strong> <?= lang('NSlotBandit.accordion.2.li1') ?></li>
                    <li><strong><?= lang('NSlotBandit.accordion.2.li2_label') ?>:</strong> <?= lang('NSlotBandit.accordion.2.li2') ?></li>
                    <li><strong><?= lang('NSlotBandit.accordion.2.li3_label') ?>:</strong> <?= lang('NSlotBandit.accordion.2.li3') ?></li>
                </ul>
            </div>
        </section>
    </div>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-12">
        <div class="space-y-4 lg:col-span-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm space-y-3">
                <div class="flex flex-wrap items-end gap-2">
                    <label class="text-sm"><?= lang('NSlotBandit.controls.algorithm') ?>
                        <select id="algo" class="mt-1 w-44 rounded border border-slate-300 px-2 py-1.5 text-sm">
                            <option value="eps"><?= lang('NSlotBandit.controls.eps_greedy') ?></option>
                            <option value="ucb"><?= lang('NSlotBandit.controls.ucb1') ?></option>
                            <option value="ts"><?= lang('NSlotBandit.controls.thompson') ?></option>
                        </select>
                    </label>
                    <label class="text-sm"><?= lang('NSlotBandit.controls.arms') ?>
                        <input id="nArms" type="number" min="2" value="10" class="mt-1 w-24 rounded border border-slate-300 px-2 py-1.5 text-sm">
                    </label>
                    <label class="text-sm"><?= lang('NSlotBandit.controls.steps') ?>
                        <input id="steps" type="number" min="1" value="500" class="mt-1 w-28 rounded border border-slate-300 px-2 py-1.5 text-sm">
                    </label>
                    <label class="text-sm"><?= lang('NSlotBandit.controls.runs') ?>
                        <input id="runs" type="number" min="1" value="20" class="mt-1 w-24 rounded border border-slate-300 px-2 py-1.5 text-sm">
                    </label>
                    <label class="text-sm" id="epsBox"><?= lang('NSlotBandit.controls.epsilon') ?>
                        <input id="epsilon" type="number" step="0.01" min="0" max="1" value="0.1" class="mt-1 w-24 rounded border border-slate-300 px-2 py-1.5 text-sm">
                    </label>
                    <label class="text-sm"><?= lang('NSlotBandit.controls.seed') ?>
                        <input id="seed" type="text" placeholder="<?= lang('NSlotBandit.controls.optional') ?>" class="mt-1 w-28 rounded border border-slate-300 px-2 py-1.5 text-sm">
                    </label>
                    <button id="btn-random" class="ml-auto rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('NSlotBandit.controls.randomize') ?></button>
                    <button id="btn-apply" class="rounded-lg bg-slate-900 px-3 py-1.5 text-sm text-white"><?= lang('NSlotBandit.controls.apply') ?></button>
                </div>

                <div class="flex flex-wrap items-center gap-2">
                    <button id="btn-run" class="inline-flex items-center gap-2 rounded-lg bg-emerald-700 px-3 py-1.5 text-sm text-white">
                        <i class="fa-solid fa-play h-4 w-4" aria-hidden="true"></i>
                        <?= lang('NSlotBandit.controls.run') ?>
                    </button>
                    <button id="btn-step" class="inline-flex items-center gap-2 rounded-lg border border-slate-300 px-3 py-1.5 text-sm">
                        <i class="fa-solid fa-forward-step h-4 w-4" aria-hidden="true"></i>
                        <?= lang('NSlotBandit.controls.step') ?>
                    </button>
                    <button id="btn-stop" class="inline-flex items-center gap-2 rounded-lg border border-amber-300 bg-amber-50 px-3 py-1.5 text-sm text-amber-800">
                        <i class="fa-solid fa-stop h-4 w-4" aria-hidden="true"></i>
                        <?= lang('NSlotBandit.controls.stop') ?>
                    </button>
                    <button id="btn-reset" class="inline-flex items-center gap-2 rounded-lg border border-slate-300 px-3 py-1.5 text-sm">
                        <i class="fa-solid fa-rotate-right h-4 w-4" aria-hidden="true"></i>
                        <?= lang('NSlotBandit.controls.reset') ?>
                    </button>
                    <button id="btn-export" class="ml-auto inline-flex items-center gap-2 rounded-lg border border-slate-300 px-3 py-1.5 text-sm">
                        <i class="fa-solid fa-download h-4 w-4" aria-hidden="true"></i>
                        <?= lang('NSlotBandit.controls.export_csv') ?>
                    </button>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <h4 class="mb-1 text-sm font-semibold"><?= lang('NSlotBandit.charts.avg_reward') ?></h4>
                        <canvas id="rewardChart" width="600" height="200" class="w-full rounded border border-slate-200 bg-white" style="height:200px;"></canvas>
                    </div>
                    <div>
                        <h4 class="mb-1 text-sm font-semibold"><?= lang('NSlotBandit.charts.cum_regret') ?></h4>
                        <canvas id="regretChart" width="600" height="200" class="w-full rounded border border-slate-200 bg-white" style="height:200px;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-4 lg:col-span-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h3 class="text-lg font-semibold"><?= lang('NSlotBandit.arms.title') ?></h3>
                <p class="text-xs text-slate-500"><?= lang('NSlotBandit.arms.subtitle') ?></p>
                <div id="armsContainer" class="mt-2 max-h-80 overflow-auto"></div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h3 class="text-lg font-semibold"><?= lang('NSlotBandit.run_info.title') ?></h3>
                <div class="text-sm space-y-1">
                    <div><?= lang('NSlotBandit.run_info.current_run') ?> <span id="curRun">0</span> / <span id="totalRuns">0</span></div>
                    <div><?= lang('NSlotBandit.run_info.step') ?> <span id="curStep">0</span> / <span id="totalSteps">0</span></div>
                    <div><?= lang('NSlotBandit.run_info.avg_reward') ?> <span id="avgReward">-</span></div>
                    <div><?= lang('NSlotBandit.run_info.cum_regret') ?> <span id="cumRegret">-</span></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="/assets/js/n_slot_bandit.js"></script>
<?= $this->endSection() ?>
