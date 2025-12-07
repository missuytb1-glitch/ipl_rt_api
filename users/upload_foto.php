<?php
include "../config.php";

if (!isset($_POST['user_id'])) {
    echo json_encode(["status" => "error", "message" => "User ID tidak ada"]);
    exit;
}

$user_id = $_POST['user_id'];

if (!isset($_FILES['foto'])) {
    echo json_encode(["status" => "error", "message" => "File tidak ditemukan"]);
    exit;
}

$folder = "../uploads/";
if (!file_exists($folder)) {
    mkdir($folder, 0777, true);
}

$filename = "foto_" . time() . ".jpg";
$path = $folder . $filename;

if (move_uploaded_file($_FILES['foto']['tmp_name'], $path)) {

    $publicPath = "uploads/" . $filename;

    $sql = "UPDATE users SET foto='$publicPath' WHERE id='$user_id'";
    if ($conn->query($sql)) {
        echo json_encode([
            "status" => "success",
            "message" => "Foto berhasil diperbarui",
            "foto" => $publicPath
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal update database"]);
    }

} else {
    echo json_encode(["status" => "error", "message" => "Gagal upload file"]);
}
?>
