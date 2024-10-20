<?php
include 'conn.php';

if (isset($_GET['id_bayar'])) {
    $id_bayar = $_GET['id_bayar'];
    $nik = $_SESSION['user']['nik'];
    $query = $conn->query("SELECT tb_bayar.*, tb_kembali.denda FROM tb_bayar 
                           LEFT JOIN tb_kembali ON tb_bayar.id_kembali = tb_kembali.id_kembali 
                           WHERE tb_bayar.id_bayar = '$id_bayar'");
    $data = $query->fetch_assoc();
}

if (isset($_POST['btnSimpan'])) {
    $nominal_bayar = str_replace(['Rp', '.', ' '], '', $_POST['nominal_bayar']); // Remove formatting
    $total_bayar = $data['total_bayar'];
    $tgl_bayar = date('Y-m-d');
    $status = 'lunas';

    if ($nominal_bayar != $total_bayar) {
        echo "<script>alert('Nominal yang dibayarkan tidak sesuai dengan total pembayaran!');</script>";
    } else {
        $stmt = $conn->prepare("UPDATE tb_bayar SET tgl_bayar = ?, nominal_bayar = ?, status = ? WHERE id_bayar = ?");
        $stmt->bind_param('sssi', $tgl_bayar, $nominal_bayar, $status, $id_bayar);

        if ($stmt->execute()) {
            echo "<script>alert('Pembayaran berhasil!'); window.location.href='tb_bayar.php';</script>";
        } else {
            echo "<script>alert('Pembayaran gagal!');</script>";
        }

        $stmt->close();
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
    <h1 class="text-center text-white text-2xl font-bold mb-4">Pembayaran Mobil</h1>

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
                    <label for="harga"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Denda</label>
                    <input type="text" placeholder="Rp" id="harga" name="total_bayar"
                        value="Rp <?php echo number_format($data['denda'], 0, ',', '.'); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        required disabled>
                </div>
                <div>
                    <label for="harga" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total
                        Pembayaran (Sudah Termasuk Denda)</label>
                    <input type="text" placeholder="Rp" id="harga" name="total_bayar"
                        value="Rp <?php echo number_format($data['total_bayar'], 0, ',', '.'); ?>"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        required disabled>
                </div>
                <div>
                    <label for="harga" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nominal
                        Bayar</label>
                    <input type="text" placeholder="Rp" id="harga" name="nominal_bayar"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        required oninput="formatRupiah(this)">
                    <script>
                        function formatRupiah(input) {
                            let value = input.value.replace(/[^,\d]/g, '').toString();
                            let split = value.split(',');
                            let sisa = split[0].length % 3;
                            let rupiah = split[0].substr(0, sisa);
                            let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                            if (ribuan) {
                                let separator = sisa ? '.' : '';
                                rupiah += separator + ribuan.join('.');
                            }

                            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                            input.value = 'Rp ' + rupiah;
                        }
                    </script>
                </div>
                <button type="submit" name="btnSimpan"
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Bayar</button>
            </form>
        </div>
    </div>
</body>

</html>