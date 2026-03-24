<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<style {csp-style-nonce}>
    @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&family=Sora:wght@500;600;700&display=swap');
    .landing-shell { font-family: 'Manrope', system-ui, -apple-system, sans-serif; }
    .landing-title { font-family: 'Sora', 'Manrope', system-ui, sans-serif; }
</style>
<div class="landing-shell space-y-12">
    <section class="relative overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
        <div class="absolute inset-0 bg-gradient-to-br from-slate-950 via-slate-900 to-slate-800"></div>
        <div class="absolute -right-24 -top-20 h-80 w-80 rounded-full bg-amber-400/20 blur-3xl"></div>
        <div class="absolute -left-24 bottom-0 h-80 w-80 rounded-full bg-cyan-400/20 blur-3xl"></div>
        <div class="relative space-y-6 p-8 text-white">
            <p class="text-xs uppercase tracking-[0.3em] text-slate-300"><?= lang('MainPage.tagline') ?></p>
            <div class="space-y-3">
                <h2 class="landing-title text-4xl font-semibold"><?= lang('MainPage.title') ?></h2>
                <p class="max-w-3xl text-slate-200"><?= lang('MainPage.description') ?></p>
            </div>
            <div class="flex flex-wrap gap-2">
                <span class="rounded-full bg-white/10 px-3 py-1 text-xs font-semibold text-white"><?= lang('MainPage.labels.interactive_labs') ?></span>
                <span class="rounded-full bg-white/10 px-3 py-1 text-xs font-semibold text-white"><?= lang('MainPage.labels.live_training') ?></span>
                <span class="rounded-full bg-white/10 px-3 py-1 text-xs font-semibold text-white"><?= lang('MainPage.labels.explainable_visuals') ?></span>
                <span class="rounded-full bg-white/10 px-3 py-1 text-xs font-semibold text-white"><?= lang('MainPage.labels.guided_experiments') ?></span>
            </div>
            <div class="flex flex-wrap gap-2 pt-2">
                <a href="/linear-regression" class="rounded-lg bg-white px-4 py-2 text-sm font-semibold text-slate-900"><?= lang('MainPage.cta.start_learning') ?></a>
                <a href="/cnn-mnist" class="rounded-lg border border-white/40 px-4 py-2 text-sm text-white"><?= lang('MainPage.cta.try_cnn_mnist') ?></a>
            </div>
        </div>
    </section>

    <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="text-center">
            <h3 class="landing-title text-2xl font-semibold"><?= lang('MainPage.howToUse.title') ?></h3>
            <p class="mt-2 text-sm text-slate-600"><?= lang('MainPage.howToUse.subtitle') ?></p>
        </div>
        <div class="mt-8 space-y-5">
            <?php foreach (lang('MainPage.howToUse.steps') as $step): ?>
            <div class="flex gap-4 rounded-xl border border-slate-200 bg-slate-50 p-4">
                <div class="mt-0.5 flex h-12 w-12 items-center justify-center rounded-full bg-slate-900 text-sm font-semibold text-white"><?= $step['number'] ?></div>
                <div class="text-slate-700">
                    <p class="text-sm font-semibold uppercase tracking-wide text-slate-500"><?= $step['label'] ?></p>
                    <p class="mt-1 text-sm"><strong><?= $step['title'] ?></strong> <?= $step['description'] ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="landing-title text-xl font-semibold"><?= lang('MainPage.learningTracks.title') ?></h3>
        <div class="mt-6 space-y-6">
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                <div class="flex items-center gap-3">
                    <div class="rounded-xl border border-slate-200 bg-white p-2 text-slate-600">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 18l6-6 4 4 6-8"/></svg>
                    </div>
                <h4 class="landing-title text-lg font-semibold"><?= lang('MainPage.learningTracks.machinelearning.title') ?></h4>
                </div>
                <p class="mt-2 text-sm text-slate-700"><?= lang('MainPage.learningTracks.machinelearning.description') ?></p>
                <p class="mt-2 text-sm text-slate-700"><?= lang('MainPage.learningTracks.machinelearning.question') ?></p>
                <div class="mt-3 flex flex-wrap gap-2">
                    <a href="/linear-regression" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('MainPage.learningTracks.machinelearning.labs.0') ?></a>
                    <a href="/logistic-regression" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('MainPage.learningTracks.machinelearning.labs.1') ?></a>
                    <a href="/decision-tree" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('MainPage.learningTracks.machinelearning.labs.2') ?></a>
                    <a href="/k-means" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('MainPage.learningTracks.machinelearning.labs.3') ?></a>
                    <a href="/knn" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('MainPage.learningTracks.machinelearning.labs.4') ?></a>
                    <a href="/svm" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm"><?= lang('MainPage.learningTracks.machinelearning.labs.5') ?></a>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                <div class="flex items-center gap-3">
                    <div class="rounded-xl border border-slate-200 bg-white p-2 text-slate-600">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><rect x="4" y="4" width="6" height="6" rx="1" stroke-width="1.8"/><rect x="14" y="4" width="6" height="6" rx="1" stroke-width="1.8"/><rect x="9" y="14" width="6" height="6" rx="1" stroke-width="1.8"/></svg>
                    </div>
                <h4 class="landing-title text-lg font-semibold"><?= lang('MainPage.learningTracks.deeplearning.title') ?></h4>
                </div>
                <p class="mt-2 text-sm text-slate-700"><?= lang('MainPage.learningTracks.deeplearning.description') ?></p>
                <p class="mt-2 text-sm text-slate-700"><?= lang('MainPage.learningTracks.deeplearning.question') ?></p>
                <div class="mt-3 flex flex-wrap gap-2">
                    <a href="/nn-regression" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm">NN Regression</a>
                    <a href="/cnn-binary" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm">CNN Binary</a>
                    <a href="/cnn-mnist" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm">CNN MNIST</a>
                    <a href="/xor" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm">XOR Lab</a>
                    <a href="/web-llm" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm">Tiny Web LLM</a>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                <div class="flex items-center gap-3">
                    <div class="rounded-xl border border-slate-200 bg-white p-2 text-slate-600">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 3v4m0 10v4m-7-7h4m10 0h4M7 7l3 3m4 4l3 3m0-10l-3 3m-4 4l-3 3"/></svg>
                    </div>
                <h4 class="landing-title text-lg font-semibold">Reinforcement Learning</h4>
                </div>
                <p class="mt-2 text-sm text-slate-700">Here the model is an agent that learns from rewards rather than labeled examples. You will explore exploration vs exploitation, sparse rewards, and the role of environment dynamics.</p>
                <p class="mt-2 text-sm text-slate-700">Use it to answer: When is it better to explore? How does reward structure shape behavior?</p>
                <div class="mt-3 flex flex-wrap gap-2">
                    <a href="/n-slot" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm">N-Slot Bandit</a>
                    <a href="/grid-world" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm">Grid World</a>
                </div>
            </div>
        </div>
    </section>

    <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h3 class="landing-title text-xl font-semibold">Quick Start Prompts</h3>
        <div class="mt-4 space-y-3 text-sm text-slate-700">
            <p><strong>New to ML?</strong> Begin with Linear Regression and Logistic Regression, then compare with Decision Trees.</p>
            <p><strong>Interested in curves?</strong> Use NN Regression to see how depth and width change the fit.</p>
            <p><strong>Want visual intuition?</strong> Jump into CNN MNIST and draw digits to test inference.</p>
        </div>
        <div class="mt-4 flex flex-wrap gap-2">
            <a href="/linear-regression" class="rounded-lg bg-slate-900 px-4 py-2 text-sm text-white">Start with Linear Regression</a>
            <a href="/nn-regression" class="rounded-lg border border-slate-300 px-4 py-2 text-sm">Explore NN Regression</a>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
