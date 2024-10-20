<?php
session_start();
include 'conn.php'; // pastikan koneksi ke database sudah diatur

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nik = mysqli_real_escape_string($conn, $_POST['nik']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    if (!empty($nik) && !empty($password)) {
        $query = "SELECT * FROM tb_member WHERE nik = '$nik'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            // Debugging
            var_dump($user); // Lihat data user
            var_dump($password); // Lihat password yang dimasukkan
            var_dump($user['password']); // Lihat password yang disimpan

            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                header('Location: user/index.php');
                exit();
            } else {
                echo "<script>alert('Invalid NIK or Password.');</script>";
            }
        } else {
            echo "<script>alert('Invalid NIK or Password.');</script>";
        }
    } elseif (!empty($username) && !empty($password)) {
        // Login sebagai admin atau petugas
        $query = "SELECT * FROM tb_user WHERE username = '$username'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                if ($user['role'] == 'admin') {
                    header('Location: admin/index.php');
                } elseif ($user['role'] == 'petugas') {
                    header('Location: petugas/index.php');
                }
                exit();
            } else {
                echo "<script>alert('Invalid Username or Password.');</script>";
            }
        } else {
            echo "<script>alert('Invalid Username or Password.');</script>";
        }
    } else {
        echo "<script>alert('Please enter NIK or Username and Password.');</script>";
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

<body>
  <div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-8 space-y-8 bg-white rounded-lg shadow-md">
      <h2 class="text-2xl font-bold text-center">Login User</h2>
      <form action="" method="POST">
        <div class="mb-4">
          <label for="username" class="block text-sm font-medium text-gray-700">NIK</label>
          <input type="text" name="nik" id="nik"
            class="w-full px-3 py-2 mt-1 border rounded-md focus:outline-none focus:ring focus:ring-indigo-200"
            >
        </div>
        <div class="mb-4">
          <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
          <input type="text" name="username" id="username" placeholder="Kosongkan Jika Menggunakan NIK"
            class="w-full px-3 py-2 mt-1 border rounded-md focus:outline-none focus:ring focus:ring-indigo-200">
        </div>
        <div class="mb-6">
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <input type="password" name="password" id="password"
            class="w-full px-3 py-2 mt-1 border rounded-md focus:outline-none focus:ring focus:ring-indigo-200"
            required>
        </div>
        <div class="flex items-center justify-between">
          <button type="submit"
            class="w-full px-4 py-2 font-bold text-white bg-indigo-600 rounded hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Login</button>
        </div>
      </form>
      <p class="mt-4 text-sm text-center text-gray-600">
        Belum Punya Akun? <a href="register.php" class="text-indigo-600 hover:underline">Register</a>
      </p>
    </div>
  </div>
</body>

</html>
