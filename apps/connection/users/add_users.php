<?php

ini_set('display_errors', 0);  // Fehler nicht direkt ausgeben
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

$_SESSION['error_msg'] = NULL;
$_SESSION['success_msg'] = NULL;

$forward = '<script type="text/javascript">window.location.href = "/backend/users/";</script>';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {
    $prename = $_POST['prename'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $is_confirmed = isset($_POST['is_confirmed']) ? 1 : 0;
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;

    // Generiere eine eindeutige Benutzer-ID
    $userId = uniqid();

    // Verzeichnis für das Profilbild
    $targetDir = $_SERVER['DOCUMENT_ROOT'] . '/pictures/profil/' . $userId . '/';

    // Überprüfen, ob ein Bild hochgeladen wurde
    if (!empty($_FILES['profilpicture']['name'])) {
        $fileSize = $_FILES['profilpicture']['size'];
        $fileTmp = $_FILES['profilpicture']['tmp_name'];
        $fileName = basename($_FILES['profilpicture']['name']);
        $targetFilePath = $targetDir . $fileName;

        // Maximale Dateigröße: 8 MB
        if ($fileSize > 8 * 1024 * 1024) {
            $_SESSION['error_msg'] = "Das Bild darf nicht größer als 8 MB sein.";
            echo $forward;
            exit;
        }

        // Bildgröße überprüfen
        list($width, $height) = getimagesize($fileTmp);
        if ($width > 400 || $height > 400) {
            $_SESSION['error_msg'] = "Das Bild darf nicht größer als 400x400 Pixel sein.";
            echo $forward;
            exit;
        }

        // Erstellen des Verzeichnisses, falls es nicht existiert
        if (!file_exists($targetDir)) {
            if (!mkdir($targetDir, 0777, true)) {
                $_SESSION['error_msg'] = "Fehler beim Erstellen des Verzeichnisses.";
                echo $forward;
                exit;
            }
        }

        // Datei hochladen
        if (!move_uploaded_file($fileTmp, $targetFilePath)) {
            $_SESSION['error_msg'] = "Fehler beim Hochladen des Bildes.";
            echo $forward;
            exit;
        }
        $profilpicture = $fileName;

        // Benutzer mit Profilbild hinzufügen
        $stmt = $mysqli->prepare("INSERT INTO users (id, prename, surname, email, password, is_confirmed, is_admin, profilpicture) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssissss", $userId, $prename, $surname, $email, $password, $is_confirmed, $is_admin, $profilpicture);
    } else {
        // Benutzer ohne Profilbild hinzufügen
        $stmt = $mysqli->prepare("INSERT INTO users (id, prename, surname, email, password, is_confirmed, is_admin) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssissi", $userId, $prename, $surname, $email, $password, $is_confirmed, $is_admin);
    }

    if ($stmt->execute()) {
        $_SESSION['success_msg'] = "Benutzer hinzugefügt.";
    } else {
        $_SESSION['error_msg'] = "Fehler beim Hinzufügen des Benutzers: " . $stmt->error;
    }
    $stmt->close();

    // Weiterleitung nach der Verarbeitung
    echo $forward;
    exit;
}
?>
