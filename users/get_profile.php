<?php 
include "../config.php";

$user_id = $_GET['user_id'] ?? '';

if ($user_id == '') {
    echo json_encode(["status" => "error", "message" => "User ID tidak ditemukan"]);
    exit;
}

$sql = $conn->query("SELECT id, username, nama, no_rumah, no_hp, foto FROM users WHERE id='$user_id' LIMIT 1");

if (!$sql) {
    echo json_encode([
        "status" => "error",
        "message" => "SQL Error: " . $conn->error
    ]);
    exit;
}

if ($sql->num_rows > 0) {
    $row = $sql->fetch_assoc();
    $row['foto'] = "http://10.0.2.2/ipl_rt_api/" . $row['foto']; 
    echo json_encode([
        "status" => "success",
        "user" => $row
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "User tidak ditemukan"]);
}
?>
