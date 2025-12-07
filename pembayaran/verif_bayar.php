<?php
include "../config.php";

header("Content-Type: application/json");

$id = $_POST['id'] ?? '';
$periode = $_POST['periode'] ?? '';

if ($id == '' || $periode == '') {
    echo json_encode(["status" => "error", "message" => "Data tidak lengkap"]);
    exit;
}

$q = $conn->query("SELECT * FROM pembayaran WHERE id='$id'");
if ($q->num_rows == 0) {
    echo json_encode(["status" => "error", "message" => "Data pembayaran tidak ditemukan"]);
    exit;
}

$data = $q->fetch_assoc();
$user_id = $data['user_id'];
$nominal = $data['nominal'];
$nama = $data['nama'] ?? "Warga";

$conn->query("UPDATE pembayaran SET status='lunas', periode='$periode' WHERE id='$id'");

$keterangan = "Pembayaran IPL oleh $nama";
$tanggal = date("Y-m-d H:i:s");

$sql = "INSERT INTO laporan_keuangan (jenis, nominal, keterangan, tanggal)
        VALUES ('pemasukan', '$nominal', '$keterangan', '$tanggal')";

if (!$conn->query($sql)) {
    echo json_encode([
        "status" => "error",
        "message" => "Gagal insert laporan: " . $conn->error
    ]);
    exit;
}

echo json_encode(["status" => "success", "message" => "Pembayaran diverifikasi!"]);
?>
