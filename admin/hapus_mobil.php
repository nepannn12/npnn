<?php 
    include 'conn.php';

    $nopol = $_GET['nopol'];

    $hapus = $conn->query("DELETE FROM tb_mobil WHERE nopol = '$nopol'");

    if ($hapus) {
        header("refresh:0;index.php");
    } else {
        echo "<script>alert ('Data Tidak Berhasil Dihapus')</script>";
        header("refresh:0;index.php");
    }
?>