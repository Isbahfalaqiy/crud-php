<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pbp";

try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("utf8mb4");
    if ($conn->connect_error) {
        throw new Exception("Koneksi gagal: " . $conn->connect_error);
    }
} catch (Exception $e) {
    die("Terjadi kesalahan: " . $e->getMessage());
}
?>
