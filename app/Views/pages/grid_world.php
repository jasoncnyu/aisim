<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-4">
    <div class="border-b border-slate-200 pb-3">
        <h2 class="text-2xl font-semibold"><?= lang('GridWorld.title') ?></h2>
        <p class="text-slate-500"><?= lang('GridWorld.subtitle') ?></p>
    </div>

    <div class="space-y-2">
        <section x-data="{ open: true }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span><?= lang('GridWorld.accordion.1.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700">
                <p><?= lang('GridWorld.accordion.1.p1') ?></p>
            </div>
        </section>
        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span><?= lang('GridWorld.accordion.2.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700">
                <ul class="list-disc pl-5 space-y-1">
                    <li><strong><?= lang('GridWorld.accordion.2.li1_label') ?>:</strong> <?= lang('GridWorld.accordion.2.li1') ?></li>
                    <li><strong><?= lang('GridWorld.accordion.2.li2_label') ?>:</strong> <?= lang('GridWorld.accordion.2.li2') ?></li>
                    <li><strong><?= lang('GridWorld.accordion.2.li3_label') ?>:</strong> <?= lang('GridWorld.accordion.2.li3') ?></li>
                </ul>
            </div>
        </section>
    </div>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-12">
        <div class="space-y-4 lg:col-span-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm space-y-4">
                <div class="flex flex-wrap items-center justify-between gap-2">
                    <div>
                        <h3 class="text-lg font-semibold"><?= lang('GridWorld.builder.title') ?></h3>
                        <p class="text-xs text-slate-500"><?= lang('GridWorld.builder.subtitle') ?></p>
                    </div>
                    <div class="flex flex-wrap items-center gap-2">
                        <input id="gridW" type="number" min="3" max="30" value="8" class="w-20 rounded border border-slate-300 px-2 py-1 text-sm">
                        <span class="text-sm text-slate-500"><?= lang('GridWorld.builder.times') ?></span>
                        <input id="gridH" type="number" min="3" max="30" value="8" class="w-20 rounded border border-slate-300 px-2 py-1 text-sm">
                        <button id="btn-applyGrid" class="rounded-lg bg-slate-900 px-3 py-1.5 text-sm text-white"><?= lang('GridWorld.builder.apply_grid') ?></button>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-2">
                    <span class="text-sm text-slate-600"><?= lang('GridWorld.builder.tools') ?></span>
                    <button id="tool-wall" class="rounded-lg border border-slate-700 bg-slate-900 px-3 py-1.5 text-sm text-white"><?= lang('GridWorld.builder.tool_wall') ?></button>
                    <button id="tool-start" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('GridWorld.builder.tool_start') ?></button>
                    <button id="tool-goal" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('GridWorld.builder.tool_goal') ?></button>
                    <button id="btn-randomMap" class="ml-2 rounded-lg border border-emerald-300 bg-emerald-50 px-3 py-1.5 text-sm text-emerald-800"><?= lang('GridWorld.builder.load_demo') ?></button>
                </div>

                <div class="flex flex-wrap items-center gap-2">
                    <span class="text-sm text-slate-600"><?= lang('GridWorld.builder.rewards') ?></span>
                    <label class="text-sm"><?= lang('GridWorld.builder.cell') ?> <input id="cellReward" type="number" step="0.1" value="-0.04" class="ml-1 w-24 rounded border border-slate-300 px-2 py-1"></label>
                    <label class="text-sm"><?= lang('GridWorld.builder.goal') ?> <input id="goalReward" type="number" step="0.1" value="1.0" class="ml-1 w-24 rounded border border-slate-300 px-2 py-1"></label>
                    <label class="text-sm"><?= lang('GridWorld.builder.gamma') ?> <input id="gamma" type="number" step="0.01" value="0.95" class="ml-1 w-20 rounded border border-slate-300 px-2 py-1"></label>
                    <label class="text-sm"><?= lang('GridWorld.builder.alpha') ?> <input id="alpha" type="number" step="0.01" value="0.5" class="ml-1 w-20 rounded border border-slate-300 px-2 py-1"></label>
                    <label class="text-sm"><?= lang('GridWorld.builder.epsilon') ?> <input id="epsilon" type="number" step="0.01" value="0.1" class="ml-1 w-20 rounded border border-slate-300 px-2 py-1"></label>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm space-y-3">
                <div class="flex flex-wrap items-center justify-between gap-2">
                    <div>
                        <h3 class="text-lg font-semibold"><?= lang('GridWorld.sim.title') ?></h3>
                        <p class="text-xs text-slate-500"><?= lang('GridWorld.sim.subtitle') ?></p>
                    </div>
                    <div class="flex flex-wrap items-center gap-2">
                        <label class="text-sm"><?= lang('GridWorld.sim.algorithm') ?></label>
                        <select id="algo" class="w-44 rounded border border-slate-300 px-2 py-1 text-sm">
                            <option value="qlearn"><?= lang('GridWorld.sim.q_learning') ?></option>
                            <option value="value_iter"><?= lang('GridWorld.sim.value_iteration') ?></option>
                            <option value="policy_iter"><?= lang('GridWorld.sim.policy_iteration') ?></option>
                        </select>
                        <button id="btn-export" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('GridWorld.sim.export_csv') ?></button>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-2">
                    <button id="btn-run" class="rounded-lg bg-emerald-700 px-3 py-1.5 text-sm text-white"><?= lang('GridWorld.sim.run') ?></button>
                    <button id="btn-step" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('GridWorld.sim.step') ?></button>
                    <button id="btn-stop" class="rounded-lg border border-amber-300 bg-amber-50 px-3 py-1.5 text-sm text-amber-800"><?= lang('GridWorld.sim.stop') ?></button>
                    <label class="ml-2 text-sm"><?= lang('GridWorld.sim.episodes') ?> <input id="episodes" type="number" min="1" value="200" class="ml-1 w-24 rounded border border-slate-300 px-2 py-1"></label>
                    <label class="text-sm"><?= lang('GridWorld.sim.speed') ?> <input id="speed" type="number" min="0" value="50" class="ml-1 w-20 rounded border border-slate-300 px-2 py-1"></label>
                </div>

                <div class="flex flex-wrap gap-3">
                    <canvas id="gridCanvas" width="640" height="640" class="max-w-full rounded border border-slate-200 bg-white"></canvas>
                </div>
            </div>
        </div>

        <div class="space-y-4 lg:col-span-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h3 class="text-lg font-semibold"><?= lang('GridWorld.run_info.title') ?></h3>
                <p class="text-xs text-slate-500"><?= lang('GridWorld.run_info.subtitle') ?></p>
                <div class="mt-3 space-y-2 text-sm">
                    <div><?= lang('GridWorld.run_info.mode') ?> <span id="modeLabel"><?= lang('GridWorld.run_info.idle') ?></span></div>
                    <div><?= lang('GridWorld.run_info.episode') ?> <span id="curEpisode">0</span> / <span id="totalEpisodes">0</span></div>
                    <div><?= lang('GridWorld.run_info.steps') ?> <span id="curStep">0</span></div>
                    <div><?= lang('GridWorld.run_info.last_return') ?> <span id="lastReturn">-</span></div>
                </div>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h3 class="text-lg font-semibold"><?= lang('GridWorld.policy.title') ?></h3>
                <p class="text-xs text-slate-500"><?= lang('GridWorld.policy.subtitle') ?></p>
                <pre id="policyText" class="mt-2 max-h-72 overflow-auto rounded border border-slate-200 bg-slate-50 p-3 text-xs text-slate-700"></pre>
                <div class="mt-3 flex flex-wrap gap-2">
                    <button id="btn-downloadPolicy" class="rounded border border-slate-300 px-2 py-1 text-xs"><?= lang('GridWorld.policy.download') ?></button>
                    <button id="btn-loadPolicy" class="rounded border border-slate-300 px-2 py-1 text-xs"><?= lang('GridWorld.policy.load') ?></button>
                    <input id="filePolicy" type="file" accept="application/json" class="hidden">
                </div>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h3 class="text-lg font-semibold"><?= lang('GridWorld.notes.title') ?></h3>
                <ul class="mt-2 list-disc pl-5 text-sm text-slate-700 space-y-1">
                    <li><?= lang('GridWorld.notes.li1') ?></li>
                    <li><?= lang('GridWorld.notes.li2') ?></li>
                    <li><?= lang('GridWorld.notes.li3') ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="/assets/js/grid_world.js"></script>
<?= $this->endSection() ?>
