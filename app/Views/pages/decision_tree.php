<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-4">
    <div class="border-b border-slate-200 pb-3">
        <h2 class="text-2xl font-semibold">Decision Tree Visual Lab</h2>
        <p class="text-slate-500">Interactive axis-aligned splitting simulator for binary classification.</p>
    </div>

    <div class="space-y-2">
        <section x-data="{ open: true }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span>1) How a Decision Tree Learns</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p>A decision tree recursively splits data into smaller regions. In this simulator, each split is axis-aligned and uses either <code>x</code> or <code>y</code> with a threshold.</p>
                <p>Each internal node asks a rule like <code>x &lt;= 22</code>. Leaf nodes output class probabilities and a final class label.</p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span>2) Split Quality: Gini Impurity</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p>For class proportions <code>p_k</code>, Gini impurity is:</p>
                <p class="text-center">$$ G = 1 - \sum_k p_k^2 $$</p>
                <p>The model tries candidate splits and picks the one that minimizes weighted child impurity.</p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span>3) Stopping Criteria and Generalization</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <ul class="list-disc pl-5 space-y-1">
                    <li>Maximum depth limits tree complexity.</li>
                    <li>Minimum samples avoids unstable micro-splits.</li>
                    <li>Pure leaves (all one class) stop naturally.</li>
                </ul>
                <p>Shallower trees usually generalize better, while deeper trees can overfit local noise.</p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span>4) Suggested Workflow</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700">
                <ol class="list-decimal pl-5 space-y-1">
                    <li>Add points for class A and class B, or load a preset demo pattern.</li>
                    <li>Train with different max depth / min samples settings.</li>
                    <li>Observe region boundaries, text tree rules, and split logs.</li>
                    <li>Compare simple vs complex trees for interpretability and fit quality.</li>
                </ol>
            </div>
        </section>
    </div>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-12">
        <div class="lg:col-span-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <canvas id="canvas" class="w-full rounded border border-slate-200 bg-white" style="height:440px;"></canvas>

                <div class="mt-3 flex flex-wrap items-center gap-2">
                    <button id="btn-classA" class="rounded-lg border border-cyan-300 bg-cyan-100 px-3 py-1.5 text-sm text-cyan-900">Class A</button>
                    <button id="btn-classB" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm">Class B</button>
                    <button id="btn-train" class="rounded-lg bg-slate-900 px-3 py-1.5 text-sm text-white">Train</button>
                    <button id="btn-clear" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm">Clear</button>

                    <select id="demoType" class="rounded-lg border border-slate-300 px-2 py-1.5 text-sm">
                        <option value="random_clusters">Random Mixed Clusters</option>
                        <option value="concentric">Concentric (Center vs Ring)</option>
                        <option value="xor">XOR Pattern</option>
                        <option value="overlap">Overlapping Clusters</option>
                    </select>
                    <button id="btn-demo-load" class="rounded-lg border border-emerald-300 bg-emerald-50 px-3 py-1.5 text-sm text-emerald-800">Load Demo</button>

                    <label class="text-sm">Max Depth:
                        <input id="maxDepth" type="number" value="4" min="1" max="12" class="ml-1 w-20 rounded-lg border border-slate-300 px-2 py-1">
                    </label>
                    <label class="text-sm">Min Samples:
                        <input id="minSamples" type="number" value="5" min="1" class="ml-1 w-20 rounded-lg border border-slate-300 px-2 py-1">
                    </label>
                    <label class="inline-flex items-center gap-2 text-sm">
                        <input type="checkbox" id="showRegions" checked class="h-4 w-4 rounded border-slate-300">
                        <span>Show Regions</span>
                    </label>
                </div>

                <p class="mt-2 text-sm text-slate-500">Click the canvas to add samples on grid cells, then train to generate split rules and decision regions.</p>
            </div>
        </div>

        <div class="space-y-4 lg:col-span-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-2 text-lg font-semibold">Model Info</h5>
                <div><strong>Points:</strong> <span id="countA">0</span> A | <span id="countB">0</span> B</div>
                <div class="mt-2"><strong>Last Split Score:</strong> <span id="score">-</span></div>
                <div class="mt-2">
                    <label class="mb-1 block text-xs uppercase tracking-wide text-slate-500">Points A</label>
                    <input id="pointsAList" class="w-full rounded border border-slate-300 px-2 py-1 text-xs font-mono" readonly>
                </div>
                <div class="mt-2">
                    <label class="mb-1 block text-xs uppercase tracking-wide text-slate-500">Points B</label>
                    <input id="pointsBList" class="w-full rounded border border-slate-300 px-2 py-1 text-xs font-mono" readonly>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-2 text-lg font-semibold">Decision Tree (Text)</h5>
                <pre id="treeText" class="max-h-64 overflow-auto rounded border border-slate-200 bg-slate-50 p-3 text-xs text-slate-700"></pre>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-2 text-lg font-semibold">Split Calculation Log</h5>
                <pre id="calcLog" class="max-h-64 overflow-auto rounded border border-slate-200 bg-slate-50 p-3 text-xs text-slate-700"></pre>
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
<script src="/assets/js/decision_tree.js"></script>
<?= $this->endSection() ?>
