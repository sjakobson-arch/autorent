<?php
session_start();
include("config.php");
include("header.php");

if (!isset($_GET["id"])) {
    echo "Auto ID puudub.";
    exit;
}

$car_id = intval($_GET["id"]);

// Võtame auto andmed
$paring = mysqli_query($yhendus, "SELECT * FROM cars WHERE id = $car_id");
$car = mysqli_fetch_assoc($paring);

if (!$car) {
    echo "Autot ei leitud.";
    exit;
}

// Kui vorm saadeti
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!isset($_SESSION["user_id"])) {
        echo "<script>alert('Logi sisse, et broneerida.'); window.location='login.php';</script>";
        exit;
    }

    $start = $_POST["start_date"];
    $end = $_POST["end_date"];

    // Arvutame päevad
    $start_dt = new DateTime($start);
    $end_dt = new DateTime($end);
    $days = $start_dt->diff($end_dt)->days;

    if ($days < 1) {
        echo "<script>alert('Lõppkuupäev peab olema hilisem kui alguskuupäev.');</script>";
    } else {

        $total_price = $days * $car["price"];

        // Salvestame broneeringu
        $stmt = mysqli_prepare($yhendus, "
            INSERT INTO reservations (user_id, car_id, start_date, end_date, total_price, status)
            VALUES (?, ?, ?, ?, ?, 'pending')
        ");

        mysqli_stmt_bind_param($stmt, "iissd",
            $_SESSION["user_id"], $car_id, $start, $end, $total_price
        );

        mysqli_stmt_execute($stmt);

        echo "<script>alert('Broneering loodud!'); window.location='my_rentals.php';</script>";
        exit;
    }
}
?>

<div class="container mt-5">
    <div class="row">

        <!-- Pilt vasakul -->
        <div class="col-md-6 mb-3">
            <img src="<?php echo htmlspecialchars($car["image"]); ?>"
                 alt="<?php echo htmlspecialchars($car["mark"] . ' ' . $car["model"]); ?>"
                 class="img-fluid rounded shadow-sm"
                 style="max-width: 100%; height: auto;">
        </div>

        <!-- Info + kalender paremal -->
        <div class="col-md-6">
            <h2><?php echo htmlspecialchars($car["mark"] . " " . $car["model"]); ?></h2>

            <p><strong>Mootor:</strong> <?php echo htmlspecialchars($car["engine"]); ?></p>
            <p><strong>Kütus:</strong> <?php echo htmlspecialchars($car["fuel"]); ?></p>
            <p><strong>Hind päevas:</strong> <?php echo htmlspecialchars($car["price"]); ?> €</p>

            <hr>

            <h4>Broneeri see auto</h4>

            <form method="POST">

                <label>Alguskuupäev:</label>
                <input type="date" name="start_date" class="form-control" required>

                <label class="mt-2">Lõppkuupäev:</label>
                <input type="date" name="end_date" class="form-control" required>

                <button class="btn btn-primary mt-3 w-100">Broneeri</button>
            </form>
        </div>

    </div>
</div>

</body>
</html>
