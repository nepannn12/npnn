<?php
include 'conn.php';
?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <title>USER</title>
</head>

<body class="bg-gray-500">
    <?php include 'navbar.php'; ?>
    <div class="p-4 sm:ml-64 mt-14">
        <h1 class="text-center text-white text-2xl font-bold mb-4">Pembayaran Mobil</h1>

        <div class="grid grid-flow-col justify-start gap-x-2 mb-3">
            <a href="tb_booking.php"
                class="text-white bg-emerald-700 hover:bg-emerald-800 focus:ring-4 focus:ring-emerald-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-emerald-600 dark:hover:bg-emerald-700 focus:outline-none dark:focus:ring-emerald-800">
                Kembali</a>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            NIK
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            No. Polisi
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Tanggal Bayar
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Total Pembayaran
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Status Pembayaran
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT tb_bayar.id_bayar, tb_bayar.id_kembali, tb_bayar.tgl_bayar, tb_bayar.total_bayar, tb_bayar.status, tb_transaksi.nik, tb_transaksi.nopol 
                              FROM tb_bayar 
                              JOIN tb_kembali ON tb_bayar.id_kembali = tb_kembali.id_kembali
                              JOIN tb_transaksi ON tb_kembali.id_transaksi = tb_transaksi.id_transaksi
                              WHERE nik = '$nik'";
                    $result = mysqli_query($conn, $query);
                    $no = 1;

                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr
                            class='bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600'>
                            <td class='px-6 py-4 whitespace-nowrap text-center'>
                                <?= $no++ ?>
                            </td>
                            <td class='px-6 py-4 whitespace-nowrap text-center'>
                                <?= $row['nik'] ?>
                            </td>
                            <td class='px-6 py-4 whitespace-nowrap text-center'>
                                <?= $row['nopol'] ?>
                            </td>
                            <td class='px-6 py-4 whitespace-nowrap text-center'>
                                <?= $row['tgl_bayar'] ?>
                            </td>
                            <td class='px-6 py-4 whitespace-nowrap text-center'>
                                Rp <?= number_format($row['total_bayar'], 0, ',', '.') ?>
                            </td>
                            <td class='px-6 py-4 whitespace-nowrap text-center'>
                                <?= $row['status'] ?>
                            </td>
                            <td class='px-6 py-4 whitespace-nowrap text-center'>
                                <a href="bayar_mobil.php?id_bayar=<?= $row['id_bayar'] ?>"
                                    class="text-white bg-emerald-700 hover:bg-emerald-800 focus:ring-4 focus:ring-emerald-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-emerald-600 dark:hover:bg-emerald-700 focus:outline-none dark:focus:ring-emerald-800">Bayar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>