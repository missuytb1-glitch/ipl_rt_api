<?php
header("Content-Type: application/json");
include "../config.php";

if ($conn->connect_error) {
    echo json_encode([
        "status" => "error",
        "message" => "DB Connection Failed"
    ]);
    exit;
}

$bulan = date("m");
$tahun = date("Y");

$sql = "SELECT SUM(nominal) AS total 
        FROM pembayaran 
        WHERE status = 'lunas' 
        AND MONTH(tanggal) = '$bulan'
        AND YEAR(tanggal) = '$tahun'";

$result = $conn->query($sql);
$row = $result->fetch_assoc();

$total = $row["total"] ?? 0;

echo json_encode([
    "status" => "success",
    "total" => intval($total)
]);
?>
