<?php
session_start();
include("../config.php");
include("admin_protect.php");

// Kui vorm saadeti
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $mark   = $_POST["mark"]   ?? "";
    $model  = $_POST["model"]  ?? "";
    $engine = $_POST["engine"] ?? "";
    $fuel   = $_POST["fuel"]   ?? "";
    $price  = $_POST["price"]  ?? 0;

    // NB! Kasutame samu väärtusi, mida andmebaas ootab (nt ENUM 'Saadaval','Mitte saadaval')
    $status = $_POST["status"] ?? "Saadaval";

    $stmt = mysqli_prepare($yhendus, "
        INSERT INTO cars (mark, model, engine, fuel, price, status)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    mysqli_stmt_bind_param($stmt, "ssssds", $mark, $model, $engine, $fuel, $price, $status);
    mysqli_stmt_execute($stmt);

    header("Location: cars.php");
    exit;
}

include("../header.php");
?>

<div class="container mt-4">
    <h2 class="mb-4">Lisa uus auto</h2>

    <form method="POST" class="card p-4 shadow-sm">

        <div class="mb-3">
            <label class="form-label">Mark</label>
            <input type="text" name="mark" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mudel</label>
            <input type="text" name="model" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mootor</label>
            <input type="text" name="engine" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kütus</label>
            <input type="text" name="fuel" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Hind (€ / päev)</label>
            <input type="number" step="0.01" name="price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Staatus</label>
            <select name="status" class="form-select" required>
                <option value="Saadaval">Saadaval</option>
                <option value="Mitte saadaval">Mitte saadaval</option>
            </select>
        </div>

        <button class="btn btn-primary w-100">Lisa auto</button>

    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
