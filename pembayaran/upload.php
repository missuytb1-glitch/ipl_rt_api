<?php
include "../config.php";

header("Content-Type: application/json");

if (!isset($_FILES["bukti"])) {
    echo json_encode(["status" => "error", "message" => "FILE bukti tidak diterima"]);
    exit;
}

$user_id = $_POST['user_id'] ?? '';
$nominal = $_POST['nominal'] ?? '';

if ($user_id == '' || $nominal == '') {
    echo json_encode(["status" => "error", "message" => "POST tidak lengkap"]);
    exit;
}

$uploadDir = "../uploads/";
if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

$filename = time() . "_" . basename($_FILES["bukti"]["name"]);
$targetFile = $uploadDir . $filename;
$filePathDb = "uploads/" . $filename;

$errorCode = $_FILES["bukti"]["error"];
if ($errorCode !== 0) {
    echo json_encode([
        "status" => "error",
        "message" => "File upload error code: $errorCode"
    ]);
    exit;
}

if (!move_uploaded_file($_FILES["bukti"]["tmp_name"], $targetFile)) {
    echo json_encode([
        "status" => "error",
        "message" => "move_uploaded_file gagal"
    ]);
    exit;
}

$sql = "INSERT INTO pembayaran (user_id, nominal, foto, status)
        VALUES ('$user_id', '$nominal', '$filePathDb', 'pending')";

if (!$conn->query($sql)) {
    echo json_encode([
        "status" => "error",
        "message" => "SQL Error: " . $conn->error
    ]);
    exit;
}

echo json_encode(["status" => "success", "message" => "Upload berhasil"]);
?>
