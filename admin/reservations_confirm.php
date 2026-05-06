<?php
session_start();
include("../config.php");
include("../admin_protect.php");
include("../header.php");

if (!isset($_GET["id"])) {
    echo "Broneeringu ID puudub.";
    exit;
}

$id = intval($_GET["id"]);

// Kui admin kinnitab
if (isset($_POST["confirm"])) {

    $stmt = mysqli_prepare($yhendus, "UPDATE reservations SET status='confirmed' WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    header("Location: reservations.php");
    exit;
}
?>

<div class="container mt-4">
    <div class="card shadow-sm p-4">
        <h3 class="mb-3">Kinnita broneering</h3>
        <p>Kas soovid selle broneeringu kinnitada?</p>

        <form method="POST" class="d-flex gap-2">
            <button name="confirm" class="btn btn-success">Kinnita</button>
            <a href="reservations.php" class="btn btn-secondary">Tühista</a>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
