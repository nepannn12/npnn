<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</head>

<body class="bg-gray-100 dark:bg-gray-900 dark:text-white">
    <!-- Navbar -->
    <nav class="bg-white dark:bg-gray-800 shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="#" class="text-2xl font-bold text-blue-600 dark:text-blue-400">RentalMobil</a>
            <div class="flex items-center space-x-4">
                <a href="login.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Sign In</a>
                <a href="register.php" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Sign Up</a>
            </div>
        </div>
    </nav>

    <!-- Landing Page Content -->
    <div class="container mx-auto px-4 py-8">
        <header class="text-center mb-8">
            <h1 class="text-4xl font-bold dark:text-white">Selamat Datang di Rental Mobil Kami</h1>
            <p class="text-lg mt-2 dark:text-gray-300">Temukan mobil terbaik untuk perjalanan Anda</p>
        </header>

        <!-- Car Listings -->
        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                <img src="path/to/car1.jpg" alt="Car 1" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-xl font-semibold dark:text-white">Mobil 1</h2>
                    <p class="text-gray-600 dark:text-gray-300 mt-2">Deskripsi singkat mobil 1.</p>
                    <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Sewa Sekarang</button>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                <img src="path/to/car2.jpg" alt="Car 2" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-xl font-semibold dark:text-white">Mobil 2</h2>
                    <p class="text-gray-600 dark:text-gray-300 mt-2">Deskripsi singkat mobil 2.</p>
                    <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Sewa Sekarang</button>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                <img src="path/to/car3.jpg" alt="Car 3" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-xl font-semibold dark:text-white">Mobil 3</h2>
                    <p class="text-gray-600 dark:text-gray-300 mt-2">Deskripsi singkat mobil 3.</p>
                    <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Sewa Sekarang</button>
                </div>
            </div>
        </section>
    </div>

    <script>
        const themeToggle = document.getElementById('theme-toggle');
        const htmlElement = document.documentElement;

        themeToggle.addEventListener('click', () => {
            htmlElement.classList.toggle('dark');
        });
    </script>
</body>

</html>
