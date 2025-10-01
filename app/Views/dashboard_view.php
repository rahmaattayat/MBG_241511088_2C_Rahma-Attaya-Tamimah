<?= $this->extend('layout/template_view') ?>

<?= $this->section('content') ?>
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">Dashboard</h2>
        </div>
        <p>Anda login sebagai <span class="font-bold"><?= esc(session()->get('user_role')) ?></span>.</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-md">
        <?php if (session()->get('user_role') === 'gudang'): ?>
                <a href="/dashboard/tambah-bahan-baku" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Tambah Bahan Baku
                </a>
            <?php endif; ?>
    </div>
<?= $this->endSection() ?>