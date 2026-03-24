<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-4">
    <div class="border-b border-slate-200 pb-3">
        <h2 class="text-2xl font-semibold"><?= lang('WebLLM.title') ?></h2>
        <p class="text-slate-500"><?= lang('WebLLM.subtitle') ?></p>
    </div>

    <div class="space-y-2">
        <section x-data="{ open: true }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span><?= lang('WebLLM.accordion.1.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p><?= lang('WebLLM.accordion.1.p1') ?></p>
                <p><?= lang('WebLLM.accordion.1.p2') ?></p>
            </div>
        </section>

        <section x-data="{ open: false }" class="rounded-xl border border-slate-200 bg-white">
            <button type="button" class="w-full px-4 py-3 text-left font-medium flex items-center justify-between" @click="open = !open">
                <span><?= lang('WebLLM.accordion.2.title') ?></span>
                <span class="text-slate-500" x-text="open ? '-' : '+'"></span>
            </button>
            <div x-show="open" x-transition x-cloak class="px-4 pb-4 text-sm text-slate-700 space-y-2">
                <p><?= lang('WebLLM.accordion.2.p1') ?></p>
                <p class="text-center"><?= lang('WebLLM.accordion.2.equation') ?></p>
                <p><?= lang('WebLLM.accordion.2.p2') ?></p>
            </div>
        </section>
    </div>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-12">
        <div class="space-y-4 lg:col-span-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h3 class="mb-2 text-lg font-semibold"><?= lang('WebLLM.train.title') ?></h3>
                <textarea id="trainText" class="h-44 w-full rounded-lg border border-slate-300 p-3 text-sm" placeholder="Paste training text. Example: once upon a time there was a small model learning words from context.">Please enter the text you want to train the model on here . The length of the training data and the number of words matter . If the hyperparameters are not chosen carefully the model may fail to learn .
You can use this text itself as the training data . We have already set reasonable hyperparameters for this demo . Just click Start Training below to begin .

