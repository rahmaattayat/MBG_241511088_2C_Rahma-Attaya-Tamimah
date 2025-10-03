<?= $this->extend('layout/template_view') ?>

<?= $this->section('content') ?>
    <div class="container mx-auto">
        <h2 class="text-2xl font-bold mb-4"><?= esc($title) ?></h2>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <form action="/bahanbaku/update/<?= $bahan['id'] ?>" method="post">
                <?= csrf_field() ?>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Nama Bahan</label>
                    <p class="text-gray-800 text-lg"><?= esc($bahan['nama']) ?></p>
                </div>

                <div class="mb-4">
                    <label for="jumlah" class="block text-gray-700 text-sm font-bold mb-2">Jumlah Stok Baru</label>
                    <input type="number" id="jumlah" name="jumlah" value="<?= esc($bahan['jumlah']) ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required min="0">
                </div>

                <div class="mt-6">
                    <button type="submit" class="bg-brand-green-light hover:bg-brand-green-muted text-gray-800 font-bold py-2 px-4 rounded">Update Stok</button>
                    <a href="/bahanbaku" class="ml-4 text-gray-600 hover:underline">Batal</a>
                </div>
            </form>
        </div>
    </div>
<?= $this->endSection() ?>