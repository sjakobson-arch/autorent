<?php
session_start();
include("../config.php");

// Kui kasutaja on juba admin, suuname dashboardile
if (isset($_SESSION["role"]) && $_SESSION["role"] === "admin") {
    header("Location: index.php");
    exit;
}

$vead = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    // Otsime kasutajat emaili järgi
    $stmt = mysqli_prepare($yhendus, "SELECT * FROM users WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $valjund = mysqli_stmt_get_result($stmt);
    $kasutaja = mysqli_fetch_assoc($valjund);

    if ($kasutaja) {

        if (password_verify($password, $kasutaja["password_hash"])) {

            if ($kasutaja["role"] !== "admin") {
                $vead = "Sul puudub ligipääs admini alale.";
            } else {

                $_SESSION["user_id"] = $kasutaja["id"];
                $_SESSION["role"] = $kasutaja["role"];
                $_SESSION["first_name"] = $kasutaja["first_name"];
                $_SESSION["last_name"] = $kasutaja["last_name"];

                header("Location: index.php");
                exit;
            }

        } else {
            $vead = "Vale parool.";
        }
    } else {
        $vead = "Sellise emailiga kasutajat ei leitud.";
    }
}
?>

<!doctype html>
<html lang="et">
<head>
    <meta charset="utf-8">
    <title>Admini sisselogimine</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width: 450px;">
    <div class="card shadow-sm p-4">

        <h3 class="mb-3 text-center">Admini sisselogimine</h3>

        <?php if (!empty($vead)): ?>
            <div class="alert alert-danger"><?php echo $vead; ?></div>
        <?php endif; ?>

        <form method="POST">

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Parool</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button class="btn btn-primary w-100">Logi sisse</button>

        </form>

        <a href="../index.php" class="btn btn-link mt-3 w-100">Tagasi avalehele</a>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
