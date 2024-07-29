<?php
// phpinfo();
include "styles/variables/variables-1.php";
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="de">
  <?php include 'header/header-1-0.php'; ?>
  <body class="bg-1">
    <?php
    include 'navbar/navbar-1-0.php';
    if(!isset($_SESSION['user_id'])) {
      include 'body/index/index-body-1-0.php';
    }
    ?>
    <nav class="navbar fixed-bottom bg-body-tertiary">
      <div class="container-fluid text-center">
        <table class="table text-small">
          <thead>
            <tr>
              <th scope="col">
                Projekt von:
              </th>
              <th scope="col">
                Verantwortlich für den Inhalt:
              </th>
              <th scope="col">
                Verwendete Programmiersprachen
              </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td scope="row">
                <small>
                  Helen Nonhoff<br />
                  und<br />
                  Niklas Schimmer
                </small>
              </th>
              <td>
                <small>
                  Niklas Schimmer<br />
                  Prieser Höhe 2<br />
                  24159 Kiel
                </small>
              </td>
              <td>
                <small>
                  PHP 8.2<br />
                  HTML5<br />
                  scss/sass<br />
                  js<br />
                </small>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </nav>
  </body>
  <footer>
    <?php
      include 'footer/footer-1-0.php';
     ?>
   </footer>
</html>
