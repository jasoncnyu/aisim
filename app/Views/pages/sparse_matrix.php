<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-4">
    <div class="border-b border-slate-200 pb-3">
        <h2 class="text-2xl font-semibold">Sparse Matrix Lab</h2>
        <p class="text-slate-500">Encode sparse matrices with classic formats and compare compression trade-offs.</p>
    </div>

    <div class="space-y-2">
        <section x-data="{ open: true }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="flex w-full items-center justify-between px-4 py-3 text-left font-medium" @click="open = !open">
                <span>1) Why Sparse Formats Exist</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p>Many real-world matrices are mostly zeros. Storing every zero wastes memory and slows computation.</p>
                <p>Sparse formats store only the important entries and their positions. This can reduce storage and speed up linear algebra.</p>
            </div>
        </section>
        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="flex w-full items-center justify-between px-4 py-3 text-left font-medium" @click="open = !open">
                <span>2) Encoding Families</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p><strong>COO:</strong> explicit (row, col, value) triples.</p>
                <p><strong>CSR / CSC:</strong> compact row-wise or column-wise indexing for fast traversal.</p>
                <p><strong>RLE:</strong> run-length encoding for rows with long stretches of zeros.</p>
                <p><strong>Dictionary / Bitmap:</strong> lightweight encodings for fast lookup or compact bit patterns.</p>
            </div>
        </section>
        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="flex w-full items-center justify-between px-4 py-3 text-left font-medium" @click="open = !open">
                <span>3) How to Use</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <ol class="list-decimal space-y-1 pl-5">
                    <li>Generate or edit a matrix.</li>
                    <li>Select an encoding format and click Encode.</li>
                    <li>Reconstruct to verify correctness and compare sizes.</li>
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
                        <input id="rows" type="number" min="1" max="200" value="6" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">
                    </label>
                    <label class="text-sm">Cols
                        <input id="cols" type="number" min="1" max="200" value="12" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">
                    </label>
                </div>
                <div>
                    <label class="text-sm">Density (non-zero %)</label>
                    <input id="density" type="range" min="0" max="50" value="10" class="mt-2 w-full">
                    <div class="text-xs text-slate-500">Current: <span id="densityVal">10%</span></div>
                </div>
                <label class="text-sm">Value Mode
                    <select id="valMode" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">                        <option value="randInt">Random Integers (1..9)</option>
                        <option value="weighted">Weighted Floats (0..1)</option>
                    </select>
                </label>
                <div class="flex flex-wrap gap-2">
                    <button id="genRandom" class="rounded-lg bg-slate-900 px-3 py-1.5 text-sm text-white">Generate</button>
                    <button id="resetMatrix" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm">Reset</button>
                </div>

                            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm space-y-3">
                <h3 class="text-lg font-semibold">Encoding</h3>
                <label class="text-sm">Compression Format
                    <select id="encFormat" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">
                        <option value="coo">COO (Coordinate list)</option>
                        <option value="csr">CSR (Compressed Sparse Row)</option>
                        <option value="csc">CSC (Compressed Sparse Column)</option>
                        <option value="rle">RLE (Row-wise Run-Length)</option>
                        <option value="dict">Dictionary (row -> {col: value})</option>
                        <option value="bitmap">Bitmap (packed bits)</option>
                    </select>
                </label>
                <div class="flex flex-wrap gap-2">
                    <button id="encodeBtn" class="rounded-lg bg-emerald-700 px-3 py-1.5 text-sm text-white">Encode</button>
                    <button id="reconstructBtn" class="rounded-lg border border-amber-300 bg-amber-50 px-3 py-1.5 text-sm text-amber-800">Reconstruct</button>
                    <button id="downloadAll" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm">Download JSON</button>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm space-y-1 text-sm">
                <h3 class="text-lg font-semibold">Summary</h3>
                <div><strong>Dimensions:</strong> <span id="statDim">-</span></div>
                <div><strong>Non-zero count:</strong> <span id="statNNZ">-</span></div>
                <div><strong>Raw size (dense):</strong> <span id="statDenseBytes">-</span> bytes</div>
                <div><strong>Compressed size (est.):</strong> <span id="statCompressedBytes">-</span> bytes</div>
                <div><strong>Compression ratio:</strong> <span id="statRatio">-</span></div>
                <div><strong>Reconstruction:</strong> <span id="statRecon">-</span></div>
            </div>
        </div>

        <div class="space-y-4 lg:col-span-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h3 class="text-lg font-semibold">Original Matrix (click to edit)</h3>
                <div id="matrixContainer" class="mt-2 max-h-64 overflow-auto rounded border border-slate-200 bg-white p-2"></div>
                <p class="mt-2 text-xs text-slate-500">Click a cell to edit. Empty values become zero.</p>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                    <div class="flex items-center justify-between">
                        <h4 class="text-sm font-semibold">Encoded Result</h4>
                        <button id="togglePretty" type="button" class="rounded-lg border border-slate-300 px-2.5 py-1 text-xs">Pretty view</button>
                    </div>
                    <pre id="encResults" class="mt-2 max-h-72 overflow-auto rounded-lg bg-slate-950/5 p-3 text-xs text-slate-700"></pre>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                    <h4 class="text-sm font-semibold">Matrix JSON</h4>
                    <pre id="matrixJSON" class="mt-2 max-h-72 overflow-auto rounded-lg bg-slate-950/5 p-3 text-xs text-slate-700"></pre>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h4 class="text-sm font-semibold">Notes</h4>
                <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-slate-700">
                    <li>COO is simple but not cache-friendly for large matrices.</li>
                    <li>CSR is fast for row slicing; CSC is fast for column slicing.</li>
                    <li>RLE is best when long runs of zeros appear in rows.</li>
                    <li>Bitmap works well for structural sparsity, but values still need storage.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="/assets/js/sparse_matrix.js"></script>
<?= $this->endSection() ?>

