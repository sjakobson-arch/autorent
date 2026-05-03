<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("config.php");

$vead = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    // Kas kasutaja on olemas?
    $paring = "SELECT * FROM users WHERE email='$email'";
    $valjund = mysqli_query($yhendus, $paring);
    $kasutaja = mysqli_fetch_assoc($valjund);

    if ($kasutaja) {

        // Kontrollime parooli password_hash vastu
        if (password_verify($password, $kasutaja["password_hash"])) {

            // Loome sessiooni
            $_SESSION["user_id"] = $kasutaja["id"];
            $_SESSION["role"] = $kasutaja["role"];
            $_SESSION["first_name"] = $kasutaja["first_name"];
            $_SESSION["last_name"] = $kasutaja["last_name"];

            header("Location: index.php");
            exit();

        } else {
            $vead = "Vale parool.";
        }

    } else {
        $vead = "Sellise emailiga kasutajat ei leitud.";
    }
}
?>

<?php include("header.php"); ?>

<div class="container mt-5" style="max-width: 450px;">
    <h2 class="mb-4">Logi sisse</h2>

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

        <button type="submit" class="btn btn-primary w-100">Logi sisse</button>
    </form>
</div>

</body>
</html>
