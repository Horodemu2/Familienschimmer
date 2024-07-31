<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '/kunden/homepages/33/d1016026951/htdocs/apps/config/config.php';

$confirm_msg = "Sie können sich jetzt einloggen";
unset($_SESSION['error_msg']);

$mysqli = new mysqli($dbhost, $dbuser, $dbpasswd, $dbname);
if ($mysqli->connect_error) {
    $_SESSION['error_msg'] = 'Verbindung fehlgeschlagen: ' . htmlspecialchars($mysqli->connect_error);
    die();
}

if (isset($_GET['code'])) {
    $confirmation_code = $_GET['code'];

    // Debugging: Ausgabe des Bestätigungscodes
    echo 'Bestätigungscode: ' . htmlspecialchars($confirmation_code) . '<br>';

    // Überprüfung, ob der Bestätigungscode in der Datenbank vorhanden ist
    $stmt_check = $mysqli->prepare("SELECT * FROM users WHERE confirmation_code = ?");
    if ($stmt_check) {
        $stmt_check->bind_param("s", $confirmation_code);
        $stmt_check->execute();
        $result = $stmt_check->get_result();

        if ($result->num_rows > 0) {
            // Debugging: Bestätigungscode gefunden
            echo 'Bestätigungscode gefunden in der Datenbank.<br>';

            // Benutzer bestätigen
            $stmt_update = $mysqli->prepare("UPDATE users SET is_confirmed = 1, confirmation_code = NULL WHERE confirmation_code = ?");
            if ($stmt_update) {
                $stmt_update->bind_param("s", $confirmation_code);

                if ($stmt_update->execute()) {
                    // Debugging: Anzahl der betroffenen Zeilen ausgeben
                    echo 'Betroffene Zeilen: ' . $stmt_update->affected_rows . '<br>';

                    if ($stmt_update->affected_rows > 0) {
                        $_SESSION['message'] = $confirm_msg;
                    } else {
                        $_SESSION['error_msg'] = "Fehler beim Aktualisieren der Bestätigung.";
                    }
                } else {
                    $_SESSION['error_msg'] = "Fehler bei der Ausführung: " . htmlspecialchars($stmt_update->error);
                }
                $stmt_update->close();
            } else {
                $_SESSION['error_msg'] = 'Fehler beim Vorbereiten der Update-Anfrage: ' . htmlspecialchars($mysqli->error);
            }
        } else {
            $_SESSION['error_msg'] = "Ungültiger Bestätigungscode.";
        }
        $stmt_check->close();
    } else {
        $_SESSION['error_msg'] = 'Fehler beim Vorbereiten der Überprüfungs-Anfrage: ' . htmlspecialchars($mysqli->error);
    }
} else {
    $_SESSION['error_msg'] = 'Kein Bestätigungscode angegeben.';
}

$mysqli->close();
?>
