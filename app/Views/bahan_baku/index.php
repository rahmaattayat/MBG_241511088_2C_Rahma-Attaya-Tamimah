<?= $this->extend('layout/template_view') ?>

<?= $this->section('content') ?>
    <div class="container mx-auto">
        <div class="flex items-center mb-4">
            <h2 class="text-2xl font-bold text-gray-800 mr-4"><?= esc($title) ?></h2>
            <a href="/bahanbaku/create" class="bg-brand-green-light hover:bg-brand-green-muted text-gray-800 font-bold py-2 px-4 rounded-lg flex items-center">
                <i class="fas fa-plus mr-2"></i>
                <span>Tambah Bahan Baku</span>
            </a>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-brand-green-muted text-gray-800">
                    <tr>
                        <th class="py-3 px-4 uppercase font-semibold text-sm">No</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Nama</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Kategori</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm">Jumlah</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Satuan</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm">Tgl Masuk</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm">Tgl Kadaluarsa</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm">Status</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm">Aksi</th> 
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <?php $no = 1; ?>
                    <?php foreach ($bahan_baku as $item): ?>
                        <tr class="border-b hover:bg-gray-100">
                            <td class="py-3 px-4 text-center"><?= $no++ ?></td>
                            <td class="py-3 px-4"><?= esc($item['nama']) ?></td>
                            <td class="py-3 px-4"><?= esc($item['kategori']) ?></td>
                            <td class="py-3 px-4 text-center"><?= esc($item['jumlah']) ?></td>
                            <td class="py-3 px-4"><?= esc($item['satuan']) ?></td>
                            <td class="py-3 px-4 text-center"><?= date('d-m-Y', strtotime($item['tanggal_masuk'])) ?></td>
                            <td class="py-3 px-4 text-center"><?= date('d-m-Y', strtotime($item['tanggal_kadaluarsa'])) ?></td>
                            <td class="py-3 px-4 text-center">
                            <?php
                                $status = $item['status'];
                                $colorClass = 'bg-green-200 text-green-800'; 
                                if ($status == 'segera_kadaluarsa') {
                                    $colorClass = 'bg-yellow-200 text-yellow-800';
                                } elseif ($status == 'kadaluarsa') {
                                    $colorClass = 'bg-red-200 text-red-800';
                                } elseif ($status == 'habis') {
                                    $colorClass = 'bg-gray-200 text-gray-800';
                                }
                            ?>
                            <span class="<?= $colorClass ?> py-1 px-3 rounded-full text-xs font-semibold">
                                <?= esc(str_replace('_', ' ', $status)) ?>
                            </span>
                            </td>
                            <td class="py-3 px-4 text-center">
                            <a href="/bahanbaku/edit/<?= $item['id'] ?>" class="text-blue-500 hover:text-blue-700 mr-3">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            
                            <button data-id="<?= $item['id'] ?>" data-nama="<?= esc($item['nama']) ?>" class="btn-hapus text-red-500 hover:text-red-700">
                                <i class="fas fa-trash-alt"></i>
                            </button>

                            <form action="/bahanbaku/destroy/<?= $item['id'] ?>" method="post" id="form-hapus-<?= $item['id'] ?>" class="hidden">
                                <?= csrf_field() ?>
                            </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?= $this->endSection() ?>