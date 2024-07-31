<?php
if(!isset($_SESSION['attack']) && !isset($_SESSION['user_id'])):
?>

<div class="card border-primary" id="logincard">
  <div class="card-header">
    <h5 class="card-title"><i class="fa-solid fa-l"></i>ogin</h5>
  </div>
  <div class="card-body">
    <h6 class="card-subtitle mb-2 text-body-secondary">log yourself in</h6>
    <?php
    if(isset($_SESSION['message'])):
     ?>
     <h6 class="card-subtitle mb-2 text-body-secondary"><?php echo isset($_SESSION['message']) ? $_SESSION['message'] : "";; ?></h6>
      <form>
        <div class="row my-1">
          <div class="col-auto">
            <label class="form-label" for="email">
              <i class="fa-solid fa-at"></i>
            </label>
          </div>
          <div class="col-auto">
            <input class="form-control" id="email" type="email" placeholder="your@email-address">
          </div>
        </div>
        <div class="row">
          <div class="col-auto mb-1">
            <label class="form-label" for="passwd">
              <i class="fa-solid fa-key"></i>
            </label>
          </div>
          <div class="col-auto">
            <input class="form-control" id="passwd" type="password" placeholder="your password ?!#">
          </div>
        </div>
          <input type="hidden" name="login_token" value="<?php echo $_SESSION['login_token']; ?>">
        <div class="row my-1">
          <div class="text-center ">
            <button class="btn btn-success">abschicken</button>
          </div>
          <h2 class="text-alert">
            <?php echo isset($_SESSION['error_msg']) ? $_SESSION['error_msg'] : ""; ?>
          </h2>
        </div>
      </form>
      <?php
      elseif (isset($_SESSION['attack'])):
       ?>
       <div class="my-2">
         <p class="h2 text-danger">
           <?php
           echo $_SESSION['error_msg'];
            ?>
          </p>
          <p class="text-center">
            <a class="btn btn-outline-danger" href="/" rel="zurück zur Startseite">Startseite<i class="fa fa-solid fa-home"></i></a></p>
        </div>
        <?php
        elseif(isset($_SESSION['user_id']) && isset($_SESSION['username'])):
      ?>
      <div class="my-2">
        <p class="h2 text-success">
          Sie sind bereits eingeloggt!
        </p>
        <p class="text-center">
          <a href="/backend/" rel="hier geht es zum Log-In-Bereich" class="btn btn-outline-success">Zum Backend<i class="fa-solid fa-key"></i></a>
        </p>
      </div>
      <?php
    endif;
      ?>
    </div>

</div>
<?php endif; ?>
