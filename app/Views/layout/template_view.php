<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100">
    <div class="flex"> 
        <script>
            <?php if(session()->getFlashdata('success')): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '<?= session()->getFlashdata('success') ?>',
                    timer: 2500, 
                    showConfirmButton: false
                });
            <?php endif; ?>
        </script>
        <div class="bg-gray-800 text-white w-64 p-4 min-h-screen">
            <h2 class="text-2xl font-bold mb-6">Menu</h2>
            <nav>
                <a href="/dashboard" class="block py-2.5 px-4 rounded hover:bg-gray-700">Dashboard</a>
                
                <?php if (session()->get('user_role') === 'gudang'): ?>
                    <a href="/bahanbaku" class="block py-2.5 px-4 rounded hover:bg-gray-700">Bahan Baku</a>
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
</body>
</html>