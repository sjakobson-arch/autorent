<?php
session_start();
include("../config.php");
include("../admin_protect.php");
include("../header.php");

if (!isset($_GET["id"])) {
    echo "Auto ID puudub.";
    exit;
}

$car_id = intval($_GET["id"]);

// Võtame auto andmed
$stmt = mysqli_prepare($yhendus, "SELECT * FROM cars WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $car_id);
mysqli_stmt_execute($stmt);
$car = mysqli_stmt_get_result($stmt)->fetch_assoc();

if (!$car) {
    echo "Autot ei leitud.";
    exit;
}

// Kui vorm saadeti
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $mark = $_POST["mark"];
    $model = $_POST["model"];
    $engine = $_POST["engine"];
    $fuel = $_POST["fuel"];
    $price = $_POST["price"];
    $status = $_POST["status"];

    $stmt2 = mysqli_prepare($yhendus, "
        UPDATE cars SET mark=?, model=?, engine=?, fuel=?, price=?, status=?
        WHERE id=?
    ");
    mysqli_stmt_bind_param($stmt2, "ssssdsi",
        $mark, $model, $engine, $fuel, $price, $status, $car_id
    );
    mysqli_stmt_execute($stmt2);

    header("Location: cars.php");
    exit;
}
?>

<div class="container mt-4">
    <h1 class="mb-4">Muuda autot</h1>

    <form method="POST" class="card p-4 shadow-sm">

        <div class="mb-3">
            <label class="form-label">Mark</label>
            <input type="text" name="mark" class="form-control" value="<?php echo htmlspecialchars($car['mark']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mudel</label>
            <input type="text" name="model" class="form-control" value="<?php echo htmlspecialchars($car['model']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mootor</label>
            <input type="text" name="engine" class="form-control" value="<?php echo htmlspecialchars($car['engine']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kütus</label>
            <input type="text" name="fuel" class="form-control" value="<?php echo htmlspecialchars($car['fuel']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Hind (€ / päev)</label>
            <input type="number" name="price" class="form-control" step="0.01"
                   value="<?php echo htmlspecialchars($car['price']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Staatus</label>
            <select name="status" class="form-select" required>
                <option value="available" <?php if ($car["status"] === "available") echo "selected"; ?>>Saadaval</option>
                <option value="unavailable" <?php if ($car["status"] === "unavailable") echo "selected"; ?>>Mitte saadaval</option>
            </select>
        </div>

        <button class="btn btn-primary w-100">Salvesta muudatused</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
