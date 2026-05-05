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

    // Kontrollime kattuvaid broneeringuid
    $check = mysqli_prepare($yhendus, "
        SELECT id FROM reservations
        WHERE car_id = ?
        AND status != 'cancelled'
        AND (
            (start_date <= ? AND end_date >= ?) OR
            (start_date <= ? AND end_date >= ?) OR
            (? <= start_date AND ? >= end_date)
        )
    ");

    mysqli_stmt_bind_param($check, "isssssss",
        $car_id, $start, $start, $end, $end, $start, $end
    );

    mysqli_stmt_execute($check);
    $result = mysqli_stmt_get_result($check);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('See auto on valitud perioodil juba broneeritud.');</script>";
    } else {

        // Arvutame hinna
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
}
?>

<div class="container mt-5">
    <h2><?php echo $car["mark"] . " " . $car["model"]; ?></h2>

    <img src="<?php echo $car["image"]; ?>" class="img-fluid mb-3" style="max-width: 400px;">

    <p><strong>Mootor:</strong> <?php echo $car["engine"]; ?></p>
    <p><strong>Kütus:</strong> <?php echo $car["fuel"]; ?></p>
    <p><strong>Hind päevas:</strong> <?php echo $car["price"]; ?> €</p>

    <hr>

    <h4>Broneeri see auto</h4>

    <form method="POST">

        <label>Alguskuupäev:</label>
        <input type="date" name="start_date" class="form-control" required>

        <label class="mt-2">Lõppkuupäev:</label>
        <input type="date" name="end_date" class="form-control" required>

        <button class="btn btn-primary mt-3">Broneeri</button>
    </form>

    <a href="availability.php?car_id=<?php echo $car_id; ?>" class="btn btn-outline-secondary mt-3">
        Vaata saadavust kalendris
    </a>
</div>

</body>
</html>
