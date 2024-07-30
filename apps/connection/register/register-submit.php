<?php
include '/kunden/homepages/33/d1016026951/htdocs/apps/config/config.php';

$mysqli = new mysqli($dbhost, $dbuser, $dbpasswd, $dbname);
if ($mysqli->connect_error) {
    $errormsg = 'Verbindung fehlgeschlagen: ' . $mysqli->connect_error;
    $_SESSION['error_msg'] = $errormsg;
    die();
}

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$surname = filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_STRING);
$prename = filter_input(INPUT_POST, 'prename', FILTER_SANITIZE_STRING);
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];
$login_token = $_POST['login_token'];

$errors = [];

if (!$email) {
    $errors[] = "Bitte eine gültige Email-Adresse eingeben.";
}

if (empty($surname)) {
    $errors[] = "Bitte den Nachnamen eingeben.";
}

if (empty($prename)) {
    $errors[] = "Bitte den Vornamen eingeben.";
}

if (empty($password)) {
    $errors[] = "Bitte das Passwort eingeben.";
}

if (empty($password_confirm)) {
    $errors[] = "Bitte das Passwort wiederholt eingeben.";
}

if ($password !== $password_confirm) {
    $errors[] = "Die Passwörter stimmen nicht überein.";
}

// CSRF-Token Überprüfung
if ($_SESSION['login_token'] !== $login_token) {
    $errors[] = "Ungültiger Token.";
}

// Wenn es Fehler gibt, zurück zur Registrierungsseite
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: /registrieren/");
    exit();
}

// Passwort verschlüsseln
$hashed_password = password_hash($password, PASSWORD_BCRYPT);
$confirmation_code = bin2hex(random_bytes(32));

// Benutzer in die Datenbank einfügen
$stmt = $mysqli->prepare("INSERT INTO users (surname, prename, email, password, is_admin, confirmation_code) VALUES (?, ?, ?, ?, 0, ?)");
$stmt->bind_param("sssss", $surname, $prename, $email, $hashed_password, $confirmation_code);


if ($stmt->execute()) {
    $confirm_url = "https://guerschi.family/registrieren/confirm.php?code=" . urlencode($confirmation_code);

    $to = $email;
    $subject = "Bitte bestätigen Sie Ihre E-Mail-Adresse";
    $message = "Hallo $prename,\n\nBitte klicken Sie auf den folgenden Link, um Ihre E-Mail-Adresse zu bestätigen:\n\n$confirm_url\n\nVielen Dank!";
    $headers = "From: no-reply@guerschi.family\r\n";

    if (mail($to, $subject, $message, $headers)) {
        $_SESSION['message'] = "Registrierung erfolgreich. Bitte überprüfen Sie Ihre E-Mail, um Ihre Adresse zu bestätigen.";
        header("Location: /");
    } else {
        $_SESSION['error_msg'] = "Fehler beim Versenden der Bestätigungs-E-Mail.";
        header("Location: /registrieren/");
    }
} else {
    $_SESSION['error_msg'] = "Fehler bei der Registrierung: " . $stmt->error;
    header("Location: /registrieren/");
}

// Statement und Verbindung schließen
$stmt->close();
$mysqli->close();
?>
