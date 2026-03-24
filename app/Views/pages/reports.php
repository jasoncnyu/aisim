<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="rounded-2xl bg-white border border-slate-200 p-6 shadow-sm">
    <h2 class="text-xl font-semibold mb-4">Reports</h2>
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-xl border border-slate-200 p-4">
            <p class="text-sm text-slate-500">Revenue</p>
            <p class="text-2xl font-semibold mt-1">$12,480</p>
        </div>
        <div class="rounded-xl border border-slate-200 p-4">
            <p class="text-sm text-slate-500">New Users</p>
            <p class="text-2xl font-semibold mt-1">324</p>
        </div>
        <div class="rounded-xl border border-slate-200 p-4">
            <p class="text-sm text-slate-500">Refunds</p>
            <p class="text-2xl font-semibold mt-1">14</p>
        </div>
        <div class="rounded-xl border border-slate-200 p-4">
            <p class="text-sm text-slate-500">Conversion</p>
            <p class="text-2xl font-semibold mt-1">4.8%</p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
