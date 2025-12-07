<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "rt_ipl";

$conn = new mysqli($host, $user, $pass, $db);

if($conn->connect_error){
    die(json_encode([
        "status" => "error",
        "message" => "Koneksi gagal: " . $conn->connect_error
    ]));
}

header("Content-Type: application/json");
?>
