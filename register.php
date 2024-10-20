<?php
include 'conn.php';

if (isset($_POST['btnSimpan'])) {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO tb_member (nik, nama, jenis_kelamin, telp, alamat, username, password) 
                VALUES ('$nik', '$nama', '$jenis_kelamin', '$telp', '$alamat', '$username', '$password')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Registrasi berhasil!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Registrasi gagal: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</head>

<body class="bg-gray-900 text-white">
    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-md p-8 space-y-8 bg-gray-800 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-center">Register User</h2>
            <form action="" method="POST">
                <div class="space-y-4">
                    <div>
                        <label for="nik" class="block text-sm font-medium">NIK</label>
                        <input type="text" name="nik" id="nik"
                            class="block w-full px-3 py-2 mt-1 border border-gray-600 rounded-md bg-gray-700 text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                    <div>
                        <label for="nama" class="block text-sm font-medium">Nama</label>
                        <input type="text" name="nama" id="nama"
                            class="block w-full px-3 py-2 mt-1 border border-gray-600 rounded-md bg-gray-700 text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                    <div>
                        <label for="jenis_kelamin" class="block text-sm font-medium">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin"
                            class="block w-full px-3 py-2 mt-1 border border-gray-600 rounded-md bg-gray-700 text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label for="no_telp" class="block text-sm font-medium">No Telp</label>
                        <input type="text" name="telp" id="no_telp"
                            class="block w-full px-3 py-2 mt-1 border border-gray-600 rounded-md bg-gray-700 text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                    <div>
                        <label for="alamat" class="block text-sm font-medium">Alamat</label>
                        <textarea name="alamat" id="alamat"
                            class="block w-full px-3 py-2 mt-1 border border-gray-600 rounded-md bg-gray-700 text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required></textarea>
                    </div>
                    <div>
                        <label for="username" class="block text-sm font-medium">Username</label>
                        <input type="text" name="username" id="username"
                            class="block w-full px-3 py-2 mt-1 border border-gray-600 rounded-md bg-gray-700 text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium">Password</label>
                        <input type="password" name="password" id="password"
                            class="block w-full px-3 py-2 mt-1 border border-gray-600 rounded-md bg-gray-700 text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                    <div>
                        <button type="submit" name="btnSimpan"
                            class="w-full px-4 py-2 font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Register</button>
                    </div>
                </div>
            </form>
            <p class="mt-4 text-sm text-center text-gray-400">
                Sudah Punya Akun? <a href="login.php" class="text-indigo-400 hover:underline">Login</a>
            </p>
        </div>
    </div>
</body>

</html>
