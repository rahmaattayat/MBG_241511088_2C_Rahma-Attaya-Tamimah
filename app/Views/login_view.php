<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi Bahan Baku</title>
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
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-2">Aplikasi Pemantauan Bahan Baku</h1>
        <p class="text-center text-gray-600 mb-6">Silakan login untuk melanjutkan</p>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <span><?= session()->getFlashdata('error') ?></span>
            </div>
        <?php endif; ?>

        <form action="/login/process" method="post">
            <?= csrf_field() ?>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" id="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" id="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
            </div>
            <button type="submit" class="bg-brand-green-light hover:bg-brand-green-muted text-gray-800 font-bold py-2 px-4 rounded w-full"> 
                Login
            </button>
        </form>
    </div>
</body>
</html>