<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<?php
session_start();
include("../config.php");
include("admin_protect.php");

$id = $_GET["id"] ?? null;

if ($id) {
    $stmt = mysqli_prepare($yhendus, "DELETE FROM cars WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
}

header("Location: cars.php");
exit;


?>

<div class="container mt-4">
    <div class="card shadow-sm p-4">
        <h3 class="mb-3">Kustuta auto</h3>
        <p>Kas oled kindel, et soovid selle auto kustutada? Seda toimingut ei saa tagasi võtta.</p>

        <form method="POST" class="d-flex gap-2">
            <button name="confirm" class="btn btn-danger">Kustuta</button>
            <a href="cars.php" class="btn btn-secondary">Tühista</a>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
