<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="rounded-2xl bg-white border border-slate-200 p-6 shadow-sm">
    <h2 class="text-xl font-semibold mb-4">Orders</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="text-left text-slate-500 border-b border-slate-200">
                <tr>
                    <th class="py-2 pr-4">Order No.</th>
                    <th class="py-2 pr-4">Customer</th>
                    <th class="py-2 pr-4">Status</th>
                    <th class="py-2 pr-4">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-slate-100">
                    <td class="py-2 pr-4">#1024</td>
                    <td class="py-2 pr-4">Alice</td>
                    <td class="py-2 pr-4">Paid</td>
                    <td class="py-2 pr-4">$120.00</td>
                </tr>
                <tr class="border-b border-slate-100">
                    <td class="py-2 pr-4">#1025</td>
                    <td class="py-2 pr-4">Bob</td>
                    <td class="py-2 pr-4">Pending</td>
                    <td class="py-2 pr-4">$89.00</td>
                </tr>
                <tr>
                    <td class="py-2 pr-4">#1026</td>
                    <td class="py-2 pr-4">Charlie</td>
                    <td class="py-2 pr-4">Shipped</td>
                    <td class="py-2 pr-4">$244.00</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
