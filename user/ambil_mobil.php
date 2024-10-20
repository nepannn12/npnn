<?php
include 'conn.php';

if (isset($_GET['id_transaksi'])) {
    $id_transaksi = $_GET['id_transaksi'];

    // Prepare the SELECT statement
    $stmt = $conn->prepare("SELECT * FROM tb_transaksi WHERE id_transaksi = ?");
    $stmt->bind_param("s", $id_transaksi);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if ($data) {
        // Prepare the UPDATE statement
        $updateStmt = $conn->prepare("UPDATE tb_transaksi SET status = 'diambil' WHERE id_transaksi = ?");
        $updateStmt->bind_param("s", $id_transaksi);
        $updateSuccess = $updateStmt->execute();

        if ($updateSuccess) {
            echo "Status updated to 'ambil'.";
            header("Location: tb_booking.php");
            exit();
        } else {
            echo "Failed to update status.";
        }
    } else {
        echo "Transaction not found.";
    }
}
?>