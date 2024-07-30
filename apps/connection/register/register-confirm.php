<?php
$confirm_msg = "Sie können sich jetzt einloggen";
unset($_SESSION['error_msg']);
$mysqli = new mysqli($dbhost, $dbuser, $dbpasswd, $dbname);
if ($mysqli->connect_error) {
    $errormsg = 'Verbindung fehlgeschlagen: ' . $mysqli->connect_error;
    $_SESSION['error_msg'] = $errormsg;
    die();
}

$confirmation_code = $_GET['code'];

$stmt = $mysqli->prepare("UPDATE users SET is_confirmed = 1, confirmation_code = NULL WHERE confirmation_code = ?");
$stmt->bind_param("s", $confirmation_code);

if ($stmt->execute() && $stmt->affected_rows > 0) {
    $_SESSION['confirm_message'] = $confirm_msg;
} else {
    $errormsg = "Ungültiger Bestätigungscode.";
    $_SESSION['error_msg'] = $errormsg;
}

$stmt->close();
$mysqli->close();
?>