After training go to click Generate button . This model is extremely simple . It will mostly repeat the training text like it is from memory . However the output is still generated according to the basic principles of a language model .
You can modify the prompt if you want . However you must use only the words that appear in this training data . This is because the vocabulary used in this dataset is the entire vocabulary that this model knows .</textarea>
                <div class="mt-3 flex flex-wrap items-center gap-2 text-sm">
                    <span class="text-slate-500"><?= lang('WebLLM.train.load_demo') ?></span>
                    <button type="button" class="demo-load rounded-lg border border-slate-300 px-3 py-1.5 text-xs" data-demo="obama">obama.txt</button>
                    <button type="button" class="demo-load rounded-lg border border-slate-300 px-3 py-1.5 text-xs" data-demo="princess">princess.txt</button>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h3 class="mb-2 text-lg font-semibold"><?= lang('WebLLM.hyper.title') ?></h3>
                <div class="grid grid-cols-2 gap-3 md:grid-cols-4">
                    <label class="text-sm"><?= lang('WebLLM.hyper.embed') ?>
                        <input type="number" id="embedDim" class="mt-1 block w-full rounded-lg border border-slate-300 px-2 py-1.5" value="32" min="4" max="256">
                    </label>
                    <label class="text-sm"><?= lang('WebLLM.hyper.context') ?>
                        <input type="number" id="blockSize" class="mt-1 block w-full rounded-lg border border-slate-300 px-2 py-1.5" value="4" min="1" max="16">
                    </label>
                    <label class="text-sm"><?= lang('WebLLM.hyper.epochs') ?>
                        <input type="number" id="epochs" class="mt-1 block w-full rounded-lg border border-slate-300 px-2 py-1.5" value="100" min="1" max="100">
                    </label>
                    <label class="text-sm"><?= lang('WebLLM.hyper.lr') ?>
                        <input type="number" id="lr" class="mt-1 block w-full rounded-lg border border-slate-300 px-2 py-1.5" value="0.2" step="0.05" min="0.01" max="1.0">
                    </label>
                </div>
                <div class="mt-3 flex flex-wrap items-center gap-4 text-sm">
                    <label class="inline-flex items-center gap-2">
                        <input type="checkbox" id="trainEmbeddings" checked class="h-4 w-4 rounded border-slate-300">
                        <span><?= lang('WebLLM.hyper.train_embeddings') ?></span>
                    </label>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h3 class="mb-2 text-lg font-semibold"><?= lang('WebLLM.run.title') ?></h3>
                <div class="flex items-center gap-3">
                    <button id="trainBtn" class="rounded-lg bg-slate-900 px-3 py-1.5 text-sm text-white"><?= lang('WebLLM.run.start') ?></button>
                    <button id="trainStopBtn" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('WebLLM.run.stop') ?></button>
                    <span id="trainStatus" class="text-sm text-slate-600"></span>
                </div>
                <div class="mt-3 h-3 w-full overflow-hidden rounded-full bg-slate-200">
                    <div id="trainProgress" class="h-full bg-blue-600 transition-all" style="width:0%"></div>
                </div>
                <div class="mt-2 text-xs text-slate-500"><span id="trainProgressText">0%</span></div>
                <pre id="lossLog" class="mt-3 h-52 max-h-80 resize-y overflow-auto rounded border border-slate-200 bg-slate-50 p-3 text-xs text-slate-700"></pre>
                <div class="mt-3">
                    <canvas id="lossChart" class="w-full rounded border border-slate-200 bg-white" height="100"></canvas>
                </div>
            </div>
        </div>

        <div class="space-y-4 lg:col-span-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h3 class="mb-2 text-lg font-semibold"><?= lang('WebLLM.generate.title') ?></h3>
                <label class="text-sm"><?= lang('WebLLM.generate.prompt') ?>
                    <input id="prompt" class="mt-1 block w-full rounded-lg border border-slate-300 px-2 py-1.5" value="After training go to click Generate button .">
                </label>
                <div class="mt-3 grid grid-cols-2 gap-2">
                    <label class="text-sm"><?= lang('WebLLM.generate.tokens') ?>
                        <input type="number" id="genTokens" class="mt-1 block w-full rounded-lg border border-slate-300 px-2 py-1.5" value="30" min="1" max="200">
                    </label>
                    <label class="text-sm"><?= lang('WebLLM.generate.temperature') ?>
                        <input type="number" id="temperature" class="mt-1 block w-full rounded-lg border border-slate-300 px-2 py-1.5" value="1.0" step="0.1" min="0.1" max="2.0">
                    </label>
                </div>
                <div class="mt-3 flex flex-wrap items-center gap-3 text-sm">
                    <label class="inline-flex items-center gap-2"><input class="h-4 w-4" type="radio" name="sampling" value="greedy" checked><span><?= lang('WebLLM.generate.greedy') ?></span></label>
                    <label class="inline-flex items-center gap-2"><input class="h-4 w-4" type="radio" name="sampling" value="sample"><span><?= lang('WebLLM.generate.sampling') ?></span></label>
                    <div class="inline-flex items-center gap-2">
                        <label class="inline-flex items-center gap-2"><input class="h-4 w-4" type="radio" name="sampling" value="topk"><span><?= lang('WebLLM.generate.topk') ?></span></label>
                        <span id="topkWrap">
                            <input type="number" id="topkK" class="h-8 w-20 rounded-lg border border-slate-300 px-2 py-1 text-sm" value="5" min="1" max="50">
                        </span>
                    </div>
                </div>
                <button id="genBtn" class="mt-3 rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('WebLLM.generate.generate') ?></button>
                <pre id="genOut" class="mt-3 min-h-28 whitespace-pre-wrap break-words rounded border border-slate-200 bg-slate-50 p-3 text-xs text-slate-700"></pre>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="/assets/js/web_llm.js?update=2"></script>
<?= $this->endSection() ?>
