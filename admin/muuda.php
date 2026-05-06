<?php
session_start();
include("../config.php");
include("admin_protect.php");

$id = $_GET["id"] ?? null;
if (!$id) {
    header("Location: cars.php");
    exit;
}

// Kui vorm saadeti
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $mark   = $_POST["mark"]   ?? "";
    $model  = $_POST["model"]  ?? "";
    $engine = $_POST["engine"] ?? "";
    $fuel   = $_POST["fuel"]   ?? "";
    $price  = $_POST["price"]  ?? 0;
    $status = $_POST["status"] ?? "Saadaval";

    $stmt = mysqli_prepare($yhendus, "
        UPDATE cars
        SET mark = ?, model = ?, engine = ?, fuel = ?, price = ?, status = ?
        WHERE id = ?
    ");
    mysqli_stmt_bind_param($stmt, "ssssdsi", $mark, $model, $engine, $fuel, $price, $status, $id);
    mysqli_stmt_execute($stmt);

    header("Location: cars.php");
    exit;
}

// Loeme olemasolevad andmed
$stmt = mysqli_prepare($yhendus, "SELECT * FROM cars WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$car = mysqli_fetch_assoc($result);

if (!$car) {
    header("Location: cars.php");
    exit;
}

include("../header.php");
?>

<div class="container mt-4">
    <h2 class="mb-4">Muuda autot</h2>

    <form method="POST" class="card p-4 shadow-sm">

        <div class="mb-3">
            <label class="form-label">Mark</label>
            <input type="text" name="mark" class="form-control"
                   value="<?php echo htmlspecialchars($car['mark']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mudel</label>
            <input type="text" name="model" class="form-control"
                   value="<?php echo htmlspecialchars($car['model']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mootor</label>
            <input type="text" name="engine" class="form-control"
                   value="<?php echo htmlspecialchars($car['engine']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kütus</label>
            <input type="text" name="fuel" class="form-control"
                   value="<?php echo htmlspecialchars($car['fuel']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Hind (€ / päev)</label>
            <input type="number" step="0.01" name="price" class="form-control"
                   value="<?php echo htmlspecialchars($car['price']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Staatus</label>
            <select name="status" class="form-select" required>
                <option value="Saadaval" <?php if ($car['status'] === 'Saadaval') echo 'selected'; ?>>
                    Saadaval
                </option>
                <option value="Mitte saadaval" <?php if ($car['status'] === 'Mitte saadaval') echo 'selected'; ?>>
                    Mitte saadaval
                </option>
            </select>
        </div>

        <button class="btn btn-primary w-100">Salvesta muudatused</button>

    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
