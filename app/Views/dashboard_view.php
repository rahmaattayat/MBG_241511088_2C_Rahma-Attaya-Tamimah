<?= $this->extend('layout/template_view') ?>

<?= $this->section('content') ?>
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Dashboard</h2>
        <p>Anda login sebagai <span class="font-bold"><?= esc(session()->get('user_role')) ?></span>.</p>
    </div>
<?= $this->endSection() ?>