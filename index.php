<?php
// phpinfo();
include '/kunden/homepages/33/d1016026951/htdocs/apps/config/config.php';
?>
<!DOCTYPE html>
<html lang="de" prefix="og: http://ogp.me/ns#">
  <?php include '/kunden/homepages/33/d1016026951/htdocs/header/header-1-0.php'; ?>
  <body class="bg-1">
    <?php
    include '/kunden/homepages/33/d1016026951/htdocs/navbar/navbar-1-0.php';
    if(!isset($_SESSION['user_id'])) {
      include '/kunden/homepages/33/d1016026951/htdocs/body/index/index-body-1-0.php';
    };
    include '/kunden/homepages/33/d1016026951/htdocs/navbar/navbar-bottom.php';
    ?>

  </body>
  <footer>
    <?php
      include '/kunden/homepages/33/d1016026951/htdocs/footer/footer-1-0.php';
     ?>
   </footer>
</html>
