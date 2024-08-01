<?php
include '/kunden/homepages/33/d1016026951/htdocs/apps/config/config.php';
include '/kunden/homepages/33/d1016026951/htdocs/apps/connection/login/login-dbconnect.php';
ini_set('display_errors', 0);  // Fehler nicht direkt ausgeben
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

$_SESSION['error_msg'] = NULL;
$_SESSION['success_msg'] = NULL;
$forward = '<script type="text/javascript">window.location.href = "/backend/users/";</script>';
// Verbindung zur Datenbank herstellen


// Benutzer hinzufügen
include '/kunden/homepages/33/d1016026951/htdocs/apps/connection/users/add_users.php';
// Benutzer bearbeiten
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_user'])) {
        $userId = $_POST['id'];
        $prename = $_POST['prename'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $is_confirmed = isset($_POST['is_confirmed']) ? 1 : 0;
        $is_admin = isset($_POST['is_admin']) ? 1 : 0;

        // Verzeichnis für das Profilbild
        $targetDir = $_SERVER['DOCUMENT_ROOT'] . '/pictures/profil/' . $userId . '/';

        // Überprüfen, ob ein neues Bild hochgeladen wurde  
        if (!empty($_FILES['profilpicture']['name'])) {
            $fileSize = $_FILES['profilpicture']['size'];
            $fileTmp = $_FILES['profilpicture']['tmp_name'];
            $fileName = basename($_FILES['profilpicture']['name']);
            $targetFilePath = $targetDir . $fileName;

            // Maximale Dateigröße: 8 MB
            if ($fileSize > 8 * 1024 * 1024) {
                $_SESSION['error_msg'] = "Das Bild darf nicht größer als 8 MB sein.";
                echo $forward;
                exit;  // Stoppe das Skript bei Fehler
            }

            // Bildgröße überprüfen
            list($width, $height) = getimagesize($fileTmp);
            if ($width > 400 || $height > 400) {
                $_SESSION['error_msg'] = "Das Bild darf nicht größer als 400x400 Pixel sein.";
                echo $forward;
                exit;  // Stoppe das Skript bei Fehler
            }

            // Erstellen des Verzeichnisses, falls es nicht existiert
            if (!file_exists($targetDir)) {
                if (!mkdir($targetDir, 0777, true)) {
                    $_SESSION['error_msg'] = "Fehler beim Erstellen des Verzeichnisses.";
                    echo $forward;
                    exit;  // Stoppe das Skript bei Fehler
                }
            }

            // Datei hochladen
            if (!move_uploaded_file($fileTmp, $targetFilePath)) {
                $_SESSION['error_msg'] = "Fehler beim Hochladen des Bildes.";
                echo $forward;
                exit;  // Stoppe das Skript bei Fehler
            }
            $profilpicture = $fileName;

            // Aktualisieren der Benutzerdaten einschließlich Profilbild
            $stmt = $mysqli->prepare("UPDATE users SET prename = ?, surname = ?, email = ?, is_confirmed = ?, is_admin = ?, profilpicture = ? WHERE id = ?");
            $stmt->bind_param("sssissi", $prename, $surname, $email, $is_confirmed, $is_admin, $profilpicture, $userId);
        } else {
            // Ohne Bildaktualisierung
            $stmt = $mysqli->prepare("UPDATE users SET prename = ?, surname = ?, email = ?, is_confirmed = ?, is_admin = ? WHERE id = ?");
            $stmt->bind_param("sssiii", $prename, $surname, $email, $is_confirmed, $is_admin, $userId);
        }

        if ($is_confirmed) {
            $stmt = $mysqli->prepare("UPDATE users SET prename = ?, surname = ?, email = ?, is_confirmed = ?, is_admin = ?, confirmation_code = NULL WHERE id = ?");
            $stmt->bind_param("sssiii", $prename, $surname, $email, $is_confirmed, $is_admin, $userId);
        } else {
            $stmt = $mysqli->prepare("UPDATE users SET prename = ?, surname = ?, email = ?, is_confirmed = ?, is_admin = ? WHERE id = ?");
            $stmt->bind_param("sssiii", $prename, $surname, $email, $is_confirmed, $is_admin, $userId);
        }

        if ($stmt->execute()) {
            $_SESSION['success_msg'] = "Benutzerdaten aktualisiert.";
        } else {
            $_SESSION['error_msg'] = "Fehler beim Aktualisieren der Benutzerdaten: " . $stmt->error;
        }
        $stmt->close();

        // Weiterleitung nach der Verarbeitung
        echo $forward;
        exit;  // Stoppe das Skript nach der Weiterleitung
    } elseif (isset($_POST['delete_user'])) {
        $userId = $_POST['id'];
        $stmt = $mysqli->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        if ($stmt->execute()) {
            $_SESSION['success_msg'] = "Benutzer gelöscht.";
        } else {
            $_SESSION['error_msg'] = "Fehler beim Löschen des Benutzers: " . $stmt->error;
        }
        $stmt->close();

        // Weiterleitung nach der Verarbeitung
        echo $forward;
        exit;  // Stoppe das Skript nach der Weiterleitung
    }
}
?>
