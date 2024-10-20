<?php
include 'conn.php';

if (isset($_GET['id_user'])) {
    $id_user = $_GET['id_user'];
    $query = $conn->query("SELECT * FROM tb_user WHERE id_user = '$id_user'");
    $user = $query->fetch_assoc();
    $role = $user['role'];
}

if (isset($_POST['btnSimpan'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if (!empty($password)) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = $conn->query("UPDATE tb_user SET username = '$username', password = '$password', role = '$role' WHERE id_user = '$id_user'");
    } else {
        $query = $conn->query("UPDATE tb_user SET username = '$username', role = '$role' WHERE id_user = '$id_user'");
    }

    if ($query) {
        header("Location: user.php");
    } else {
        echo "<script>alert('Data Gagal Disimpan')</script>";
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
    <title>ADMIN DASHBOARD</title>
</head>

<body class="bg-gray-500">
    <?php include 'navbar.php'; ?>
    <div class="p-4 sm:ml-64 mt-14">
        <h1 class="text-center text-white text-2xl font-bold mb-4">Edit User</h1>

        <div class="flex items-center justify-center">
            <div class="w-full max-w-md p-8 space-y-8 bg-gray-800 rounded-lg shadow-md">
                <form class="space-y-4" action="" method="post">
                    <div>
                        <label for="no_polisi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                        <input type="text" id="no_polisi" name="username" value="<?php echo $user['username']; ?>"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            required>
                    </div>
                    <div>
                        <label for="brand"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" id="brand" name="password" placeholder="Kosongkan jika tidak ingin mengubah password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            >
                    </div>
                    <div>
                        <label for="status"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                        <select id="status" name="role"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            required>
                            <option value="admin" <?= ($role == 'admin') ? 'selected' : ''; ?>>Admin</option>
                            <option value="petugas" <?= ($role == 'petugas') ? 'selected' : ''; ?>>Petugas</option>
                        </select>
                    </div>
                    <button type="submit" name="btnSimpan"
                        class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>