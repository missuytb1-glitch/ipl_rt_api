<?php
include "../config.php";

$sql = "SELECT id, nama, no_rumah, no_hp 
        FROM users 
        WHERE role = 'warga'
        ORDER BY nama ASC";

$result = $conn->query($sql);

$data = [];

while ($row = $result->fetch_assoc()) {

    $uid = $row['id'];

    $qPay = "SELECT status 
             FROM pembayaran 
             WHERE user_id = '$uid'
             ORDER BY tanggal DESC 
             LIMIT 1";

    $rPay = $conn->query($qPay);

    if ($rPay && $rPay->num_rows > 0) {
        $pay = $rPay->fetch_assoc();
        $row['status_ipl'] = ($pay['status'] == 'lunas') ? 'lunas' : 'belum';
    } else {
        $row['status_ipl'] = 'belum';
    }

    $data[] = $row;
}

echo json_encode([
    "status" => "success",
    "warga" => $data
]);
?>
