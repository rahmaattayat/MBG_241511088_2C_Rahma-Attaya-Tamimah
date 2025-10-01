<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <div class="bg-gray-800 text-white w-64 p-4">
            <h2 class="text-2xl font-bold mb-6">Menu</h2>
            <nav>
                <a href="/dashboard" class="block py-2.5 px-4 rounded hover:bg-gray-700">Dashboard</a>
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