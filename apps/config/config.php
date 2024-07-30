<?php
//Fehlerprüfung
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL)
// Session Start
session_start();
// includings
include '/kunden/homepages/33/d1016026951/htdocs/styles/variables/variables-1.php';
include '/kunden/homepages/33/d1016026951/htdocs/apps/config/current_path.php';
include '/kunden/homepages/33/d1016026951/htdocs/apps/connection/login/login-db.php';
include '/kunden/homepages/33/d1016026951/htdocs/apps/connection/login/login-dbconnection.php';
include '/kunden/homepages/33/d1016026951/htdocs/apps/connection/login/login-env.php';
// login sets
  // Generate a random token
$login_token_set = bin2hex(random_bytes(64));
$_SESSION['login_token'] = $login_token_set;
 ?>
