<?php
include "../config.php";

$user_id = $_POST['user_id'] ?? '';
$no_hp   = $_POST['no_hp'] ?? '';

if ($user_id == '' || $no_hp == '') {
    echo json_encode([
        "status" => "error",
        "message" => "Data tidak lengkap",
        "user_id" => $user_id,
        "no_hp" => $no_hp
    ]);
    exit;
}

$sql = $conn->query("UPDATE users SET no_hp='$no_hp' WHERE id='$user_id'");

if ($sql) {
    echo json_encode([
        "status" => "success",
        "message" => "Nomor HP diperbarui",
        "no_hp" => $no_hp
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => $conn->error
    ]);
}
?>
