<?php
session_start();
include 'conn.php'; // Pastikan file ini berisi koneksi database yang benar

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // Query untuk mendapatkan user berdasarkan username
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Jika password menggunakan hash
        // if (password_verify($password, $row['password'])) {
        // Jika password disimpan sebagai teks biasa
        if ($password === $row['password']) {
            // Simpan data ke sesi
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            // Redirect berdasarkan role
            if ($row['role'] === 'admin') {
                header("Location: admin.php");
            } elseif ($row['role'] === 'users') {
                header("Location: users.php");
            } else {
                header("Location: index.php?error=Role tidak valid");
            }
            exit();
        } else {
            header("Location: index.php?error=Password salah");
            exit();
        }
    } else {
        header("Location: index.php?error=Username tidak ditemukan");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>
