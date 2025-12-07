<?php
include "../config.php";

$user_id      = $_POST['user_id'];
$old_password = $_POST['old_password'];
$new_password = $_POST['new_password'];

$user = $conn->query("SELECT password_hash FROM users WHERE id='$user_id'")
             ->fetch_assoc();

if(!$user){
    echo json_encode(["status"=>"error","message"=>"User tidak ditemukan"]);
    exit;
}

if(!password_verify($old_password, $user['password_hash'])){
    echo json_encode(["status"=>"error","message"=>"Password lama salah"]);
    exit;
}

$new_hash = password_hash($new_password, PASSWORD_DEFAULT);

$sql = $conn->query("
    UPDATE users
    SET password_hash='$new_hash'
    WHERE id='$user_id'
");

if($sql){
    echo json_encode(["status"=>"success","message"=>"Password berhasil diganti"]);
} else {
    echo json_encode(["status"=>"error","message"=>"Gagal mengganti password"]);
}
?>
