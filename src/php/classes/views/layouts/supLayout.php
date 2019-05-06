<!doctype html>
<html lang="ru">
<head>
  <?= $this->getMeta(); ?>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- Font Awesome-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/style.min.css">
</head>
<body>

<div class="container-fluid">
  <div class="row">
    <header class="header">
      <!-- MENU -->
      <div class="toogle"></div>
      <nav class="menu">
        <ul>
          <li><a href="main" data-text="Главная">Главная</a></li>
          <li><a href="sup" data-text="SUP">SUP</a></li>
          <li><a href="" data-text="Настройки">Настройки</a></li>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!-- Custom JS -->
<script src="js/main.js"></script>
</body>
</html>