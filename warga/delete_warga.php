<?php
include "../config.php";

$id = $_POST['id'];

$sql = $conn->query("DELETE FROM users WHERE id='$id' AND role='warga'");

if($sql){
    echo json_encode([
        "status"=>"success",
        "message"=>"Warga berhasil dihapus"
    ]);
} else {
    echo json_encode([
        "status"=>"error",
        "message"=>"Gagal menghapus warga"
    ]);
}
?>
