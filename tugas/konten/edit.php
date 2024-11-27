<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pbp";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data berdasarkan ID dengan prepared statement
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();
}

// Update data ke database
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];
    $age = (int)$_POST['age'];
    $gender = $conn->real_escape_string($_POST['gender']);
    $birth_date = $conn->real_escape_string($_POST['birth_date']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $role = $conn->real_escape_string($_POST['role']);

    $stmt = $conn->prepare("UPDATE users SET 
        first_name = ?, 
        last_name = ?, 
        username = ?, 
        password = ?, 
        age = ?, 
        gender = ?, 
        birth_date = ?, 
        email = ?, 
        phone = ?, 
        role = ? 
        WHERE id = ?");
    $stmt->bind_param("ssssisssssi", $first_name, $last_name, $username, $password, $age, $gender, $birth_date, $email, $phone, $role, $id);

    if ($stmt->execute()) {
        echo "<script>
            alert('Data berhasil diperbarui!');
            window.location.href = 'admin.php?module=view#pos';
        </script>";
    } else {
        echo "<script>
            alert('Gagal memperbarui data: " . $stmt->error . "');
            window.location.href = 'admin.php?module=edit&id=$id';
        </script>";
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pengguna</title>
    <style>
        form {
            width: 80%;
            max-width: 800px;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin: auto;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"], input[type="password"], input[type="number"], input[type="email"], input[type="tel"], input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        a {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #f44336;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Edit Data Pengguna</h2>
    <form method="POST" action="">
        <label for="first_name">Nama Depan:</label>
        <input type="text" id="first_name" name="first_name" value="<?php echo $data['first_name']; ?>" required>

        <label for="last_name">Nama Belakang:</label>
        <input type="text" id="last_name" name="last_name" value="<?php echo $data['last_name']; ?>" required>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo $data['username']; ?>" required>

        <label for="password">Password (Kosongkan jika tidak ingin mengubah):</label>
        <input type="password" id="password" name="password">

        <label for="age">Usia:</label>
        <input type="number" id="age" name="age" value="<?php echo $data['age']; ?>" required>

        <label for="gender">Jenis Kelamin:</label>
        <input type="text" id="gender" name="gender" value="<?php echo $data['gender']; ?>" required>

        <label for="birth_date">Tanggal Lahir:</label>
        <input type="date" id="birth_date" name="birth_date" value="<?php echo $data['birth_date']; ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $data['email']; ?>" required>

        <label for="phone">Nomor Telepon:</label>
        <input type="tel" id="phone" name="phone" value="<?php echo $data['phone']; ?>" required>
        
        <label for="role">Role:</label>
        <div style="display: flex;">
        <input type="radio" id="admin" name="role" value="admin" <?php echo ($data['role'] == 'admin') ? 'checked' : ''; ?>>
        <label style="margin-top: 5px;" for="admin">Admin</label>
        <input type="radio" id="users" name="role" value="users" <?php echo ($data['role'] == 'users') ? 'checked' : ''; ?>>
        <label style="margin-top: 5px;" for="users">Users</label>
        </div>
        <div style="display: flex; justify-content: space-between; margin-top: 20px;">
            <button type="submit">Simpan Perubahan</button>
            <a href="admin.php?module=view#pos">Batal</a>
        </div>
    </form>
</body>
</html>
