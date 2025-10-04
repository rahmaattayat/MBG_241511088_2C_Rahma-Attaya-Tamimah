<?php
    $uri = service('uri');
    $segment1 = $uri->getSegment(1) ?? 'dashboard';
    $segment2 = $uri->getSegment(2) ?? ''; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand-green-light': '#B4DEBD',
                        'brand-green-muted': '#B6CEB4',
                        'brand-cream': '#F5F5F0',
                    }
                }
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-brand-cream">
    <div class="flex"> 
        <div class="bg-brand-green-muted text-gray-800 w-64 min-h-screen flex flex-col justify-between p-4">
            <div>
                <div class="text-center p-4 mb-4 border-b border-brand-green-light">
                    <h2 class="text-2xl font-bold text-gray-700">Stok Dapur</h2>
                </div>
                
                <nav class="flex flex-col space-y-2">
                    <?php
                        $activeClass = 'bg-brand-green-light font-bold shadow-inner';
                        $hoverClass = 'hover:bg-brand-green-light';
                    ?>

                    <a href="/dashboard" class="flex items-center py-2.5 px-4 rounded-lg transition <?= ($segment1 == 'dashboard') ? $activeClass : $hoverClass ?>">
                        <i class="fas fa-tachometer-alt w-6 text-center mr-3"></i>
                        <span>Dashboard</span>
                    </a>
                    
                    <?php if (session()->get('user_role') === 'gudang'): ?>
                        <a href="/bahanbaku" class="flex items-center py-2.5 px-4 rounded-lg transition <?= ($segment1 == 'bahanbaku') ? $activeClass : $hoverClass ?>">
                             <i class="fas fa-boxes w-6 text-center mr-3"></i>
                             <span>Bahan Baku</span>
                        </a>
                        <a href="/permintaan/gudang" class="flex items-center py-2.5 px-4 rounded-lg transition <?= ($segment1 == 'permintaan') ? $activeClass : $hoverClass ?>">
                            <i class="fas fa-inbox w-6 text-center mr-3"></i>
                            <span>Permintaan Masuk</span>
                        </a>
                    <?php endif; ?>

                    <?php if (session()->get('user_role') === 'dapur'): ?>
                        <a href="/permintaan/create" class="flex items-center py-2.5 px-4 rounded-lg transition <?= ($segment1 == 'permintaan' && $segment2 == 'create') ? $activeClass : $hoverClass ?>">
                            <i class="fas fa-plus-circle w-6 text-center mr-3"></i>
                            <span>Buat Permintaan</span>
                        </a>
                        <a href="/permintaan" class="flex items-center py-2.5 px-4 rounded-lg transition <?= ($segment1 == 'permintaan' && empty($segment2)) ? $activeClass : $hoverClass ?>">
                            <i class="fas fa-history w-6 text-center mr-3"></i>
                            <span>Status Permintaan</span>
                        </a>
                    <?php endif; ?>
                </nav>
            </div>
            
            <div class="border-t border-brand-green-light pt-4 text-center">
                 <p class="text-sm font-semibold"><?= esc(session()->get('user_name')) ?></p>
                 <p class="text-xs text-gray-600"><?= esc(ucfirst(session()->get('user_role'))) ?></p>
            </div>
        </div>
        
        <div class="flex-1 flex flex-col">
            <header class="bg-white shadow p-4 flex justify-between items-center">
                 <h1 class="text-xl font-semibold text-gray-700">Selamat Datang, <?= esc(session()->get('user_name')) ?>!</h1>
                 <a href="/logout" onclick="return confirm('Apakah Anda yakin ingin logout?');" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg flex items-center">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    <span>Logout</span>
                </a>
            </header>
            <main class="flex-1 p-6">
                <?= $this->renderSection('content') ?>
            </main>
        </div>
    </div>

    <script>
        <?php if(session()->getFlashdata('success')): ?>
            Swal.fire({ icon: 'success', title: 'Berhasil!', text: '<?= session()->getFlashdata('success') ?>', timer: 2500, showConfirmButton: false });
        <?php endif; ?>
        <?php if(session()->getFlashdata('error')): ?>
            Swal.fire({ icon: 'error', title: 'Gagal!', text: '<?= session()->getFlashdata('error') ?>' });
        <?php endif; ?>

        document.querySelectorAll('.btn-hapus').forEach(tombol => {
            tombol.addEventListener('click', () => {
                const id = tombol.dataset.id;
                const nama = tombol.dataset.nama;
                const form = document.getElementById('form-hapus-' + id);

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    html: `Anda akan menghapus: <br><strong>${nama}</strong>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6e7881',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then(result => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</body>
</html>