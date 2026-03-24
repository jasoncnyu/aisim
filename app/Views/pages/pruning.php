<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-4">
    <div class="border-b border-slate-200 pb-3">
        <h2 class="text-2xl font-semibold">Pruning Lab</h2>
        <p class="text-slate-500">Remove low-importance weights and measure sparsity, masks, and compression impact.</p>
    </div>

    <div class="space-y-2">
        <section x-data="{ open: true }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="flex w-full items-center justify-between px-4 py-3 text-left font-medium" @click="open = !open">
                <span>1) What Pruning Does</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p>Pruning removes unimportant weights to make models smaller and faster. It introduces sparsity: many weights become zero and can be skipped at inference time.</p>
                <p>This lab focuses on weight pruning. You can try unstructured pruning (individual weights) or structured variants (row or column groups).</p>
            </div>
        </section>
        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="flex w-full items-center justify-between px-4 py-3 text-left font-medium" @click="open = !open">
                <span>2) Pruning Strategies</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p><strong>Threshold:</strong> drop weights with |w| below a cutoff.</p>
                <p><strong>Global Top-K:</strong> keep the largest K weights globally.</p>
                <p><strong>Target Sparsity:</strong> automatically find a threshold to reach a given sparsity.</p>
                <p><strong>Row/Column Top-K:</strong> keep top weights per row or per column to approximate structured sparsity.</p>
                <p><strong>Random / Iterative:</strong> baseline and scheduled pruning to show gradual compression.</p>
            </div>
        </section>
        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="flex w-full items-center justify-between px-4 py-3 text-left font-medium" @click="open = !open">
                <span>3) How to Explore</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <ol class="list-decimal space-y-1 pl-5">
                    <li>Generate a matrix and optionally edit values.</li>
                    <li>Choose a pruning strategy and its parameters.</li>
                    <li>Compare the pruned matrix and mask with the original.</li>
                </ol>
            </div>
        </section>
    </div>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-12">
        <div class="space-y-4 lg:col-span-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm space-y-3">
                <h3 class="text-lg font-semibold">Matrix Generator</h3>
                <div class="grid grid-cols-2 gap-3">
                    <label class="text-sm">Rows
                        <input id="rows" type="number" min="1" max="256" value="6" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">
                    </label>
                    <label class="text-sm">Cols
                        <input id="cols" type="number" min="1" max="256" value="12" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">
                    </label>
                </div>
                <div>
                    <label class="text-sm">Density (non-zero %)</label>
                    <input id="density" type="range" min="50" max="100" value="100" class="mt-2 w-full">
                    <div class="text-xs text-slate-500" style="position:absolute; right:0px">Current: <span id="densityVal">100%</span></div>
                </div>
                <label class="text-sm">Value Mode
                    <select id="valMode" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">
                        <option value="randInt">Random Integers (-9..9)</option>
                        <option value="weighted">Weighted Floats (-1..1)</option>
                    </select>
                </label>
                <div class="flex flex-wrap gap-2">
                    <button id="genRandom" class="rounded-lg bg-slate-900 px-3 py-1.5 text-sm text-white">Generate</button>
                    <button id="resetMatrix" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm">Reset</button>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm space-y-3">
                <h3 class="text-lg font-semibold">Pruning Settings</h3>
                <label class="text-sm">Pruning Strategy
                    <select id="pruneMode" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">
                        <option value="threshold">Unstructured: Threshold (|w| &lt;= tau)</option>
                        <option value="global_topk">Unstructured: Global Top-K Keep</option>
                        <option value="target_sparsity">Unstructured: Target Sparsity (%)</option>
                        <option value="row_topk">Structured-ish: Row Top-K</option>
                        <option value="col_topk">Structured-ish: Column Top-K</option>
                        <option value="random">Random: Prune Ratio (%)</option>
                        <option value="iterative">Iterative Schedule</option>
                    </select>
                </label>

                <div id="param_threshold" class="space-y-1">
                    <label class="text-sm">Tau (threshold)
                        <input id="tau" type="number" step="0.001" value="0.15" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">
                    </label>
                </div>

                <div id="param_topk" class="space-y-1 hidden">
                    <label class="text-sm">K (keep)
                        <input id="topk" type="number" min="0" value="20" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">
                    </label>
                </div>

                <div id="param_target" class="space-y-1 hidden">
                    <label class="text-sm">Target sparsity (%)
                        <input id="targetSparsity" type="number" min="0" max="99" value="80" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">
                    </label>
                </div>

                <div id="param_rowk" class="space-y-1 hidden">
                    <label class="text-sm">Row Top-K
                        <input id="rowK" type="number" min="0" value="2" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">
                    </label>
                </div>

                <div id="param_colk" class="space-y-1 hidden">
                    <label class="text-sm">Column Top-K
                        <input id="colK" type="number" min="0" value="2" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">
                    </label>
                </div>

                <div id="param_random" class="space-y-1 hidden">
                    <label class="text-sm">Random prune ratio (%)
                        <input id="randRatio" type="number" min="0" max="100" value="50" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">
                    </label>
                </div>

                <div id="param_iter" class="space-y-2 hidden">
                    <label class="text-sm">Steps
                        <input id="iterSteps" type="number" min="1" max="50" value="4" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">
                    </label>
                    <label class="text-sm">Final target sparsity (%)
                        <input id="iterFinalSparsity" type="number" min="0" max="99" value="90" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">
                    </label>
                    <label class="text-sm">Schedule
                        <select id="iterSchedule" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">
                            <option value="linear">Linear</option>
                            <option value="poly3">Polynomial (p=3)</option>
                        </select>
                    </label>
                </div>

                <div class="flex flex-wrap gap-2">
                    <button id="applyPrune" class="rounded-lg bg-emerald-700 px-3 py-1.5 text-sm text-white">Apply Pruning</button>
                    <button id="resetPrune" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm">Reset</button>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm space-y-1 text-sm">
                <h3 class="text-lg font-semibold">Summary</h3>
                <div><strong>Dimensions:</strong> <span id="statDim">-</span></div>
                <div><strong>NNZ (orig → pruned):</strong> <span id="statNNZ">-</span></div>
                <div><strong>Sparsity (orig → pruned):</strong> <span id="statSparsity">-</span></div>
                <div><strong>Size est. dense:</strong> <span id="statDenseBytes">-</span> bytes</div>
                <div><strong>Mask size:</strong> <span id="statMaskBits">-</span> bits</div>
                <div><strong>Last strategy:</strong> <span id="statStrategy">-</span></div>
            </div>
        </div>

        <div class="space-y-4 lg:col-span-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h3 class="text-lg font-semibold">Original Matrix (click to edit)</h3>
                <div id="matrixContainer" class="mt-2 max-h-60 overflow-auto rounded border border-slate-200 bg-white p-2"></div>
                <p class="mt-2 text-xs text-slate-500">Click a cell to edit. Press Enter to save; empty values become zero.</p>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                    <h4 class="text-sm font-semibold">Pruned Matrix</h4>
                    <div id="prunedContainer" class="mt-2 max-h-56 overflow-auto rounded border border-slate-200 bg-white p-2"></div>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                    <h4 class="text-sm font-semibold">Mask (1 = keep, 0 = prune)</h4>
                    <div id="maskContainer" class="mt-2 max-h-56 overflow-auto rounded border border-slate-200 bg-white p-2"></div>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <div class="flex flex-wrap items-center justify-between gap-2">
                    <h4 class="text-sm font-semibold">JSON Export</h4>
                    <div class="flex flex-wrap gap-2">
                        <button id="togglePretty" type="button" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm">Pretty view</button>
                        <button id="downloadJSON" type="button" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm">Download JSON</button>
                    </div>
                </div>
                <pre id="jsonOut" class="mt-2 max-h-72 overflow-auto rounded-lg bg-slate-950/5 p-3 text-xs text-slate-700"></pre>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h4 class="text-sm font-semibold">Notes</h4>
                <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-slate-700">
                    <li>Unstructured pruning yields high sparsity but irregular memory access.</li>
                    <li>Structured pruning is easier to accelerate on hardware but can remove entire features.</li>
                    <li>Iterative pruning simulates training-time schedules for stable compression.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="/assets/js/pruning.js"></script>
<?= $this->endSection() ?>
