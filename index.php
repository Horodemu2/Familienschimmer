<?php
include "styles/variables/variables-1.php";
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="de">
<?php include 'header/header-1-0.php'; ?>
<body class="bg-1">
  <?php
  include 'navbar/navbar-1-0.php';
  include 'body/index/index-body-1-0.php';
  ?>
</body>
<footer>
  <?php
  include 'footer/footer-1-0.php';
   ?>
</footer>
</html>
