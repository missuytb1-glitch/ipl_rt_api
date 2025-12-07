<?php
include "../config.php";

$id = $_POST['id'] ?? '';
$periode = $_POST['periode'] ?? 'bulanan';

$map = [
    "bulanan" => 1,
    "triwulan" => 3,
    "semester" => 6,
    "tahunan" => 12
];

if (!isset($map[$periode])) {
    echo json_encode(["status" => "error", "message" => "Periode tidak valid"]);
    exit;
}

$bulan = $map[$periode];

$today = date("Y-m-d");

$expired = date("Y-m-d", strtotime("+$bulan months", strtotime($today)));

$sql = "UPDATE pembayaran 
        SET status='lunas', periode='$bulan', expired_date='$expired'
        WHERE id='$id'";

if ($conn->query($sql)) {
    echo json_encode(["status" => "success", "message" => "Pembayaran diverifikasi"]);
} else {
    echo json_encode(["status" => "error", "message" => "Gagal update"]);
}
?>
