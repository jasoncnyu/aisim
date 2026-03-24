<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-4">
    <div class="border-b border-slate-200 pb-3">
        <h2 class="text-2xl font-semibold">XOR Neural Network Lab</h2>
        <p class="text-slate-500">Forward/Backward pass visualization for a tiny multi-layer perceptron.</p>
    </div>

    <div class="space-y-2">
        <section x-data="{ open: true }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span>1) Why XOR Is a Classic Neural Network Demo</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p>XOR cannot be solved by a single linear separator. A model must learn a non-linear decision surface.</p>
                <p>This makes XOR the standard toy problem for demonstrating hidden layers and non-linear activations.</p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span>2) Network Structure Used Here</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p>The simulator uses a compact MLP:</p>
                <p class="text-center">Input(2) -> Hidden(4) -> Hidden(2) -> Output(1)</p>
                <p>Output activation is sigmoid for binary probability. Hidden activation can be <code>tanh</code> or <code>ReLU</code>.</p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span>3) Training Dynamics</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p>Each step samples one XOR case, performs a forward pass, computes loss, then applies backpropagation updates.</p>
                <p class="text-center">$$ z^{(l)} = a^{(l-1)}W^{(l)} + b^{(l)}, \quad a^{(l)} = f(z^{(l)}) $$</p>
                <p class="text-center">$$ W \leftarrow W - \eta \nabla_W L, \quad b \leftarrow b - \eta \nabla_b L $$</p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span>4) How To Read the Visuals</span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700">
                <ul class="list-disc pl-5 space-y-1">
                    <li>Loss chart shows convergence trend over training steps.</li>
                    <li>Prediction panel displays output confidence for all four XOR inputs.</li>
                    <li>Calculation panel logs the latest forward/backward values for inspection.</li>
                </ul>
            </div>
        </section>
    </div>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-12">
        <div class="space-y-4 lg:col-span-7">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h3 class="mb-3 text-lg font-semibold">Training Controls</h3>
                <div class="flex flex-wrap items-end gap-3">
                    <label class="text-sm">Learning Rate
                        <input id="lr" type="number" value="0.05" step="0.01" class="mt-1 block w-28 rounded-lg border border-slate-300 px-2 py-1.5">
                    </label>
                    <label class="text-sm">Sleep (ms)
                        <input id="sleep" type="number" value="5" min="0" class="mt-1 block w-24 rounded-lg border border-slate-300 px-2 py-1.5">
                    </label>
                    <label class="text-sm">Activation
                        <select id="act" class="mt-1 block w-28 rounded-lg border border-slate-300 px-2 py-1.5">
                            <option value="tanh">tanh</option>
                            <option value="relu">ReLU</option>
                        </select>
                    </label>
                </div>

                <div class="mt-3 flex flex-wrap gap-2">
                    <button id="train1" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm">+1 Step</button>
                    <button id="auto" class="rounded-lg bg-slate-900 px-3 py-1.5 text-sm text-white">Auto Train</button>
                    <button id="reset" class="rounded-lg border border-red-300 bg-red-50 px-3 py-1.5 text-sm text-red-700">Reset</button>
                </div>

                <div class="mt-3 text-sm text-slate-700">Step: <span id="step">0</span> | Loss: <span id="loss">-</span></div>
                <canvas id="lossChart" class="mt-3 w-full rounded border border-slate-200 bg-white" style="height:220px;"></canvas>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h3 class="mb-2 text-lg font-semibold">Forward/Backward Trace</h3>
                <pre id="calcFlow" class="max-h-[420px] overflow-auto rounded border border-slate-200 bg-slate-50 p-3 text-xs text-slate-700"></pre>
            </div>
        </div>

        <div class="space-y-4 lg:col-span-5">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm text-center">
                <h3 class="mb-2 text-lg font-semibold">Prediction Snapshot</h3>
                <canvas id="predChart" class="mx-auto w-full max-w-[340px] rounded border border-slate-200 bg-white" style="height:320px;"></canvas>
                <p class="mt-2 text-xs text-slate-500">Larger circles indicate higher output probability near class 1.</p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h3 class="mb-2 text-lg font-semibold">XOR Targets</h3>
                <ul class="list-disc pl-5 text-sm text-slate-700 space-y-1">
                    <li>(0,0) -> 0</li>
                    <li>(0,1) -> 1</li>
                    <li>(1,0) -> 1</li>
                    <li>(1,1) -> 0</li>
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
