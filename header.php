<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Autorent</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <div class="container">

        <a class="navbar-brand" href="/autorent/index.php">Autorent</a>

        <div class="collapse navbar-collapse">

            <!-- Vasak pool -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <?php if (isset($_SESSION["user_id"]) && $_SESSION["role"] !== "admin"): ?>
                  <li class="nav-item">
                    <a class="nav-link" href="/autorent/minu_rendid.php">Minu rendid</a>
                  </li>
                <?php endif; ?>


                <?php if (isset($_SESSION["role"]) && $_SESSION["role"] === "admin"): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/autorent/admin/index.php">Admin</a>
                    </li>
                <?php endif; ?>

            </ul>

            <!-- OTSING (HELE, AUTOCOMPLETE + PILTIDEGA) -->
            <form class="d-flex position-relative" method="GET" action="/autorent/index.php" autocomplete="off">
                <input id="searchInput"
                       class="form-control"
                       type="search"
                       name="otsi"
                       placeholder="Otsi autot..."
                       style="background-color: white; color: black;">

                <div id="searchResults"
                     class="list-group position-absolute w-100"
                     style="top: 40px; z-index: 2000;"></div>
            </form>

            <!-- Parem pool -->
            <ul class="navbar-nav ms-3">

                <?php if (isset($_SESSION["user_id"])): ?>
                    <li class="nav-item">
                        <span class="nav-link">Tere, <?php echo $_SESSION["first_name"]; ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-danger" href="/autorent/logout.php">Logi välja</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="btn btn-success" href="/autorent/login.php">Logi sisse</a>
                    </li>
                <?php endif; ?>

            </ul>

        </div>
    </div>
</nav>

<script>
// AUTOCOMPLETE
document.getElementById("searchInput").addEventListener("input", function() {
    let query = this.value;

    if (query.length < 1) {
        document.getElementById("searchResults").innerHTML = "";
        return;
    }

    fetch("/autorent/search_autocomplete.php?term=" + query)
        .then(response => response.json())
        .then(data => {
            let results = document.getElementById("searchResults");
            results.innerHTML = "";

            data.forEach(item => {
                let a = document.createElement("a");
                a.classList.add("list-group-item", "list-group-item-action", "d-flex", "align-items-center");
                a.style.cursor = "pointer";

                // Pilt
                let img = document.createElement("img");
                img.src = item.image;
                img.style.width = "50px";
                img.style.height = "40px";
                img.style.objectFit = "cover";
                img.classList.add("me-2");

                // Tekst
                let span = document.createElement("span");
                span.textContent = item.name;

                a.appendChild(img);
                a.appendChild(span);

                a.onclick = () => {
                    document.getElementById("searchInput").value = item.name;
                    results.innerHTML = "";
                };

                results.appendChild(a);
            });
        });
});
</script>

