<?php
include 'conn.php';

if (isset($_POST['btnSimpan'])) {
    $nopol = $_POST['nopol'];
    $brand = $_POST['brand'];
    $type = $_POST['type'];
    $tahun = $_POST['tahun'];
    $harga = $_POST['harga'];
    $status = $_POST['status'];

    // Handle file upload
    $foto_mobil = $_FILES['foto']['name'];
    $tmp_name = $_FILES['foto']['tmp_name'];
    $random_number = rand(100, 999);
    $new_foto_mobil = $random_number . '-' . $foto_mobil;
    $upload_dir = '../image/' . $new_foto_mobil;

    if (move_uploaded_file($tmp_name, $upload_dir)) {
        $query = "INSERT INTO tb_mobil (nopol, brand, type, tahun, harga, foto, status) 
                  VALUES ('$nopol', '$brand', '$type', '$tahun', '$harga', '$new_foto_mobil', '$status')";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Data berhasil disimpan.'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Error: " . $query . "<br>" . mysqli_error($conn) . "'); window.location.href='index.php';</script>";
        }
    } else {
        echo "<script>alert('Failed to upload image.'); window.location.href='index.php';</script>";
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
    <title>PETUGAS DASHBOARD</title>
</head>

<body class="bg-gray-500">
    <?php include 'navbar.php'; ?>
    <div class="p-4 sm:ml-64 mt-14">
        <h1 class="text-center text-white text-2xl font-bold mb-4">Data Mobil</h1>

        <div class="mb-4">
            <!-- Modal toggle -->
            <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
                Tambah Data Mobil
            </button>
        </div>

        <!-- Main modal -->
        <div id="authentication-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Data Mobil
                        </h3>
                        <button type="button"
                            class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="authentication-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5">
                        <form class="space-y-4" action="" method="post" enctype="multipart/form-data">
                            <div>
                                <label for="no_polisi"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No.
                                    Polisi</label>
                                <input type="text" id="no_polisi" name="nopol"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    required>
                            </div>
                            <div>
                                <label for="brand"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Brand</label>
                                <input type="text" id="brand" name="brand"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    required>
                            </div>
                            <div>
                                <label for="tipe_mobil"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipe
                                    Mobil</label>
                                <input type="text" id="tipe_mobil" name="type"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    required>
                            </div>
                            <div>
                                <label for="tahun"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun</label>
                                <input type="date" id="tahun" name="tahun"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    required>
                            </div>
                            <div>
                                <label for="harga"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga /
                                    Hari</label>
                                <input type="text" placeholder="Rp" id="harga" name="harga"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    required>
                            </div>
                            <div>
                                <label for="foto_mobil"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto
                                    Mobil</label>
                                <input type="file" id="foto_mobil" name="foto" accept=".jpg, .jpeg, .png"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    required>
                            </div>
                            <div>
                                <label for="status"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                                <select id="status" name="status"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    required>
                                    <option value="tersedia">Tersedia</option>
                                    <option value="tidak">Tidak</option>
                                </select>
                            </div>
                            <button type="submit" name="btnSimpan"
                                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            No. Polisi
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Brand
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tipe Mobil
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tahun
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Harga / hari
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Foto
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM tb_mobil";
                    $result = mysqli_query($conn, $query);
                    $no = 1;

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600'>";
                        echo "<td class='px-6 py-4 whitespace-nowrap'>" . $no++ . "</td>";
                        echo "<td class='px-6 py-4 whitespace-nowrap'>" . $row['nopol'] . "</td>";
                        echo "<td class='px-6 py-4 whitespace-nowrap'>" . $row['brand'] . "</td>";
                        echo "<td class='px-6 py-4 whitespace-nowrap'>" . $row['type'] . "</td>";
                        echo "<td class='px-6 py-4 whitespace-nowrap'>" . $row['tahun'] . "</td>";
                        echo "<td class='px-6 py-4 whitespace-nowrap'>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>";
                        echo "<td class='px-3 py-4 whitespace-nowrap'><img src='../image/" . $row['foto'] . "' alt='Foto Mobil' class='w-20 h-20 object-cover'></td>";
                        echo "<td class='px-6 py-4 whitespace-nowrap'>" . $row['status'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>