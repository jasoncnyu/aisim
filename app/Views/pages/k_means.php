<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-4">
    <div class="border-b border-slate-200 pb-3">
        <h2 class="text-2xl font-semibold">K-Means Clustering Lab</h2>
        <p class="text-slate-500">Interactive 2D clustering simulator with Voronoi regions, centroid updates, and inertia tracking.</p>
    </div>

    <div class="space-y-2">
        <section x-data="{ open: true }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span>1) What K-Means Optimizes</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p>K-Means partitions data into <code>K</code> clusters by minimizing within-cluster squared distance (inertia).</p>
                <p class="text-center">$$ J = \sum_{i=1}^{N} \min_{1 \leq j \leq K} \left\lVert x_i - \mu_j \right\rVert^2 $$</p>
                <p>Each sample is assigned to the nearest centroid, then centroids are recomputed as the mean of assigned samples.</p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span>2) Lloyd's Iteration (Assign then Update)</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p>The algorithm alternates between two deterministic steps:</p>
                <p class="text-center">$$ c_i \leftarrow \arg\min_j \lVert x_i - \mu_j \rVert^2 $$</p>
                <p class="text-center">$$ \mu_j \leftarrow \frac{1}{|C_j|}\sum_{x_i \in C_j} x_i $$</p>
                <p>Inertia decreases monotonically until convergence to a local optimum.</p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span>3) Why Initialization Matters</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p><strong>Random</strong> initialization is simple but can start from poor seeds.</p>
                <p><strong>k-means++</strong> spreads initial centroids, often yielding faster convergence and lower final inertia.</p>
                <p>Use multiple runs with different seeds in production to reduce local-minimum sensitivity.</p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span>4) Suggested Experiment Workflow</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700">
                <ol class="list-decimal pl-5 space-y-1">
                    <li>Load demo points, then compare <strong>Random</strong> vs <strong>k-means++</strong> initialization.</li>
                    <li>Try different <code>K</code> values and inspect region boundaries and cluster counts.</li>
                    <li>Use <strong>Step</strong> to inspect one assign/update cycle at a time.</li>
                    <li>Run until convergence and compare final inertia values across settings.</li>
                </ol>
            </div>
        </section>
    </div>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-12">
        <div class="lg:col-span-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <canvas id="kmeansCanvas" class="w-full rounded border border-slate-200 bg-white" style="height:520px;"></canvas>

                <div class="mt-3 flex flex-wrap items-center gap-2">
                    <label class="text-sm">K:
                        <input id="kVal" type="number" value="3" min="1" max="12" class="ml-1 w-20 rounded-lg border border-slate-300 px-2 py-1">
                    </label>
                    <label class="text-sm">Init:
                        <select id="initMethod" class="ml-1 rounded-lg border border-slate-300 px-2 py-1">
                            <option value="random">Random</option>
                            <option value="kmeans++">k-means++</option>
                        </select>
                    </label>
                    <label class="text-sm">Region Density:
                        <input id="res" type="number" value="120" min="40" max="300" class="ml-1 w-24 rounded-lg border border-slate-300 px-2 py-1">
                    </label>

                    <div class="ml-auto flex flex-wrap gap-2">
                        <button id="btn-demo" class="rounded-lg border border-emerald-300 bg-emerald-50 px-3 py-1.5 text-sm text-emerald-800">Load Demo</button>
                        <button id="btn-init" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm">Init Centroids</button>
                        <button id="btn-step" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm">Step</button>
                        <button id="btn-run" class="rounded-lg bg-green-700 px-3 py-1.5 text-sm text-white">Run</button>
                        <button id="btn-stop" class="rounded-lg border border-amber-300 bg-amber-50 px-3 py-1.5 text-sm text-amber-900">Stop</button>
                        <button id="btn-clear" class="rounded-lg border border-rose-300 bg-rose-50 px-3 py-1.5 text-sm text-rose-900">Clear</button>
                    </div>
                </div>

                <p class="mt-2 text-sm text-slate-500">Click anywhere on the canvas to add points. Long-press on touch devices or right-click to remove the nearest point.</p>
            </div>
        </div>

        <div class="space-y-4 lg:col-span-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-2 text-lg font-semibold">Status</h5>
                <div><strong>Points:</strong> <span id="countPts">0</span></div>
                <div class="mt-1"><strong>K:</strong> <span id="curK">3</span></div>
                <div class="mt-1"><strong>Iteration:</strong> <span id="iter">0</span></div>
                <div class="mt-1"><strong>Inertia:</strong> <span id="inertia">-</span></div>
                <div class="mt-1"><strong>Centroid Shift:</strong> <span id="shift">-</span></div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-2 text-lg font-semibold">Inertia Curve</h5>
                <canvas id="inertiaChart" class="w-full rounded border border-slate-200 bg-white" style="height:180px;"></canvas>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h5 class="mb-2 text-lg font-semibold">Cluster Summary</h5>
                <pre id="clusterText" class="max-h-64 overflow-auto rounded border border-slate-200 bg-slate-50 p-3 text-xs text-slate-700"></pre>
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
<script src="/assets/js/k_means.js"></script>
<?= $this->endSection() ?>
