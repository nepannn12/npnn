<?php 
include 'conn.php';

$nik = $_GET['nik'];

$hapus = $conn->query("DELETE FROM tb_member WHERE nik = '$nik'");

if ($hapus) {
    header("refresh:0;member.php");
} else {
    echo "<script>alert ('Data Tidak Berhasil Dihapus')</script>";
    header("refresh:0;member.php");
}
?>