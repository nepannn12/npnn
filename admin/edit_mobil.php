<?php
include 'conn.php';

if (isset($_GET['nopol'])) {
    $nopol = $_GET['nopol'];

    $query = $conn->query("SELECT * FROM tb_mobil WHERE nopol = '$nopol'");
    $mobil = $query->fetch_assoc();

    if ($mobil['status'] == 'tersedia') {
        $status = 'tersedia';
    } else {
        $status = 'tidak';
    }
}

if (isset($_POST['btnSimpan'])) {
    $nopol = $_POST['nopol'];
    $brand = $_POST['brand'];
    $type = $_POST['type'];
    $tahun = $_POST['tahun'];
    $harga = $_POST['harga'];
    $status = $_POST['status'];

    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    $path = "img/" . $foto;

    if (!empty($foto)) {
        move_uploaded_file($tmp, $path);
        $query = $conn->query("UPDATE tb_mobil SET brand = '$brand', type = '$type', tahun = '$tahun', harga = '$harga', foto = '$foto', status = '$status' WHERE nopol = '$nopol'");
    } else {
        $query = $conn->query("UPDATE tb_mobil SET brand = '$brand', type = '$type', tahun = '$tahun', harga = '$harga', status = '$status' WHERE nopol = '$nopol'");
    }

    if ($query) {
        header("Location: index.php");
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
        <h1 class="text-center text-white text-2xl font-bold mb-4">Edit Mobil</h1>

        <div class="flex items-center justify-center">
            <div class="w-full max-w-md p-8 space-y-8 bg-gray-800 rounded-lg shadow-md">
                <form class="space-y-4" action="" method="post" enctype="multipart/form-data">
                    <div>
                        <label for="no_polisi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No.
                            Polisi</label>
                        <input type="text" id="no_polisi" name="nopol" value="<?php echo $mobil['nopol']; ?>"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            required>
                    </div>
                    <div>
                        <label for="brand"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Brand</label>
                        <input type="text" id="brand" name="brand" value="<?php echo $mobil['brand']; ?>"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            required>
                    </div>
                    <div>
                        <label for="tipe_mobil"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipe
                            Mobil</label>
                        <input type="text" id="tipe_mobil" name="type" value="<?php echo $mobil['type']; ?>"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            required>
                    </div>
                    <div>
                        <label for="tahun"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun</label>
                        <input type="date" id="tahun" name="tahun" value="<?php echo $mobil['tahun']; ?>"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            required>
                    </div>
                    <div>
                        <label for="harga" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga /
                            Hari</label>
                        <input type="text" placeholder="Rp" id="harga" name="harga" value="<?php echo $mobil['harga']; ?>"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            required>
                    </div>
                    <div>
                        <label for="foto_mobil"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto
                            Mobil</label>
                        <input type="file" id="foto_mobil" name="foto" accept=".jpg, .jpeg, .png"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            >
                    </div>
                    <div>
                        <label for="status"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <select id="status" name="status"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            required>
                            <option value="tersedia" <?= ($status == 'tersedia') ? 'selected' : ''; ?>>Tersedia</option>
                            <option value="tidak" <?= ($status == 'tidak') ? 'selected' : ''; ?>>Tidak</option>
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