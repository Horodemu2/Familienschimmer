<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '/kunden/homepages/33/d1016026951/htdocs/apps/config/config.php';

// Redirects
$forward = '<script type="text/javascript">window.location.href = "/registrieren/";</script>';
$forwardsuc = '<script type="text/javascript">window.location.href = "/";</script>';

if (isset($_SESSION['message'])) {
    unset($_SESSION['message']);
} elseif (isset($_SESSION['error_msg'])) {
    unset($_SESSION['error_msg']);
} elseif (isset($_SESSION['errors'])) {
    unset($_SESSION['errors']);
};

$mysqli = new mysqli($dbhost, $dbuser, $dbpasswd, $dbname);
if ($mysqli->connect_error) {
    $errormsg = 'Verbindung fehlgeschlagen: ' . $mysqli->connect_error;
    $_SESSION['error_msg'] = $errormsg;
    echo $forward;
    die();
}

// Get POST data
$email = isset($_POST['email']) ? $_POST['email'] : null;
$surname = isset($_POST['surname']) ? $_POST['surname'] : null;
$prename = isset($_POST['prename']) ? $_POST['prename'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;
$password_confirm = isset($_POST['password_confirm']) ? $_POST['password_confirm'] : null;
$login_token = isset($_POST['login_token']) ? $_POST['login_token'] : null;

$errors = null;

// Check if email already exists
if ($email) {
    $stmt = $mysqli->prepare("SELECT id FROM $user_table WHERE email = ?");
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $_SESSION['error_msg'] = "Diese E-Mail-Adresse wird bereits verwendet.";
            echo $forward;
            $stmt->close();
            exit();
        }
        $stmt->close();
    } else {
        $_SESSION['error_msg'] = "Datenbankfehler: " . $mysqli->error;
        echo $forward;
        exit();
    }
}

// Validation
if (!$email) {
    $_SESSION['error_msg'] = "Bitte eine gültige Email-Adresse eingeben.";
    echo $forward;
    exit();
}

if (empty($surname)) {
    $_SESSION['error_msg'] = "Bitte den Nachnamen eingeben.";
    echo $forward;
    exit();
}

if (empty($prename)) {
    $_SESSION['error_msg'] = "Bitte den Vornamen eingeben.";
    echo $forward;
    exit();
}

if (empty($password)) {
    $_SESSION['error_msg'] = "Bitte das Passwort eingeben.";
    echo $forward;
    exit();
}

if (empty($password_confirm)) {
    $_SESSION['error_msg'] = "Bitte das Passwort wiederholt eingeben.";
    echo $forward;
    exit();
}

if ($password !== $password_confirm) {
    $_SESSION['error_msg'] = "Die Passwörter stimmen nicht überein.";
    echo $forward;
    exit();
}

// CSRF-Token Überprüfung
if ($_SESSION['login_token'] !== $login_token) {
    $_SESSION['error_msg'] = "Ungültiger Token.";
    echo $forward;
    exit();
}

// Passwort verschlüsseln
$hashed_password = password_hash($password, PASSWORD_BCRYPT);
$confirmation_code = $_SESSION['login_token'];

// Benutzer in die Datenbank einfügen
$stmt = $mysqli->prepare("INSERT INTO $user_table (surname, prename, email, password, is_admin, confirmation_code) VALUES (?, ?, ?, ?, 0, ?)");
if ($stmt) {
    $stmt->bind_param("sssss", $surname, $prename, $email, $hashed_password, $confirmation_code);

    if ($stmt->execute()) {
        $confirm_url = "https://guerschi.family/registrieren/confirm.php?code=" . urlencode($confirmation_code);

        $to = $email;
        $subject = "Bitte bestätigen Sie Ihre E-Mail-Adresse";
        $message = "Hallo $prename,\n\nBitte klicken Sie auf den folgenden Link, um Ihre E-Mail-Adresse zu bestätigen:\n\n$confirm_url\n\nVielen Dank!";
        $headers = "From: no-reply@guerschi.family\r\n";

        if (mail($to, $subject, $message, $headers)) {
            $_SESSION['message'] = "Registrierung erfolgreich. Bitte überprüfen Sie Ihre E-Mail, um Ihre Adresse zu bestätigen.";
            echo $forwardsuc;
        } else {
            $_SESSION['error_msg'] = "Fehler beim Versenden der Bestätigungs-E-Mail.";
            echo $forward;
        }
    } else {
        $_SESSION['error_msg'] = "Fehler bei der Registrierung: " . $stmt->error;
        echo $forward;
    }

    $stmt->close();
} else {
    $_SESSION['error_msg'] = "Datenbankfehler: " . $mysqli->error;
    echo $forward;
}

$mysqli->close();
?>
