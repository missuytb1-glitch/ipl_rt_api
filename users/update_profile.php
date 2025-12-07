<?php
include "../config.php";

$user_id  = $_POST['user_id'];
$nama     = $_POST['nama'];
$no_rumah = $_POST['no_rumah'];
$no_hp    = $_POST['no_hp'];

$sql = $conn->query("
    UPDATE users
    SET nama='$nama',
        no_rumah='$no_rumah',
        no_hp='$no_hp'
    WHERE id='$user_id'
");

if($sql){
    echo json_encode([
        "status" => "success",
        "message" => "Profil berhasil diperbarui"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Gagal update profil"
    ]);
}
?>
