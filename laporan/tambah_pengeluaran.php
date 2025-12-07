<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "../config.php";
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        "status" => "error",
        "message" => "INVALID METHOD"
    ]);
    exit;
}

$nominal = $_POST['nominal'] ?? '';
$keterangan = $_POST['keterangan'] ?? '';

if ($nominal == '' || $keterangan == '') {
    echo json_encode([
        "status" => "error",
        "message" => "Data tidak lengkap"
    ]);
    exit;
}

$sql = "INSERT INTO laporan_keuangan (jenis, nominal, keterangan, tanggal)
        VALUES ('pengeluaran', '$nominal', '$keterangan', NOW())";

if ($conn->query($sql)) {
    echo json_encode([
        "status" => "success",
        "message" => "Pengeluaran ditambahkan"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "SQL Error: " . $conn->error
    ]);
}
?>
