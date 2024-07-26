<?php
include "../styles/variables/variables-1.php";
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="de">
<?php include '../header/header-1-0.php'; ?>
<body class="bg-1">
  <?php
  include '../navbar/navbar-1-0.php';
  ?>
  <main class="container-fluid">
    <div class="container position-absolute top-50 start-0">
      <div class="row">
        <div class="offset-lg-8 col-4 error-msg">
          <h1>
            das ist ein Error404!
          </h1>
        </div>
      </div>
    </div>
  </main>
