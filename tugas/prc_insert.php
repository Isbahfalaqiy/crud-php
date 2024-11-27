<?php
include "conn.php";

// Mendapatkan data dari form dengan sanitasi
$first_name = $conn->real_escape_string($_POST['first_name']);
$last_name = $conn->real_escape_string($_POST['last_name']);
$username = $conn->real_escape_string($_POST['username']);
$password = $conn->real_escape_string($_POST['password']);
$age = (int)$_POST['age']; // Pastikan age berupa integer
$gender = $conn->real_escape_string($_POST['gender']);
$birth_date = $conn->real_escape_string($_POST['birth_date']);
$email = $conn->real_escape_string($_POST['email']);
$phone = $conn->real_escape_string($_POST['phone']);
$role = $conn->real_escape_string($_POST['role']);

// Menyimpan data ke dalam tabel users menggunakan prepared statement
$stmt = $conn->prepare("INSERT INTO users (first_name, last_name, username, password, age, gender, birth_date, email, phone, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssisssss", $first_name, $last_name, $username, $password, $age, $gender, $birth_date, $email, $phone, $role);

if ($stmt->execute()) {
    echo "Registrasi berhasil!";
    header("Location: admin.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

// Menutup koneksi
$stmt->close();
$conn->close();
?>
