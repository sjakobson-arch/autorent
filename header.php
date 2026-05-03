<?php session_start(); ?>
<!doctype html>
<html lang="et">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Autorent</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>

<nav class="navbar navbar-expand-lg bg-body-tertiary mb-4">
  <div class="container">
    <a class="navbar-brand" href="index.php">Autorent</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

<ul class="navbar-nav ms-auto mb-2 mb-lg-0">

    <?php if (!isset($_SESSION["user_id"])): ?>
        <li class="nav-item">
            <a class="nav-link" href="login.php">Logi sisse</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="registreeru.php">Registreeru</a>
        </li>

    <?php else: ?>
        <li class="nav-item">
            <a class="nav-link" href="minu_rendid.php">Minu rendid</a>
        </li>

        <li class="nav-item">
            <span class="nav-link disabled">
                Tere, <?php echo $_SESSION["username"]; ?>
            </span>
        </li>

        <li class="nav-item">
            <a class="btn btn-danger ms-2" href="logout.php">Logi välja</a>
        </li>
    <?php endif; ?>

</ul>

      <form class="d-flex ms-3" role="search" method="get" action="index.php">
        <input class="form-control me-2" type="search" placeholder="Search" name="otsi">
        <button class="btn btn-outline-success" type="submit">Otsi</button>
      </form>

    </div>
  </div>
</nav>
