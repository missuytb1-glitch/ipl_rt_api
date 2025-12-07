<?php
include "../config.php";

$bulan = $_GET['bulan'];
$tahun = $_GET['tahun'];

$sql = $conn->query("
    SELECT * FROM keuangan_rt
    WHERE MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun'
    ORDER BY tanggal ASC
");

$data = [];
$total_pemasukan = 0;
$total_pengeluaran = 0;

while($row = $sql->fetch_assoc()){
    if($row['tipe'] == "pemasukan") $total_pemasukan += $row['nominal'];
    else $total_pengeluaran += $row['nominal'];

    $data[] = $row;
}

echo json_encode([
    "status"=>"success",
    "pemasukan"=>$total_pemasukan,
    "pengeluaran"=>$total_pengeluaran,
    "saldo"=>$total_pemasukan - $total_pengeluaran,
    "data"=>$data
]);
?>
