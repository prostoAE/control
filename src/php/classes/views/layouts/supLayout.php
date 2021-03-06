<!doctype html>
<html lang="ru">
<head>
  <?= $this->getMeta(); ?>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-grid.css">
  <link rel="stylesheet" href="css/bootstrap-datepicker.min.css">
  <!-- Font Awesome-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/style.min.css">
</head>
<body>

<div class="loader-bg">
  <div class="loader"></div>
</div>

<div class="container-fluid">
  <div class="row">
    <header class="header">
      <p class="header__caption">Hello:
        <span>
          <?php
          $ldap = new \php\classes\models\ldap();
          $userName = $ldap->getUserName($_SESSION['ukr'], $_SESSION['psw']);
          echo $userName;
          ?>
        </span>
      </p>
      <!-- MENU -->
      <div class="toogle"></div>
      <nav class="menu">
        <ul>
          <li><a href="main" data-text="Главная">Главная</a></li>
          <li><a href="sup" data-text="SUP">SUP</a></li>
          <?php if(\php\classes\models\User::getUserAccess() == 1): ?>
          <li><a href="setting" data-text="Настройки">Настройки</a></li>
          <?php endif; ?>
          <li><a href="" data-text="Выход" id="logOut">Выход</a></li>
        </ul>
      </nav>
    </header>
  </div>
</div>

<?= $content; ?>

<footer class="footer">
  <p><span>&copy;</span>Auchan 2019</p>
</footer>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-datepicker.min.js"></script>
<!-- Custom JS -->
<script src="js/main.js"></script>
<script src="js/column-fix.js"></script>
</body>
</html>