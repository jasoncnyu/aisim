<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-4">
    <div class="border-b border-slate-200 pb-3">
        <h2 class="text-2xl font-semibold">Grid World RL Lab</h2>
        <p class="text-slate-500">Interactive reinforcement learning sandbox with Q-Learning, Value Iteration, and Policy Iteration.</p>
    </div>

    <div class="space-y-2">
        <section x-data="{ open: true }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span>1) What This Environment Represents</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700">
                <p>An agent moves on a 2D grid, receives rewards, and learns a policy that maximizes return while handling walls and terminal goals.</p>
            </div>
        </section>
        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span>2) Algorithms Included</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700">
                <ul class="list-disc pl-5 space-y-1">
                    <li><strong>Q-Learning:</strong> model-free temporal-difference update with epsilon-greedy exploration.</li>
                    <li><strong>Value Iteration:</strong> Bellman optimality backups over all states.</li>
                    <li><strong>Policy Iteration:</strong> alternating policy evaluation and policy improvement.</li>
                </ul>
            </div>
        </section>
    </div>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-12">
        <div class="space-y-4 lg:col-span-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm space-y-4">
                <div class="flex flex-wrap items-center justify-between gap-2">
                    <div>
                        <h3 class="text-lg font-semibold">World Builder</h3>
                        <p class="text-xs text-slate-500">Define the grid, rewards, and starting conditions.</p>
                    </div>
                    <div class="flex flex-wrap items-center gap-2">
                        <input id="gridW" type="number" min="3" max="30" value="8" class="w-20 rounded border border-slate-300 px-2 py-1 text-sm">
                        <span class="text-sm text-slate-500">x</span>
                        <input id="gridH" type="number" min="3" max="30" value="8" class="w-20 rounded border border-slate-300 px-2 py-1 text-sm">
                        <button id="btn-applyGrid" class="rounded-lg bg-slate-900 px-3 py-1.5 text-sm text-white">Apply Grid</button>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-2">
                    <span class="text-sm text-slate-600">Tools</span>
                    <button id="tool-wall" class="rounded-lg border border-slate-700 bg-slate-900 px-3 py-1.5 text-sm text-white">Wall / Path</button>
                    <button id="tool-start" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm">Start</button>
                    <button id="tool-goal" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm">Goal</button>
                    <button id="btn-randomMap" class="ml-2 rounded-lg border border-emerald-300 bg-emerald-50 px-3 py-1.5 text-sm text-emerald-800">Load Demo Map</button>
                </div>

                <div class="flex flex-wrap items-center gap-2">
                    <span class="text-sm text-slate-600">Rewards</span>
                    <label class="text-sm">Cell <input id="cellReward" type="number" step="0.1" value="-0.04" class="ml-1 w-24 rounded border border-slate-300 px-2 py-1"></label>
                    <label class="text-sm">Goal <input id="goalReward" type="number" step="0.1" value="1.0" class="ml-1 w-24 rounded border border-slate-300 px-2 py-1"></label>
                    <label class="text-sm">Gamma <input id="gamma" type="number" step="0.01" value="0.95" class="ml-1 w-20 rounded border border-slate-300 px-2 py-1"></label>
                    <label class="text-sm">Alpha <input id="alpha" type="number" step="0.01" value="0.5" class="ml-1 w-20 rounded border border-slate-300 px-2 py-1"></label>
                    <label class="text-sm">Epsilon <input id="epsilon" type="number" step="0.01" value="0.1" class="ml-1 w-20 rounded border border-slate-300 px-2 py-1"></label>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm space-y-3">
                <div class="flex flex-wrap items-center justify-between gap-2">
                    <div>
                        <h3 class="text-lg font-semibold">Simulation</h3>
                        <p class="text-xs text-slate-500">Run episodes and inspect agent behavior.</p>
                    </div>
                    <div class="flex flex-wrap items-center gap-2">
                        <label class="text-sm">Algorithm</label>
                        <select id="algo" class="w-44 rounded border border-slate-300 px-2 py-1 text-sm">
                            <option value="qlearn">Q-Learning</option>
                            <option value="value_iter">Value Iteration</option>
                            <option value="policy_iter">Policy Iteration</option>
                        </select>
                        <button id="btn-export" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm">Export Policy CSV</button>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-2">
                    <button id="btn-run" class="rounded-lg bg-emerald-700 px-3 py-1.5 text-sm text-white">Run</button>
                    <button id="btn-step" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm">Step</button>
                    <button id="btn-stop" class="rounded-lg border border-amber-300 bg-amber-50 px-3 py-1.5 text-sm text-amber-800">Stop</button>
                    <label class="ml-2 text-sm">Episodes <input id="episodes" type="number" min="1" value="200" class="ml-1 w-24 rounded border border-slate-300 px-2 py-1"></label>
                    <label class="text-sm">Speed(ms) <input id="speed" type="number" min="0" value="50" class="ml-1 w-20 rounded border border-slate-300 px-2 py-1"></label>
                </div>

                <div class="flex flex-wrap gap-3">
                    <canvas id="gridCanvas" width="640" height="640" class="max-w-full rounded border border-slate-200 bg-white"></canvas>
                </div>
            </div>
        </div>

        <div class="space-y-4 lg:col-span-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h3 class="text-lg font-semibold">Run Info</h3>
                <p class="text-xs text-slate-500">Live episode and return tracking.</p>
                <div class="mt-3 space-y-2 text-sm">
                    <div>Mode: <span id="modeLabel">Idle</span></div>
                    <div>Episode: <span id="curEpisode">0</span> / <span id="totalEpisodes">0</span></div>
                    <div>Steps (episode): <span id="curStep">0</span></div>
                    <div>Last Return: <span id="lastReturn">-</span></div>
                </div>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h3 class="text-lg font-semibold">Policy & Values</h3>
                <p class="text-xs text-slate-500">Policy arrows indicate greedy actions from stored Q values or model-based updates.</p>
                <pre id="policyText" class="mt-2 max-h-72 overflow-auto rounded border border-slate-200 bg-slate-50 p-3 text-xs text-slate-700"></pre>
                <div class="mt-3 flex flex-wrap gap-2">
                    <button id="btn-downloadPolicy" class="rounded border border-slate-300 px-2 py-1 text-xs">Download Policy JSON</button>
                    <button id="btn-loadPolicy" class="rounded border border-slate-300 px-2 py-1 text-xs">Load Policy JSON</button>
                    <input id="filePolicy" type="file" accept="application/json" class="hidden">
                </div>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h3 class="text-lg font-semibold">Algorithm Notes</h3>
                <ul class="mt-2 list-disc pl-5 text-sm text-slate-700 space-y-1">
                    <li>Q-Learning updates action values online with bootstrapped targets.</li>
                    <li>Value Iteration computes optimal state values from Bellman backups.</li>
                    <li>Policy Iteration alternates evaluation and improvement for convergence.</li>
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
