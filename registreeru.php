<?php
session_start();
include("config.php");

$vead = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $first = trim($_POST["first_name"]);
    $last = trim($_POST["last_name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm = $_POST["confirm_password"];

    if ($password !== $confirm) {
        $vead = "Paroolid ei ühti.";
    } else {

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = mysqli_prepare($yhendus, "
            INSERT INTO users (first_name, last_name, email, password_hash, role)
            VALUES (?, ?, ?, ?, 'user')
        ");
        mysqli_stmt_bind_param($stmt, "ssss", $first, $last, $email, $hash);
        mysqli_stmt_execute($stmt);

        header("Location: login.php");
        exit;
    }
}

include("header.php");
?>

<div class="container" style="max-width: 500px;">
    <div class="card shadow-sm p-4">

        <h3 class="mb-3 text-center">Registreeru</h3>

        <?php if (!empty($vead)): ?>
            <div class="alert alert-danger"><?php echo $vead; ?></div>
        <?php endif; ?>

        <form method="POST">

            <div class="mb-3">
                <label class="form-label">Eesnimi</label>
                <input type="text" name="first_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Perekonnanimi</label>
                <input type="text" name="last_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Parool</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Korda parooli</label>
                <input type="password" name="confirm_password" class="form-control" required>
            </div>

            <button class="btn btn-primary w-100">Registreeru</button>

        </form>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
