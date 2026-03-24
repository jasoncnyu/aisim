<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-4">
    <div class="border-b border-slate-200 pb-3">
        <h2 class="text-2xl font-semibold">N-Slot Bandit Lab</h2>
        <p class="text-slate-500">Compare exploration-exploitation strategies in a stochastic multi-armed bandit.</p>
    </div>

    <div class="space-y-2">
        <section x-data="{ open: true }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span>1) Problem Setup</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700">
                <p>Each arm has an unknown Bernoulli reward probability. At each step the agent chooses one arm and observes reward 0 or 1.</p>
            </div>
        </section>
        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span>2) Algorithms Compared</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700">
                <ul class="list-disc pl-5 space-y-1">
                    <li><strong>Epsilon-Greedy:</strong> random exploration with probability epsilon.</li>
                    <li><strong>UCB1:</strong> optimism bonus for uncertain arms.</li>
                    <li><strong>Thompson Sampling:</strong> Bayesian posterior sampling via Beta distributions.</li>
                </ul>
            </div>
        </section>
    </div>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-12">
        <div class="space-y-4 lg:col-span-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm space-y-3">
                <div class="flex flex-wrap items-end gap-2">
                    <label class="text-sm">Algorithm
                        <select id="algo" class="mt-1 w-44 rounded border border-slate-300 px-2 py-1.5 text-sm">
                            <option value="eps">Epsilon-Greedy</option>
                            <option value="ucb">UCB1</option>
                            <option value="ts">Thompson Sampling</option>
                        </select>
                    </label>
                    <label class="text-sm">Arms (N)
                        <input id="nArms" type="number" min="2" value="10" class="mt-1 w-24 rounded border border-slate-300 px-2 py-1.5 text-sm">
                    </label>
                    <label class="text-sm">Steps
                        <input id="steps" type="number" min="1" value="500" class="mt-1 w-28 rounded border border-slate-300 px-2 py-1.5 text-sm">
                    </label>
                    <label class="text-sm">Runs
                        <input id="runs" type="number" min="1" value="20" class="mt-1 w-24 rounded border border-slate-300 px-2 py-1.5 text-sm">
                    </label>
                    <label class="text-sm" id="epsBox">Epsilon
                        <input id="epsilon" type="number" step="0.01" min="0" max="1" value="0.1" class="mt-1 w-24 rounded border border-slate-300 px-2 py-1.5 text-sm">
                    </label>
                    <label class="text-sm">Seed
                        <input id="seed" type="text" placeholder="optional" class="mt-1 w-28 rounded border border-slate-300 px-2 py-1.5 text-sm">
                    </label>
                    <button id="btn-random" class="ml-auto rounded-lg border border-slate-300 px-3 py-1.5 text-sm">Randomize Probs</button>
                    <button id="btn-apply" class="rounded-lg bg-slate-900 px-3 py-1.5 text-sm text-white">Apply</button>
                </div>

                <div class="flex flex-wrap items-center gap-2">
                    <button id="btn-run" class="inline-flex items-center gap-2 rounded-lg bg-emerald-700 px-3 py-1.5 text-sm text-white">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M7 5.5a1 1 0 011.5-.86l9 5.5a1 1 0 010 1.72l-9 5.5A1 1 0 017 16.5v-11z"/></svg>
                        Run
                    </button>
                    <button id="btn-step" class="inline-flex items-center gap-2 rounded-lg border border-slate-300 px-3 py-1.5 text-sm">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M4 12h12"/><path d="M12 6l6 6-6 6"/></svg>
                        Step
                    </button>
                    <button id="btn-stop" class="inline-flex items-center gap-2 rounded-lg border border-amber-300 bg-amber-50 px-3 py-1.5 text-sm text-amber-800">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><rect x="6" y="6" width="12" height="12" rx="2"/></svg>
                        Stop
                    </button>
                    <button id="btn-reset" class="inline-flex items-center gap-2 rounded-lg border border-slate-300 px-3 py-1.5 text-sm">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M4 4v6h6"/><path d="M20 20v-6h-6"/><path d="M20 8a8 8 0 00-14.5-3"/><path d="M4 16a8 8 0 0014.5 3"/></svg>
                        Reset
                    </button>
                    <button id="btn-export" class="ml-auto inline-flex items-center gap-2 rounded-lg border border-slate-300 px-3 py-1.5 text-sm">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 3v12"/><path d="M7 10l5 5 5-5"/><path d="M4 21h16"/></svg>
                        Export CSV
                    </button>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <h4 class="mb-1 text-sm font-semibold">Average Reward</h4>
                        <canvas id="rewardChart" width="600" height="200" class="w-full rounded border border-slate-200 bg-white" style="height:200px;"></canvas>
                    </div>
                    <div>
                        <h4 class="mb-1 text-sm font-semibold">Cumulative Regret</h4>
                        <canvas id="regretChart" width="600" height="200" class="w-full rounded border border-slate-200 bg-white" style="height:200px;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-4 lg:col-span-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h3 class="text-lg font-semibold">Arms (True Probabilities)</h3>
                <p class="text-xs text-slate-500">Edit manually or randomize, then click Apply.</p>
                <div id="armsContainer" class="mt-2 max-h-80 overflow-auto"></div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h3 class="text-lg font-semibold">Run Info</h3>
                <div class="text-sm space-y-1">
                    <div>Current run: <span id="curRun">0</span> / <span id="totalRuns">0</span></div>
                    <div>Step: <span id="curStep">0</span> / <span id="totalSteps">0</span></div>
                    <div>Avg reward: <span id="avgReward">-</span></div>
                    <div>Cum regret: <span id="cumRegret">-</span></div>
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
