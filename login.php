<?php
session_start();
session_regenerate_id(true);
include("config.php");



$vead = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $paring = mysqli_prepare($yhendus, "SELECT * FROM users WHERE email = ?");
    mysqli_stmt_bind_param($paring, "s", $email);
    mysqli_stmt_execute($paring);
    $valjund = mysqli_stmt_get_result($paring);
    $kasutaja = mysqli_fetch_assoc($valjund);

    if ($kasutaja) {

        if (password_verify($password, $kasutaja["password_hash"])) {

            $_SESSION["user_id"] = $kasutaja["id"];
            $_SESSION["role"] = $kasutaja["role"];
            $_SESSION["first_name"] = $kasutaja["first_name"];
            $_SESSION["last_name"] = $kasutaja["last_name"];

            session_regenerate_id(true);

            header("Location: index.php");
            exit;

        } else {
            $vead = "Vale parool.";
        }

    } else {
        $vead = "Sellise emailiga kasutajat ei leitud.";
    }
}

include("header.php");
?>

<div class="container" style="max-width: 450px;">
    <div class="card shadow-sm p-4">

        <h3 class="mb-3 text-center">Logi sisse</h3>

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

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
