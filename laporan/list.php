<?php
include "../config.php";

$sql = $conn->query("SELECT * FROM laporan_keuangan ORDER BY tanggal DESC");

$data = [];
while ($row = $sql->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode([
    "status" => "success",
    "laporan" => $data
]);
?>
