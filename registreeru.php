<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once "config.php";



$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $password2 = trim($_POST["password2"]);

    // Kontrollid
    if (empty($email)) $errors[] = "Email on kohustuslik.";
    if (empty($password)) $errors[] = "Parool on kohustuslik.";
    if ($password !== $password2) $errors[] = "Paroolid ei ühti.";

    if (empty($errors)) {

        // Kontrollime, kas email juba olemas
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $errors[] = "Selline email on juba registreeritud.";
        } else {

            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $role = "customer";

            // Kuna first_name, last_name ja phone pole enam kasutusel, paneme need tühjaks
            $empty = "";

            $stmt = $conn->prepare("
                INSERT INTO users (role, first_name, last_name, email, phone, password_hash)
                VALUES (?, ?, ?, ?, ?, ?)
            ");

            $stmt->bind_param("ssssss", $role, $empty, $empty, $email, $empty, $hashed);

            if ($stmt->execute()) {
                header("Location: login.php?success=1");
                exit;
            } else {
                $errors[] = "Registreerimine ebaõnnestus. Proovi uuesti.";
            }
        }
    }
}
?>

<?php include "header.php"; ?>

<div class="container mt-5">
    <h2>Registreeru</h2>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $e): ?>
                <div><?php echo $e; ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST">

        <div class="mb-3">
            <label class="form-label">Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Parool:</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Korda parooli:</label>
            <input type="password" name="password2" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Registreeru</button>
    </form>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
