<?php 
include 'conn.php';

$id_user = $_GET['id_user'];

$hapus = $conn->query("DELETE FROM tb_user WHERE id_user = '$id_user'");

if ($hapus) {
    header("refresh:0;user.php");
} else {
    echo "<script>alert ('Data Tidak Berhasil Dihapus')</script>";
    header("refresh:0;user.php");
}
?>