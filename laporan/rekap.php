<?php
header("Content-Type: application/json");
include "../config.php";

$periode = $_GET["periode"] ?? "bulan";
$bulan = $_GET["bulan"] ?? date("m");
$tahun = $_GET["tahun"] ?? date("Y");

$where = "";

if ($periode == "bulan") {
    $where = "MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun'";
} else {
    $where = "YEAR(tanggal) = '$tahun'";
}

$ambil_total = function($jenis) use ($conn, $where) {
    $sql = "SELECT IFNULL(SUM(nominal),0) AS total FROM laporan_keuangan WHERE jenis='$jenis' AND $where";
    $res = $conn->query($sql)->fetch_assoc();
    return (int)$res["total"];
};

$total_pemasukan = $ambil_total("pemasukan");
$total_pengeluaran = $ambil_total("pengeluaran");

$sql_transaksi = "
    SELECT * FROM laporan_keuangan
    WHERE $where
    ORDER BY tanggal DESC
";

$res = $conn->query($sql_transaksi);
$transaksi = [];
while ($row = $res->fetch_assoc()) {
    $transaksi[] = $row;
}

echo json_encode([
    "status" => "success",
    "pemasukan" => $total_pemasukan,
    "pengeluaran" => $total_pengeluaran,
    "saldo" => $total_pemasukan - $total_pengeluaran,
    "transaksi" => $transaksi
]);
?>
