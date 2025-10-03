<?= $this->extend('layout/template_view') ?>

<?= $this->section('content') ?>
    <div class="container mx-auto">
        <h2 class="text-2xl font-bold mb-4"><?= esc($title) ?></h2>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <form action="/bahanbaku/store" method="post">
                <?= csrf_field() ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">Nama Bahan</label>
                        <input type="text" id="nama" name="nama" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                    </div>
                    <div>
                        <label for="kategori" class="block text-gray-700 text-sm font-bold mb-2">Kategori</label>
                        <input type="text" id="kategori" name="kategori" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                    </div>
                    <div>
                        <label for="jumlah" class="block text-gray-700 text-sm font-bold mb-2">Jumlah</label>
                        <input type="number" id="jumlah" name="jumlah" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                    </div>
                    <div>
                        <label for="satuan" class="block text-gray-700 text-sm font-bold mb-2">Satuan</label>
                        <input type="text" id="satuan" name="satuan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                    </div>
                    <div>
                        <label for="tanggal_masuk" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Masuk</label>
                        <input type="date" id="tanggal_masuk" name="tanggal_masuk" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                    </div>
                    <div>
                        <label for="tanggal_kadaluarsa" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Kadaluarsa</label>
                        <input type="date" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                    </div>
                </div>
                <div class="mt-6">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
                    <a href="/dashboard" class="ml-4 text-gray-600 hover:underline">Batal</a>
                </div>
            </form>
        </div>
    </div>
<?= $this->endSection() ?>