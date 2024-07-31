<main class="justify-content-center">
  <div class="container-fluid text-center">
    <div class="row">
      <div class="col text-center">
        <h1 class="">
          <?php
          echo $confirmation_code;
          if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
          }elseif (isset($_SESSION['error_msg'])) {
            echo $_SESSION['error_msg'];
          }else {
            echo 'registriere dich erstmal';
          }
           ?>
        </h1>
      </div>
    </div>
    <div class="row">
      <div class="col text-center">
        <a class="btn btn-primary" href="/" rel="zurück zur Startseite"><i class="fa-solid fa-home"></i>&nbsp;Startseite</a>
      </div>
    </div>
  </div>
</main>
