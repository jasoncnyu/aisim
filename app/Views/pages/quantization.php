<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-4">
    <div class="border-b border-slate-200 pb-3">
        <h2 class="text-2xl font-semibold">Quantization Lab</h2>
        <p class="text-slate-500">Compress weights into low-bit formats and visualize the accuracy trade-offs.</p>
    </div>

    <div class="space-y-2">
        <section x-data="{ open: true }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="flex w-full items-center justify-between px-4 py-3 text-left font-medium" @click="open = !open">
                <span>1) Why Quantization Matters</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p>Modern models are large and memory-heavy. Quantization reduces each weight from 32-bit floats to fewer bits (often 8, 4, or even 1), shrinking the model and speeding up inference.</p>
                <p>The core trade-off is accuracy versus efficiency. With careful calibration, low-bit models can retain most performance while running faster on commodity hardware.</p>
            </div>
        </section>
        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="flex w-full items-center justify-between px-4 py-3 text-left font-medium" @click="open = !open">
                <span>2) Quantization Modes</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p><strong>Uniform Symmetric:</strong> scales weights around zero; simple and hardware-friendly.</p>
                <p><strong>Uniform Asymmetric:</strong> shifts the range to better fit non-zero distributions.</p>
                <p><strong>Dynamic Range (per-row):</strong> uses a separate scale for each row, improving fidelity on heterogeneous matrices.</p>
                <p><strong>Log / Binary / Ternary:</strong> aggressive compression for extreme efficiency, at the cost of distortion.</p>
            </div>
        </section>
        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="flex w-full items-center justify-between px-4 py-3 text-left font-medium" @click="open = !open">
                <span>3) How to Use This Lab</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <ol class="list-decimal space-y-1 pl-5">
                    <li>Generate a random matrix or set its density.</li>
                    <li>Select a quantization mode and bit-width.</li>
                    <li>Apply quantization and inspect MSE, PSNR, and the error heatmap.</li>
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
                    <div class="text-xs text-slate-500">Current: <span id="densityVal">100%</span></div>
                </div>
                <div class="flex flex-wrap gap-2">
                    <button id="genRandom" class="rounded-lg bg-slate-900 px-3 py-1.5 text-sm text-white">Generate</button>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm space-y-3">
                <h3 class="text-lg font-semibold">Quantization Settings</h3>
                <label class="text-sm">Quantization Type
                    <select id="quantMode" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">
                        <option value="int8_sym">Uniform Symmetric (int8)</option>
                        <option value="uint8_asym">Uniform Asymmetric (uint8)</option>
                        <option value="row_dynamic">Dynamic Range (per-row)</option>
                        <option value="log">Log Quantization</option>
                        <option value="binary">Binary (sign)</option>
                        <option value="ternary">Ternary (-1, 0, +1)</option>
                    </select>
                </label>
                <label class="text-sm">Bit Width
                    <input id="bitWidth" type="number" min="2" max="8" value="4" class="mt-1 w-full rounded border border-slate-300 px-2 py-1.5 text-sm">
                </label>
                <div class="flex flex-wrap gap-2">
                    <button id="applyQuant" class="rounded-lg bg-emerald-700 px-3 py-1.5 text-sm text-white">Apply Quantization</button>
                    <button id="resetQuant" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm">Reset</button>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm space-y-1 text-sm">
                <h3 class="text-lg font-semibold">Summary</h3>
                <div><strong>Dimensions:</strong> <span id="statDim">-</span></div>
                <div><strong>Value Range:</strong> <span id="statRange">-</span></div>
                <div><strong>Quant Range:</strong> <span id="statQRange">-</span></div>
                <div><strong>MSE:</strong> <span id="statMSE">-</span></div>
                <div><strong>PSNR (dB):</strong> <span id="statPSNR">-</span></div>
                <div><strong>Avg |Error|:</strong> <span id="statErr">-</span></div>
                <div><strong>Bitrate:</strong> <span id="statBitrate">-</span> bits/value</div>
                <div><strong>Last Strategy:</strong> <span id="statStrategy">-</span></div>
            </div>
        </div>

        <div class="space-y-4 lg:col-span-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h3 class="text-lg font-semibold">Original Matrix</h3>
                <div id="matrixContainer" class="mt-2 max-h-56 overflow-auto rounded border border-slate-200 bg-white"></div>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                    <h4 class="text-sm font-semibold">Quantized Matrix (integers)</h4>
                    <div id="quantContainer" class="mt-2 max-h-52 overflow-auto rounded border border-slate-200 bg-white"></div>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                    <h4 class="text-sm font-semibold">Dequantized Matrix (floats)</h4>
                    <div id="dequantContainer" class="mt-2 max-h-52 overflow-auto rounded border border-slate-200 bg-white"></div>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h4 class="text-sm font-semibold">Error Heatmap (red = positive, blue = negative)</h4>
                <div id="errorContainer" class="mt-2 max-h-52 overflow-auto rounded border border-slate-200 bg-white"></div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <div class="flex items-center justify-between">
                    <h4 class="text-sm font-semibold">JSON Export</h4>
                    <button id="downloadJSON" type="button" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm">Download</button>
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
