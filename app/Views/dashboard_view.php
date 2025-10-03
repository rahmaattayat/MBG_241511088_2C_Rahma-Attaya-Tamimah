<?= $this->extend('layout/template_view') ?>

<?= $this->section('content') ?>

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Selamat Datang, <?= esc(session()->get('user_name')) ?>!</h1>
        <p class="text-gray-600 mt-1">Anda login sebagai <span class="font-semibold"><?= esc(session()->get('user_role')) ?></span>.</p>
    </div>

    <?php if (session()->get('user_role') === 'gudang'): ?>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <a href="/bahanbaku/create" class="bg-blue-500 text-white p-6 rounded-xl shadow-lg hover:bg-blue-600 transition flex flex-col items-center justify-center text-center">
                <i class="fas fa-plus-circle text-4xl mb-3"></i>
                <h3 class="font-bold text-xl">Tambah Bahan Baku</h3>
                <p class="text-sm opacity-90">Input data bahan baku yang baru masuk.</p>
            </a>
            <a href="/bahanbaku" class="bg-gray-800 text-white p-6 rounded-xl shadow-lg hover:bg-gray-900 transition flex flex-col items-center justify-center text-center">
                <i class="fas fa-boxes text-4xl mb-3"></i>
                <h3 class="font-bold text-xl">Lihat Stok Lengkap</h3>
                <p class="text-sm opacity-90">Lihat dan kelola semua bahan baku.</p>
            </a>
        </div>
    <?php endif; ?>

    <div class="bg-white p-6 rounded-xl shadow-lg">
        <h3 class="text-xl font-bold mb-4 text-gray-800">Ketersediaan Bahan Baku Saat Ini</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-4 font-semibold text-sm text-gray-600 uppercase text-left">Nama Bahan</th>
                        <th class="py-3 px-4 font-semibold text-sm text-gray-600 uppercase">Jumlah</th>
                        <th class="py-3 px-4 font-semibold text-sm text-gray-600 uppercase text-left">Satuan</th>
                        <th class="py-3 px-4 font-semibold text-sm text-gray-600 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <?php if (!empty($bahan_baku)): ?>
                        <?php foreach ($bahan_baku as $item): ?>
                            <tr class="border-b">
                                <td class="py-3 px-4"><?= esc($item['nama']) ?></td>
                                <td class="py-3 px-4 text-center font-semibold"><?= esc($item['jumlah']) ?></td>
                                <td class="py-3 px-4"><?= esc($item['satuan']) ?></td>
                                <td class="py-3 px-4 text-center">
                                    <?php
                                        $status = $item['status'];
                                        $colorClass = 'bg-green-100 text-green-700';
                                        if ($status == 'segera_kadaluarsa') $colorClass = 'bg-yellow-100 text-yellow-700';
                                        elseif ($status == 'kadaluarsa') $colorClass = 'bg-red-100 text-red-700';
                                        elseif ($status == 'habis') $colorClass = 'bg-gray-100 text-gray-700';
                                    ?>
                                    <span class="<?= $colorClass ?> py-1 px-2 rounded-full text-xs font-bold">
                                        <?= esc(str_replace('_', ' ', $status)) ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

<?= $this->endSection() ?>