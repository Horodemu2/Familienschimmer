<div class="card border-warning" id="registercard">
  <div class="card-header">
    <h5 class="card-title"><i class="fa-solid fa-r"></i>egister</h5>
  </div>
  <div class="card-body">
    <h6 class="card-subtitle mb-2 text-body-secondary">hier kannst du dich registrieren.</h6>

    <?php
    if(!isset($_SESSION['attack']) && !isset($_SESSION['user_id'])):
      if(isset($_SESSION['error_msg'])):
    ?>
    <div class="row my-1">
      <div class="col-auto text-center text-warning">
        <h6 class="card-subtitle">
          <?php echo $_SESSION['error_msg'];?>
        </h6>
      </div>
    </div>
    <?php
    unset($_SESSION['error_msg']);
    endif;
     ?>
    <form action="submit/register-submit.php" method="post">
      <div class="row my-1">
        <div class="col-3">
          <label class="form-label" for="email">Email Adresse:</label>
        </div>
        <div class="col-8">
          <input class="form-control" type="email" id="email" placeholder="deine@email-adresse.family">
        </div>
      </div>
      <div class="row my-1">
        <div class="col-3">
          <label for="surname" class="form-label">Nachname:</label>
        </div>
        <div class="col-8">
          <input class="form-control" id="surname" type="text" placeholder="Dein Nachname steht hier">
        </div>
      </div>
      <div class="row my-1">
        <div class="col-3">
          <label class="form-label" for="prename">Vorname</label>
        </div>
        <div class="col-8">
          <input class="form-control" id="prename" type="text" placeholder="dein Vorname steht nun hier">
        </div>
      </div>
      <div class="row my-1">
        <div class="col-3">
          <label class="form-label" for="password">P455W0RT</label>
        </div>
        <div class="col-8">
          <input class="form-control" id="password" type="password" placeholder="password">
        </div>
      </div>
      <div class="row my-1">
        <div class="col-3">
          <label class="form-label" for="password_confirm">P455W0RT Bestätigung</label>
        </div>
        <div class="col-8">
          <input class="form-control" id="password_confirm" type="password" placeholder="2x password">
        </div>
      </div>
      <input type="hidden" name="login_token" value="<?php echo $_SESSION['login_token']; ?>">
      <div class="row my-1">
        <div class="text-center ">
          <button class="btn btn-success" type="submit">abschicken</button>
        </div>
      </div>
    </form>
  <?php elseif(isset($_SESSION['user_id'])):     ?>
    <div class="my-2">
      <p class="h2 text-success">
        Sie sind bereits eingeloggt!
      </p>
      <p class="text-center">
        <a href="/" rel="hier geht es zum Log-In-Bereich" class="btn btn-outline-success">Zum Backend<i class="fa-solid fa-key"></i></a>
      </p>
    </div>
  </div>

</div>
<?php endif ?>
