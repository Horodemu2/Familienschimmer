<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '/kunden/homepages/33/d1016026951/htdocs/apps/config/config.php';
ob_start();
session_start();
session_regenerate_id(true);
unset($_SESSION['error_message']);
$errorMessage = NULL;

if (isset($_GET['login']) && isset($_POST['login_token']) && $_POST['login_token'] == $_SESSION['login_token']) {

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    $email = $_POST['email'];
    $passwort = $_POST['passwort'];
    $_SESSION['login_csrf'] = $_POST['login_token'];
    $statement = $pdo->prepare("SELECT * FROM $user_table WHERE email = :email");
    $result = $statement->execute(array('email' => $email));
    $user = $statement->fetch();

    // Überprüfung des Passworts
    if ($user !== false && password_verify($passwort, $user['passwort'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['prename'];
        header("Location: /backend/");
        exit();
    } else {
        $_SESSION['error_message'] = "E-Mail oder Passwort war ungültig&nbsp;<i class='fa-solid fa-lock'></i><br>";
        header('Location: /log-in/');
        exit();
    }
} elseif(!isset($_POST['csrf_token'])) {
    $_SESSION['attack'] = true;
    $_SESSION['error_message'] = "Diese Seite ist nicht direkt erreichbar. Bitte wenden Sie sich an den admin!";
    header('Location: /log-in/');
    exit();
}
ob_end_flush();
 ?>
