<?= $this->extend('layout/template_view') ?>

<?= $this->section('content') ?>
<div class="container mx-auto">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-800"><?= esc($title) ?></h2>
    </div>

    <?php if (empty($permintaan_list)): ?>
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <p class="text-gray-500">Anda belum pernah membuat permintaan.</p>
        </div>
    <?php else: ?>
        <div class="space-y-4">
            <?php foreach ($permintaan_list as $permintaan): ?>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm text-gray-500">ID Permintaan: #<?= $permintaan['id'] ?></p>
                            <h3 class="text-lg font-bold text-gray-900"><?= esc($permintaan['menu_makan']) ?></h3>
                            <p class="text-sm text-gray-600">
                                Tgl Masak: <?= date('d M Y', strtotime($permintaan['tgl_masak'])) ?> | Porsi: <?= esc($permintaan['jumlah_porsi']) ?>
                            </p>
                        </div>
                        <div>
                            <?php
                                $status = $permintaan['status'];
                                $colorClass = 'bg-yellow-100 text-yellow-800'; // Default untuk 'menunggu'
                                if ($status == 'disetujui') $colorClass = 'bg-green-100 text-green-800';
                                elseif ($status == 'ditolak') $colorClass = 'bg-red-100 text-red-800';
                            ?>
                            <span class="font-bold py-1 px-3 rounded-full text-xs uppercase <?= $colorClass ?>">
                                <?= esc($status) ?>
                            </span>
                        </div>
                    </div>

                    <div class="border-t mt-4 pt-4">
                        <h4 class="font-semibold text-gray-700 mb-2">Rincian Bahan:</h4>
                        <ul class="list-disc list-inside text-sm text-gray-600 space-y-1">
                            <?php foreach ($permintaan['details'] as $detail): ?>
                                <li>
                                    <span class="font-medium"><?= esc($detail['nama_bahan']) ?>:</span>
                                    <?= esc($detail['jumlah_diminta']) ?> <?= esc($detail['satuan']) ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>