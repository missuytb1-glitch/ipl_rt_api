<?php
include "../config.php";

$nama      = $_POST['nama'];
$no_rumah  = $_POST['no_rumah'];
$no_hp     = $_POST['no_hp'];
$username  = $_POST['username'];
$password  = $_POST['password'];

$hash = password_hash($password, PASSWORD_DEFAULT);

$sql = $conn->query("
    INSERT INTO users (nama, no_rumah, no_hp, username, password_hash, role)
    VALUES ('$nama', '$no_rumah', '$no_hp', '$username', '$hash', 'warga')
");

if($sql){
    echo json_encode(["status"=>"success","message"=>"Warga berhasil ditambahkan"]);
} else {
    echo json_encode(["status"=>"error","message"=>"Gagal menambah warga"]);
}
?>
