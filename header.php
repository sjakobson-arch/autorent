<!doctype html>
<html lang="et">
<head>
    <meta charset="utf-8">
    <title>Autorent</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container">

        <a class="navbar-brand" href="index.php">Autorent</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">

            <ul class="navbar-nav me-auto">

                <li class="nav-item">
                    <a class="nav-link" href="index.php">Avaleht</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="availability.php">Saadavus</a>
                </li>

                <?php if (isset($_SESSION["user_id"]) && ($_SESSION["role"] ?? "") !== "admin"): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="minu_rendid.php">Minu rendid</a>
                    </li>
                <?php endif; ?>

                <?php if (isset($_SESSION["role"]) && $_SESSION["role"] === "admin"): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="admin/index.php">Admin</a>
                    </li>
                <?php endif; ?>

            </ul>

            <ul class="navbar-nav ms-auto">

                <?php if (isset($_SESSION["user_id"])): ?>
                    <li class="nav-item">
                        <span class="navbar-text me-2">
                            Tere, <?php echo htmlspecialchars($_SESSION["first_name"] ?? "kasutaja"); ?>
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-danger btn-sm" href="logout.php">Logi välja</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item me-2">
                        <a class="btn btn-outline-primary btn-sm" href="login.php">Logi sisse</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary btn-sm" href="registreeru.php">Registreeru</a>
                    </li>
                <?php endif; ?>

            </ul>

        </div>
    </div>
</nav>
