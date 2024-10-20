<?php
// Cek apakah session sudah dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Cek apakah session sudah ada dan apakah user sudah login
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit(); // Menghentikan eksekusi script
}

// Simpan NIK dari user yang login sebagai member
$nik = $_SESSION['user']['nik'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_rental";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Connection successful
?>