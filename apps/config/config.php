<?php
//Fehlerprüfung
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Session Start
session_start();
// includings
include '/kunden/homepages/33/d1016026951/htdocs/styles/variables/variables-1.php';
// include '/kunden/homepages/33/d1016026951/htdocs/apps/config/current-path.php';
include '/kunden/homepages/33/d1016026951/htdocs/apps/connection/login/login-env.php';
include '/kunden/homepages/33/d1016026951/htdocs/apps/connection/login/login-db.php';
// include '/kunden/homepages/33/d1016026951/htdocs/apps/connection/login/login-dbconnect.php';
// login sets
  // Generate a random token
  if(!isset($_SESSION['login_token'])){
    $login_token_set = bin2hex(random_bytes(32));
    $_SESSION['login_token'] = $login_token_set;
  }
 ?>
