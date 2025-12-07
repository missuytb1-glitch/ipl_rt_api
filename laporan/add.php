<?php
include "../config.php";

$jenis = $_POST['jenis'];
$keterangan = $_POST['keterangan'];
$nominal = $_POST['nominal'];

$conn->query("INSERT INTO laporan_keuangan (jenis, keterangan, nominal, tanggal)
             VALUES ('$jenis', '$keterangan', '$nominal', CURDATE())");

echo json_encode(["status"=>"success","message"=>"Laporan berhasil ditambahkan"]);
?>
