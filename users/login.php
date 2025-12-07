<?php

error_reporting(0);
ini_set('display_errors', 0);

include "../config.php";

$username = $_POST['username'];
$password = $_POST['password'];

$sql = $conn->query("SELECT * FROM users WHERE username='$username'");

if($sql->num_rows == 1){
    $data = $sql->fetch_assoc();

    if(password_verify($password, $data['password_hash'])){
        echo json_encode([
            "status" => "success",
            "user" => [
                "id" => $data['id'],
                "nama" => $data['nama'],
                "role" => $data['role'],
                "no_rumah" => $data['no_rumah']
            ]
        ]);
        exit;
    }
}

echo json_encode(["status"=>"error","message"=>"Username / password salah"]);
?>
