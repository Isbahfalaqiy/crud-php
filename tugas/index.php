<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style/login.css">
</head>
<body>
<div class="wrapper fadeInDown">
  <div id="formContent">
    <h2 class="active">Sign In</h2>
    <div class="fadeIn first">
      <img src="images/user.png" id="icon" alt="User Icon" />
    </div>
    <form action="./check-login.php" method="post">
      <input type="text" id="username" class="fadeIn second" name="username" placeholder="Username" required>
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="Password" required>
      <input type="submit" class="fadeIn fourth" value="Log In">
    </form>
    <?php
    if (isset($_GET['error'])) {
        echo '<p style="color: red;">' . htmlspecialchars($_GET['error']) . '</p>';
    }
    ?>
  </div>
</div>
</body>
</html>
