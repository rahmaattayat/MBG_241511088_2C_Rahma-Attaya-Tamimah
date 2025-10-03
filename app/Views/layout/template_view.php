<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex"> 
        <div class="bg-gray-800 text-white w-64 p-4 min-h-screen">
            <h2 class="text-2xl font-bold mb-6">Menu</h2>
            <nav>
                <a href="/dashboard" class="block py-2.5 px-4 rounded hover:bg-gray-700">Dashboard</a>
                <?php if (session()->get('user_role') === 'gudang'): ?>
                    <a href="/bahanbaku" class="block py-2.5 px-4 rounded hover:bg-gray-700">Bahan Baku</a>
                <?php endif; ?>
                
                <?php if (session()->get('user_role') === 'dapur'): ?>
                <a href="/permintaan/create" class="block py-2.5 px-4 rounded hover:bg-gray-700">Buat Permintaan</a>
                <?php endif; ?>
            </nav>
        </div>
        
        <div class="flex-1 flex flex-col">
            <header class="bg-white shadow p-4 flex justify-between items-center">
                <h1 class="text-xl font-semibold">Selamat Datang, <?= esc(session()->get('user_name')) ?>!</h1>
                <a href="/logout" onclick="return confirm('Apakah Anda yakin ingin logout?');" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    Logout
                </a>
            </header>
            <main class="flex-1 p-6">
                <?= $this->renderSection('content') ?>
            </main>
        </div>
    </div>

    <script>
        // Script untuk notifikasi sukses
        <?php if(session()->getFlashdata('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?= session()->getFlashdata('success') ?>',
                timer: 2500,
                showConfirmButton: false
            });
        <?php endif; ?>

        // Script untuk notifikasi error
        <?php if(session()->getFlashdata('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '<?= session()->getFlashdata('error') ?>'
            });
        <?php endif; ?>

        // Script untuk pop-up konfirmasi hapus
        const tombolHapus = document.querySelectorAll('.btn-hapus');
        tombolHapus.forEach(tombol => {
            tombol.addEventListener('click', () => {
                const id = tombol.dataset.id;
                const nama = tombol.dataset.nama;
                const form = document.getElementById('form-hapus-' + id);

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    html: `Anda akan menghapus bahan baku: <br><strong>${nama}</strong>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6e7881',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                })
            });
        });
    </script>
</body>
</html>