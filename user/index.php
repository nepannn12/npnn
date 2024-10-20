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
        <h1 class="text-center text-white text-2xl font-bold mb-4">Data Mobil</h1>

        <div class="grid grid-flow-col justify-start gap-x-2 mb-3">
            <a href="tb_booking.php"
                class="text-white bg-emerald-700 hover:bg-emerald-800 focus:ring-4 focus:ring-emerald-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-emerald-600 dark:hover:bg-emerald-700 focus:outline-none dark:focus:ring-emerald-800">
                Transaksi Saya</a>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            No. Polisi
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Brand</th>
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Tipe Mobil
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Tahun
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Harga / hari
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Foto
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
                    $query = "SELECT * FROM tb_mobil";
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
                                <?= $row['nopol'] ?>
                            </td>
                            <td class='px-6 py-4 whitespace-nowrap text-center'>
                                <?= $row['brand'] ?>
                            </td>
                            <td class='px-6 py-4 whitespace-nowrap text-center'>
                                <?= $row['type'] ?>
                            </td>
                            <td class='px-6 py-4 whitespace-nowrap text-center'>
                                <?= $row['tahun'] ?>
                            </td>
                            <td class='px-6 py-4 whitespace-nowrap text-center'>
                                Rp <?= number_format($row['harga'], 0, ',', '.') ?>
                            </td>
                            <td class='px-6 py-4 whitespace-nowrap'>
                                <div class="flex justify-center items-center">
                                    <img src="../image/<?= $row['foto'] ?>" alt="" class="size-20 max-w-full max-h-full">
                                </div>
                            </td>
                            <td class='px-6 py-4 whitespace-nowrap text-center'>
                                <?= $row['status'] ?>
                            </td>
                            <td class='px-6 py-4 whitespace-nowrap text-center'>
                                <?php
                                $nopol = $row['nopol'];
                                $checkBookingQuery = "SELECT COUNT(*) as count FROM tb_mobil WHERE nopol = '$nopol' AND status = 'tidak'";
                                $checkBookingResult = mysqli_query($conn, $checkBookingQuery);
                                $bookingData = mysqli_fetch_assoc($checkBookingResult);

                                if ($bookingData['count'] == 0) {
                                    ?>
                                    <a href="booking_mobil.php?nopol=<?= $nopol ?>"
                                        class="text-white bg-emerald-700 hover:bg-emerald-800 focus:ring-4 focus:ring-emerald-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-emerald-600 dark:hover:bg-emerald-700 focus:outline-none dark:focus:ring-emerald-800">Booking</a>
                                    <?php
                                } else {
                                    ?>
                                    <button onclick="alert('Mobil ini sudah dibooking.')" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">Booked</button>
                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>