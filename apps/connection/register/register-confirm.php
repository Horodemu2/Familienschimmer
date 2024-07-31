<?php
include '/kunden/homepages/33/d1016026951/htdocs/apps/connection/login/login-env.php';

$dbhost = getenv('DB_HOST');
$dbuser = getenv('DB_USERNAME');
$dbpasswd = getenv('DB_PASSWORD');
$dbname = getenv('DB_NAME');
$dbtable = getenv('USER_TABLE');

$confirm_msg = "Sie können sich jetzt einloggen";
unset($_SESSION['error_msg']);
$mysqli = new mysqli($dbhost, $dbuser, $dbpasswd, $dbname);
if ($mysqli->connect_error) {
    $errormsg = 'Verbindung fehlgeschlagen: ' . $mysqli->connect_error;
    $_SESSION['error_msg'] = $errormsg;
    die();
}

$confirmation_code = $_GET['code'];
echo $confirmation_code;

$stmt = $mysqli->prepare("UPDATE $dbtable SET is_confirmed = 1, confirmation_code = NULL WHERE confirmation_code = ?");
$stmt->bind_param("s", $confirmation_code);

if ($stmt->execute() && $stmt->affected_rows > 0) {
    $_SESSION['message'] = $confirm_msg;
} else {
    $errormsg = "Ungültiger Bestätigungscode.";
    $_SESSION['error_msg'] = $errormsg;
}

$stmt->close();
$mysqli->close();
?>
