<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("config.php");

$vead = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $password2 = $_POST["password2"];

    // Kontroll: kas paroolid kattuvad
    if ($password !== $password2) {
        $vead = "Paroolid ei kattu.";
    } else {
        // Kontroll: kas email on juba kasutusel
        $paring = "SELECT * FROM users WHERE email='$email'";
        $valjund = mysqli_query($yhendus, $paring);

        if (mysqli_num_rows($valjund) > 0) {
            $vead = "Selline email on juba registreeritud.";
        } else {
            // Loo uus kasutaja
            $hashed = password_hash($password, PASSWORD_DEFAULT);

            $paring = "INSERT INTO users (username, email, password, role)
                       VALUES ('$username', '$email', '$hashed', 'client')";
            mysqli_query($yhendus, $paring);

            header("Location: login.php");
            exit();
        }
    }
}
?>

<?php include("header.php"); ?>

<div class="container mt-5" style="max-width: 500px;">
    <h2 class="mb-4">Registreeru</h2>

    <?php if (!empty($vead)): ?>
        <div class="alert alert-danger"><?php echo $vead; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Kasutajanimi</label>
            <input type="text" name="username" class="form-control" required>
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
            <input type="password" name="password2" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success w-100">Registreeru</button>
    </form>
</div>

</body>
</html>
