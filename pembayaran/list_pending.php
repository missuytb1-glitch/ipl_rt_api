<?php
include "../config.php";

$sql = "SELECT pembayaran.*, users.nama, users.no_rumah
        FROM pembayaran
        JOIN users ON users.id = pembayaran.user_id
        WHERE pembayaran.status = 'pending'
        ORDER BY pembayaran.tanggal DESC";

$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode([
    "status" => "success",
    "pending" => $data
]);
?>
