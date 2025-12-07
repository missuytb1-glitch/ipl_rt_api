<?php
include "../config.php";

header("Content-Type: application/json");

$user_id = $_GET['user_id'] ?? '';

if ($user_id == '') {
    echo json_encode(["status" => "error", "ipl" => "belum"]);
    exit;
}

$today = date("Y-m-d");

$sql = "SELECT * FROM pembayaran 
        WHERE user_id = '$user_id' 
        AND status = 'lunas'
        ORDER BY tanggal DESC
        LIMIT 1";

$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo json_encode(["status" => "success", "ipl" => "belum"]);
    exit;
}

$row = $result->fetch_assoc();

$periodMap = [
    "bulanan" => 1,
    "triwulan" => 3,
    "semester" => 6,
    "tahunan" => 12
];

$months = $periodMap[$row['periode']] ?? 1;

$valid_until = date("Y-m-d", strtotime("+$months months", strtotime($row['tanggal'])));

if ($today <= $valid_until) {
    echo json_encode([
        "status" => "success",
        "ipl" => "lunas",
        "valid_until" => $valid_until
    ]);
} else {
    echo json_encode([
        "status" => "success",
        "ipl" => "belum",
        "valid_until" => $valid_until
    ]);
}
?>
