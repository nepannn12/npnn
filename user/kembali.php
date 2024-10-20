<?php
include 'conn.php';

if (isset($_GET['id_transaksi'])) {
    $id_transaksi = $_GET['id_transaksi'];
    $query = $conn->query("SELECT * FROM tb_transaksi WHERE id_transaksi = '$id_transaksi'");
    $data = $query->fetch_assoc();
}

if (isset($_POST['btnSimpan'])) {
    $kondisi_mobil = $_POST['kondisi_mobil'];
    $tgl_kembali = $data['tgl_kembali'];
    $tgl_sekarang = date('Y-m-d');
    
    // Calculate fine if return date exceeds the due date
    $denda = 0;
    if (strtotime($tgl_sekarang) > strtotime($tgl_kembali)) {
        $diff = strtotime($tgl_sekarang) - strtotime($tgl_kembali);
        $days_late = ceil($diff / (60 * 60 * 24));
        $denda = $days_late * 50000;
    }

    // Insert into tb_kembali
    $stmt = $conn->prepare("INSERT INTO tb_kembali (id_transaksi, tgl_kembali, kondisi_mobil, denda) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $id_transaksi, $tgl_sekarang, $kondisi_mobil, $denda);
    if ($stmt->execute()) {
        $id_kembali = $conn->insert_id; // Get the last inserted id_kembali

        // Update status in tb_transaksi
        $update_stmt = $conn->prepare("UPDATE tb_transaksi SET status = 'kembali' WHERE id_transaksi = ?");
        $update_stmt->bind_param("i", $id_transaksi);
        $update_stmt->execute();
        $update_stmt->close();

        // Update status in tb_mobil using nopol
        $nopol = $data['nopol']; // Assuming you have the nopol in $data
        $update_mobil_stmt = $conn->prepare("UPDATE tb_mobil SET status = 'tersedia' WHERE nopol = ?");
        $update_mobil_stmt->bind_param("s", $nopol);
        $update_mobil_stmt->execute();
        $update_mobil_stmt->close();

        // Insert into tb_bayar
        $total_bayar = $data['total'] + $denda; // Assuming you have the total_harga in $data
        $status_bayar = 'belum lunas';
        $stmt_bayar = $conn->prepare("INSERT INTO tb_bayar (id_kembali, tgl_bayar, total_bayar, status) VALUES (?, ?, ?, ?)");
        $tgl_bayar = NULL;
        $stmt_bayar->bind_param("isss", $id_kembali, $tgl_bayar, $total_bayar, $status_bayar);
        $stmt_bayar->execute();
        $stmt_bayar->close();

        echo "<script>alert('Data berhasil disimpan'); window.location='tb_booking.php';</script>";
    } else {
        echo "<script>alert('Data gagal disimpan');</script>";
    }
    $stmt->close();
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
    <div class="p-4 sm:ml-64 mt-14"></div>
    <h1 class="text-center text-white text-2xl font-bold mb-4">Kembalikan Mobil</h1>

    <div class="flex items-center justify-center">
        <div class="w-full max-w-md p-8 space-y-8 bg-gray-800 rounded-lg shadow-md">
            <form class="space-y-4" action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="tahun" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                        Kembali</label>
                    <input type="date" id="tahun" name="tgl_kembali" value="<?php echo $data['tgl_kembali']; ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        required disabled>
                </div>
                <div>
                    <label for="harga" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kondisi
                        Mobil</label>
                    <textarea name="kondisi_mobil" id="alamat"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        required></textarea>
                </div>
                <button type="submit" name="btnSimpan"
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button>
            </form>
        </div>
    </div>
</body>

</html>