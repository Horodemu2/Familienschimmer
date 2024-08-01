<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '/kunden/homepages/33/d1016026951/htdocs/apps/config/config.php';

// Redirects
$forward = '<script type="text/javascript">window.location.href = "/";</script>';

ob_start();
session_regenerate_id(true);

if (isset($_SESSION['message'])) {
    unset($_SESSION['message']);
} elseif (isset($_SESSION['error_msg'])) {
    unset($_SESSION['error_msg']);
} elseif (isset($_SESSION['errors'])) {
    unset($_SESSION['errors']);
}

if (isset($_POST['login_token']) && $_POST['login_token'] == $_SESSION['login_token']) {
    if (!empty($_POST['email']) && !empty($_POST['passwd'])) {
        $email = $_POST['email'];
        $passwd = $_POST['passwd'];

        try {
            $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpasswd);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }

        $statement = $pdo->prepare("SELECT * FROM $user_table WHERE email = :email");
        $statement->execute(['email' => $email]);
        $user = $statement->fetch();

        // Überprüfung des Passworts
        if ($user !== false && password_verify($passwd, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['prename'];
            $_SESSION['admin'] = $user['is_admin'];
            echo $forward;
            exit();
        } else {
            $_SESSION['error_msg'] = "E-Mail oder Passwort war ungültig&nbsp;<i class='fa-solid fa-lock'></i><br>";
            echo $forward;
            exit();
        }
    } else {
        $_SESSION['error_msg'] = "Bitte füllen Sie alle Felder aus.";
        echo $forward;
        exit();
    }
} else {
    $_SESSION['error_msg'] = "Diese Seite ist nicht direkt erreichbar. Bitte wenden Sie sich an den admin!";
    echo $forward;
    exit();
}
ob_end_flush();
?>
