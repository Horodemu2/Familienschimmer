<main class="justify-content-center">
  <div class="container-fluid text-center">
    <div class="row">
      <div class="col">
        <h1 class="">
          Wir sind <i class="fa-solid fa-g"></i>ürke <i class="fa-solid fa-k"></i>ienzler <i class="fa-solid fa-s"></i>chimmer</a>
        </h1>
      </div>
    </div>
    <div class="row">
      <div id="header-main-page" class="col">
        <h2>
          eine Fotoseite für Bilder von Familienfeiern und lorem ipsum
        </h2>
      </div>
    </div>
  </div>
  <?php if(!isset($_SESSION['user_id'])): ?>
  <div class="container-fluid position-absolute top-50 start-0">
    <div class="row">

      <div id="login-card" class="offset-lg-8 col-lg-3">

        <?php  include '/kunden/homepages/33/d1016026951/htdocs/login/login-card.php'; ?>
      </div>
    </div>
  </div>
  <?php
  elseif(isset($_SESSION['user_id'])):
   ?>
   <div class="container-fluid">
     <div class="row">
       <div class="offset-7 col-5">
         <h2><?php echo $_SESSION['user_id'] . '&nbsp;' . $_SESSION['username'] ?>
      </div>
     </div>
   </div>
 <?php endif; ?>
</main>
