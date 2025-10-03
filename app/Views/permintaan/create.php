<?= $this->extend('layout/template_view') ?>

<?= $this->section('content') ?>
<div class="container mx-auto">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-800"><?= esc($title) ?></h2>
    </div>

    <form action="/permintaan/store" method="post" id="form-permintaan">
        <?= csrf_field() ?>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div>
                    <label for="tgl_masak" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Masak</label>
                    <input type="date" name="tgl_masak" id="tgl_masak" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" required>
                </div>
                <div>
                    <label for="menu_makan" class="block text-sm font-medium text-gray-700 mb-1">Menu yang Akan Dibuat</label>
                    <input type="text" name="menu_makan" id="menu_makan" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" required>
                </div>
                <div>
                    <label for="jumlah_porsi" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Porsi</label>
                    <input type="number" name="jumlah_porsi" id="jumlah_porsi" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" required min="1">
                </div>
            </div>

            <hr class="my-6">

            <h3 class="text-lg font-semibold text-gray-900 mb-4">Daftar Bahan Baku yang Diminta</h3>
            <div id="daftar-bahan-container">
                </div>

            <button type="button" id="tambah-bahan" class="mt-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Tambah Bahan
            </button>
            
            <div class="mt-8 border-t pt-6 flex justify-end">
                <a href="/dashboard" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-2 px-4 rounded-lg mr-3">Batal</a>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg">
                    Kirim Permintaan
                </button>
            </div>
        </div>
    </form>
</div>

<template id="template-bahan-baris">
    <div class="grid grid-cols-12 gap-4 items-center mb-3 baris-bahan">
        <div class="col-span-6">
            <select name="bahan_id[]" class="bahan-select block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                <option value="">-- Pilih Bahan Baku --</option>
                <?php foreach($bahan_baku_tersedia as $bahan): ?>
                    <option value="<?= $bahan['id'] ?>"><?= esc($bahan['nama']) ?> (Stok: <?= $bahan['jumlah'] ?> <?= $bahan['satuan'] ?>)</option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-span-4">
            <input type="number" name="jumlah[]" class="shadow-sm block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Jumlah" required min="1">
        </div>
        <div class="col-span-2">
            <button type="button" class="hapus-bahan-baris bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-3 rounded-lg w-full">
                <i class="fas fa-trash-alt"></i>
            </button>
        </div>
    </div>
</template>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('daftar-bahan-container');
    const addButton = document.getElementById('tambah-bahan');
    const template = document.getElementById('template-bahan-baris');

    function tambahBaris() {
        const newRow = template.content.cloneNode(true);
        container.appendChild(newRow);
    }

    tambahBaris();

    addButton.addEventListener('click', tambahBaris);

    container.addEventListener('click', function(e) {
        if (e.target && e.target.closest('.hapus-bahan-baris')) {
            e.target.closest('.baris-bahan').remove();
        }
    });
});
</script>
<?= $this->endSection() ?>