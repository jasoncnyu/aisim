<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="rounded-2xl bg-white border border-slate-200 p-6 shadow-sm">
    <h2 class="text-xl font-semibold mb-4">Products</h2>
    <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
        <div class="rounded-xl border border-slate-200 p-4">
            <p class="font-medium">Starter Plan</p>
            <p class="text-sm text-slate-500">Entry product example card.</p>
        </div>
        <div class="rounded-xl border border-slate-200 p-4">
            <p class="font-medium">Business Plan</p>
            <p class="text-sm text-slate-500">Mid-tier product example card.</p>
        </div>
        <div class="rounded-xl border border-slate-200 p-4">
            <p class="font-medium">Enterprise Plan</p>
            <p class="text-sm text-slate-500">Top-tier product example card.</p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
