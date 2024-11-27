
<!DOCTYPE html>
<html>
<head>
  <title>mywebsite</title>
  <link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
  <div id="container">
    <div id="header" style="display: flex;">
      <img src="images/941898.jpg" width="100" height="80">
     <h1>Admin</h1>
    </div>

    <div id="sidebar">
      <h3>navigasi</h3>
      <ul id="navmenu">
        <li><a href="?module=insert#pos" class="selected">Insert </a></li>
        <li><a href="?module=view#pos">View</a></li>
        <li><a href="?module=search#pos">Search</a></li>
      </ul>
    </div>

    <div id="page">
      
    <?php 
    if(isset($_GET['module'])) 
    include "konten/$_GET[module].php";
  else 
    include "konten/insert.php";
    ?>

    </div>

    <div id="clear"></div>

    <div id="footer">
      <p>&copy; 2010</p>
    </div>
  </div>
</body>
</html>