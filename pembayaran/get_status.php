<?php
include "../config.php";

$user_id = $_GET['user_id'] ?? '';

$sql = "SELECT expired_date FROM pembayaran 
        WHERE user_id='$user_id' AND status='lunas'
        ORDER BY expired_date DESC
        LIMIT 1";

$res = $conn->query($sql);

if ($row = $res->fetch_assoc()) {
    $expired = $row['expired_date'];
    $today = date("Y-m-d");

    $status = ($today <= $expired) ? "lunas" : "belum_bayar";

    echo json_encode([
        "status" => "success",
        "ipl_status" => $status,
        "expired_date" => $expired
    ]);
} else {
    echo json_encode([
        "status" => "success",
        "ipl_status" => "belum_bayar"
    ]);
}
?>
