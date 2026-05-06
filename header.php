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

        <a class="navbar-brand" href="/index.php">Autorent</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">

            <ul class="navbar-nav me-auto">

                <?php if (isset($_SESSION["user_id"]) && ($_SESSION["role"] ?? "") !== "admin"): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/minu_rendid.php">Minu rendid</a>
                    </li>
                <?php endif; ?>

                <?php if (isset($_SESSION["role"]) && $_SESSION["role"] === "admin"): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/index.php">Admin</a>
                    </li>
                <?php endif; ?>

            </ul>

            <!-- Otsinguriba -->
            <form class="d-flex position-relative me-3" method="GET" action="/index.php" autocomplete="off">
                <input id="searchInput" class="form-control" type="search" name="otsi" placeholder="Otsi...">
                <div id="searchResults" class="list-group position-absolute w-100" style="z-index: 1000;"></div>
            </form>

            <ul class="navbar-nav ms-auto">

                <?php if (isset($_SESSION["user_id"])): ?>
                    <li class="nav-item">
                        <span class="navbar-text me-2">
                            Tere, <?php echo htmlspecialchars($_SESSION["first_name"] ?? "kasutaja"); ?>
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-danger btn-sm" href="/logout.php">Logi välja</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item me-2">
                        <a class="btn btn-outline-primary btn-sm" href="/login.php">Logi sisse</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary btn-sm" href="/registreeru.php">Registreeru</a>
                    </li>
                <?php endif; ?>

            </ul>

        </div>
    </div>
</nav>

<script>
document.getElementById("searchInput").addEventListener("input", function() {
    let query = this.value;

    if (query.length < 1) {
        document.getElementById("searchResults").innerHTML = "";
        return;
    }

    fetch("/search_autocomplete.php?term=" + query)
        .then(response => response.json())
        .then(data => {
            let results = document.getElementById("searchResults");
            results.innerHTML = "";

            data.forEach(item => {
                let div = document.createElement("a");
                div.classList.add("list-group-item", "list-group-item-action");
                div.textContent = item;
                div.onclick = () => {
                    document.getElementById("searchInput").value = item;
                    results.innerHTML = "";
                };
                results.appendChild(div);
            });
        });
});
</script>
