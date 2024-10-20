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
        <h1 class="text-center text-white text-2xl font-bold mb-4">Data Transaksi Saya</h1>

        <div class="grid grid-flow-col justify-start gap-x-2 mb-3">
            <a href="index.php"
                class="text-white bg-emerald-700 hover:bg-emerald-800 focus:ring-4 focus:ring-emerald-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-emerald-600 dark:hover:bg-emerald-700 focus:outline-none dark:focus:ring-emerald-800">
                Kembali</a>
            <a href="tb_bayar.php"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Pembayaran</a>
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
                            Tanggal Booking
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Tanggal Ambil
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Tanggal Kembali
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Supir
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Total Harga
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Pembayaran DP
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Kekuranagn
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM tb_transaksi WHERE nik = '$nik'";
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
                                <?= $row['tgl_booking'] ?>
                            </td>
                            <td class='px-6 py-4 whitespace-nowrap text-center'>
                                <?= $row['tgl_ambil'] ?>
                            </td>
                            <td class='px-6 py-4 whitespace-nowrap text-center'>
                                <?= $row['tgl_kembali'] ?>
                            </td>
                            <td class='px-6 py-4 whitespace-nowrap text-center'>
                                <?= $row['supir'] == 1 ? 'Ya' : 'Tidak' ?>
                            </td>
                            <td class='px-6 py-4 whitespace-nowrap text-center'>
                                Rp <?= number_format($row['total'], 0, ',', '.') ?>
                            </td>
                            <td class='px-6 py-4 whitespace-nowrap text-center'>
                                Rp <?= number_format($row['dp'], 0, ',', '.') ?>
                            </td>
                            <td class='px-6 py-4 whitespace-nowrap text-center'>
                                Rp <?= number_format($row['kekurangan'], 0, ',', '.') ?>
                            </td>
                            <td class='px-6 py-4 whitespace-nowrap text-center'>
                                <?= $row['status'] ?>
                            </td>
                            <td class='px-6 py-4 whitespace-nowrap text-center'>
                                <a href="ambil_mobil.php?id_transaksi=<?= $row['id_transaksi'] ?>"
                                    class="text-white bg-emerald-700 hover:bg-emerald-800 focus:ring-4 focus:ring-emerald-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-emerald-600 dark:hover:bg-emerald-700 focus:outline-none dark:focus:ring-emerald-800">Ambil</a>
                                <a href="kembali.php?id_transaksi=<?= $row['id_transaksi'] ?>"
                                    class="text-white bg-emerald-700 hover:bg-emerald-800 focus:ring-4 focus:ring-emerald-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-emerald-600 dark:hover:bg-emerald-700 focus:outline-none dark:focus:ring-emerald-800">Kembalikan</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>