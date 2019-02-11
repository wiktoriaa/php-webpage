<!DOCTYPE html>
<html lang="pl">
<head>
  <title>BUTY</title>

  <meta charset="UTF-8" />
  <link rel="stylesheet" href="./jquery-ui/jquery-ui.min.css">
  <link rel="Stylesheet" href="assets/css/styleee.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="./jquery-ui/jquery-ui.min.css">
  <script src="./jquery-ui/external/jquery/jquery.js"></script>
  <script src="./jquery-ui/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">BUTY</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item <?php if ($_GET['page'] == home) echo 'active'; ?>">
        <a class="nav-link" href="?page=home">Strona główna</a>
      </li>
      <li class="nav-item <?php if ($_GET['page'] == quiz) echo 'active'; ?>">
        <a class="nav-link" href="?page=quiz">Quiz</a>
      </li>
      <li class="nav-item <?php if ($_GET['page'] == gallery) echo 'active'; ?>">
        <a class="nav-link" href="?page=gallery">Zdjęcia</a>
      </li>   
    </ul>

    <?php require 'access.php'; ?>
    
    <?php if (!$logged_in) {?>
      <a href="?page=login"><input type="button" value="Zaloguj się" class="btn btn-secondary" /></a>
    <?php } 
    else { ?>
      <a href="?page=panel"><input type="button" value="Moje obrazki" class="btn btn-secondary" style="margin-right: 10px;" /></a>
      <a href="actions/logout.php"><input type="button" value="Wyloguj" class="btn btn-secondary" style="margin-right: 10px;" /></a>
    <?php } ?>
  </div>
</nav>