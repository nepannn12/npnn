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
</head>

<body class="bg-gray-500">
    <?php include 'navbar.php'; ?>
    <div class="p-4 sm:ml-64 mt-14">
        <h1 class="text-center text-white text-2xl font-bold mb-4">Data Member</h1>

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
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Jenis Kelamin
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            No. Telepon
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Alamat
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Username
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $query = "SELECT * FROM tb_member";
                    $result = mysqli_query($conn, $query);
                    $no = 1;

                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4 text-lg text-center">
                                <?php echo $no++; ?>
                            </td>
                            <td class="px-6 py-4 text-lg text-center">
                                <?php echo $row['nik']; ?>
                            </td>
                            <td class="px-6 py-4 text-lg text-center">
                                <?php echo $row['nama']; ?>
                            </td>
                            <td class="px-6 py-4 text-lg text-center">
                                <?php echo $row['jenis_kelamin']; ?>
                            </td>
                            <td class="px-6 py-4 text-lg text-center">
                                <?php echo $row['telp']; ?>
                            </td>
                            <td class="px-6 py-4 text-lg text-center">
                                <?php echo $row['alamat']; ?>
                            </td>
                            <td class="px-6 py-4 text-lg text-center">
                                <?php echo $row['username']; ?>
                            </td>
                            <td class="px-6 py-4 text-lg text-center">
                                <a href="edit_member.php?nik=<?php echo $row['nik']; ?>"
                                    class="text-white bg-emerald-700 hover:bg-emerald-800 focus:ring-4 focus:ring-emerald-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-emerald-600 dark:hover:bg-emerald-700 focus:outline-none dark:focus:ring-emerald-800">Edit</a>
                                <a href="hapus_member.php?nik=<?php echo $row['nik']; ?>" onclick="return confirm('Hapus Data?')"
                                    class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">Hapus</a>
                            </td>
                        </tr>
                   <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>