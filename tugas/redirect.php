<?php
session_start();

if (isset($_SESSION['username']) && isset($_SESSION['id'])) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: admin.php");
    } elseif ($_SESSION['role'] === 'users') {
        header("Location: users/users.php");
    } else {
        header("Location: index.php?error=Role tidak valid");
    }
    exit();
} else {
    header("Location: index.php");
    exit();
}
?>
