<?php
include 'conn.php';

$nopol = isset($_GET['nopol']) ? $_GET['nopol'] : '';

if (isset($_POST['btnSimpan'])) {
    $nik = $_SESSION['user']['nik'];
    $tgl_ambil = $_POST['tgl_ambil'];
    $tgl_kembali = $_POST['tgl_kembali'];
    $supir = $_POST['supir'];
    $tgl_booking = date('Y-m-d');
    $dp = $_POST['dp'];

    // Calculate the number of days
    $datetime1 = new DateTime($tgl_ambil);
    $datetime2 = new DateTime($tgl_kembali);
    $interval = $datetime1->diff($datetime2);
    $days = $interval->days;

    if (empty($nopol)) {
        echo "Error: No police number provided.";
        exit;
    }

    // Get the price per day from tb_mobil
    $query = "SELECT harga FROM tb_mobil WHERE nopol = '$nopol'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $harga_perhari = $row['harga'];

    // Calculate the total price
    $total = $days * $harga_perhari;

    // Add additional cost if using a driver
    if ($supir == '1') {
        $total += 50000;
    }

    // Calculate the remaining amount to be paid
    $kekurangan = $total - $dp;

    // Insert into tb_transaksi
    $query = "INSERT INTO tb_transaksi (nik, nopol, tgl_booking, tgl_ambil, tgl_kembali, supir, total, dp, kekurangan, status) 
              VALUES ('$nik', '$nopol', '$tgl_booking', '$tgl_ambil', '$tgl_kembali', '$supir', '$total', '$dp', '$kekurangan', 'booking')";
    if (mysqli_query($conn, $query)) {
        // Update the status of the car in tb_mobil to 'tidak'
        $updateQuery = "UPDATE tb_mobil SET status = 'tidak' WHERE nopol = '$nopol'";
        mysqli_query($conn, $updateQuery);

        echo "<script>alert('Booking berhasil!'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
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
    <div class="p-4 sm:ml-64 mt-14"></div>
    <h1 class="text-center text-white text-2xl font-bold mb-4">Booking Mobil</h1>

    <div class="flex items-center justify-center">
        <div class="w-full max-w-md p-8 space-y-8 bg-gray-800 rounded-lg shadow-md">
            <form class="space-y-4" action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="no_polisi"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIK</label>
                    <input type="text" id="no_polisi" name="nik" value="<?php echo htmlspecialchars($nik); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        required disabled>
                </div>
                <div>
                    <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No.
                        Polisi</label>
                    <input type="text" id="brand" name="nopol" value="<?php echo htmlspecialchars($nopol); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        required disabled>
                </div>
                <div>
                    <label for="tahun" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                        Ambil</label>
                    <input type="date" id="tahun" name="tgl_ambil"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        required>
                </div>
                <div>
                    <label for="tahun" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                        Kembali</label>
                    <input type="date" id="tahun" name="tgl_kembali"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        required>
                </div>
                <div>
                    <label for="harga" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bayar DP</label>
                    <input type="text" placeholder="Rp" id="harga" name="dp"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        required>
                </div>
                <div>
                    <label for="supir" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pakai
                        Supir</label>
                    <div class="flex items-center">
                        <input type="radio" id="supir_ya" name="supir" value="1"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                            required>
                        <label for="supir_ya"
                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Ya</label>
                    </div>
                    <div class="flex items-center mt-2">
                        <input type="radio" id="supir_tidak" name="supir" value="0"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                            required>
                        <label for="supir_tidak"
                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tidak</label>
                    </div>
                </div>
                <button type="submit" name="btnSimpan"
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button>
            </form>
        </div>
    </div>
</body>

</html>