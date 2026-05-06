<?php
session_start();
include("config.php");
include("header.php");

if (!isset($_GET["id"])) {
    echo "<div class='container mt-4'><div class='alert alert-danger'>Auto ID puudub.</div></div>";
    exit;
}

$id = intval($_GET["id"]);

$stmt = mysqli_prepare($yhendus, "SELECT * FROM cars WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$car = mysqli_stmt_get_result($stmt)->fetch_assoc();

if (!$car) {
    echo "<div class='container mt-4'><div class='alert alert-danger'>Autot ei leitud.</div></div>";
    exit;
}
?>

<div class="container mt-4">

    <div class="row">
        <div class="col-md-6 mb-4">

            <img src="https://loremflickr.com/600/400/<?php echo str_replace(' ', '', $car['mark']); ?>"
                 class="img-fluid rounded shadow-sm"
                 alt="<?php echo htmlspecialchars($car['mark'] . ' ' . $car['model']); ?>">

        </div>

        <div class="col-md-6">

            <h2><?php echo htmlspecialchars($car["mark"] . " " . $car["model"]); ?></h2>

            <p class="mt-3">
                Mootor: <?php echo htmlspecialchars($car["engine"]); ?><br>
                Kütus: <?php echo htmlspecialchars($car["fuel"]); ?><br>
                Hind: <?php echo htmlspecialchars($car["price"]); ?> € / päev<br>
                Staatus: <?php echo htmlspecialchars($car["status"]); ?>
            </p>

            <?php if (isset($_SESSION["user_id"])): ?>

                <form method="POST" action="rendi.php" class="mt-4">

                    <input type="hidden" name="car_id" value="<?php echo $car['id']; ?>">

                    <div class="mb-3">
                        <label class="form-label">Algus kuupäev</label>
                        <input type="date" name="start_date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Lõpp kuupäev</label>
                        <input type="date" name="end_date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Koguhind (€)</label>
                        <input type="number" name="total_price" class="form-control" required>
                    </div>

                    <button class="btn btn-primary w-100">Rendi see auto</button>

                </form>

            <?php else: ?>

                <div class="alert alert-info mt-4">
                    Broneerimiseks palun <a href="login.php">logi sisse</a>.
                </div>

            <?php endif; ?>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
