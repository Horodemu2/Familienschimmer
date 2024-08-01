<?php
$forward = '<script type="text/javascript">window.location.href = "/";</script>';
$mysqli = new mysqli($dbhost, $dbuser, $dbpasswd, $dbname);
if ($mysqli->connect_error) {
    $_SESSION['error_msg'] = 'Verbindung fehlgeschlagen: ' . $mysqli->connect_error;
    echo $forward;
    exit;  // Stoppe das Skript bei Verbindungsfehler
}
 ?>
