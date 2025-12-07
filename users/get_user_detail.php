<?php
include "../config.php";

$user_id = $_GET['id'];

$sql = $conn->query("SELECT id, nama, no_rumah, no_hp, username, foto FROM users WHERE id='$user_id'");

if ($sql->num_rows > 0) {
    echo json_encode([
        "status" => "success",
        "user" => $sql->fetch_assoc()
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "User tidak ditemukan"]);
}
?>
