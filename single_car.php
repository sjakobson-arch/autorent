<?php
session_start();
include("config.php");
include("header.php");

if (!isset($_GET["id"])) {
    echo "Auto ID puudub.";
    exit;
}

$car_id = intval($_GET["id"]);

// TURVALINE: võtame auto andmed prepared statementiga
$stmt = mysqli_prepare($yhendus, "SELECT * FROM cars WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $car_id);
mysqli_stmt_execute($stmt);
$car = mysqli_stmt_get_result($stmt)->fetch_assoc();

if (!$car) {
    echo "Autot ei leitud.";
    exit;
}

// TURVALINE: võtame kõik broneeritud perioodid
$stmt2 = mysqli_prepare($yhendus, "
    SELECT start_date, end_date
    FROM reservations
    WHERE car_id = ? AND status != 'cancelled'
");
mysqli_stmt_bind_param($stmt2, "i", $car_id);
mysqli_stmt_execute($stmt2);
$bookings_q = mysqli_stmt_get_result($stmt2);

$disabled = [];
while ($b = mysqli_fetch_assoc($bookings_q)) {
    $disabled[] = [
        "start" => $b["start_date"],
        "end"   => $b["end_date"]
    ];
}

// Kui vorm saadeti
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!isset($_SESSION["user_id"])) {
        echo "<script>alert('Logi sisse, et broneerida.'); window.location='login.php';</script>";
        exit;
    }

    $start = $_POST["start_date"];
    $end = $_POST["end_date"];

    // TURVALINE: kontrollime kattuvaid broneeringuid
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

    mysqli_stmt_bind_param($check, "issssss",
        $car_id,
        $start, $start,
        $end, $end,
        $start, $end
    );

    mysqli_stmt_execute($check);
    $result = mysqli_stmt_get_result($check);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('See auto on valitud perioodil juba broneeritud.');</script>";
    } else {

        $start_dt = new DateTime($start);
        $end_dt = new DateTime($end);
        $days = $start_dt->diff($end_dt)->days;

        if ($days < 1) {
            echo "<script>alert('Lõppkuupäev peab olema hilisem kui alguskuupäev.');</script>";
        } else {

            $total_price = $days * $car["price"];

            // TURVALINE: salvestame broneeringu
            $stmt3 = mysqli_prepare($yhendus, "
                INSERT INTO reservations (user_id, car_id, start_date, end_date, total_price, status)
                VALUES (?, ?, ?, ?, ?, 'pending')
            ");

            mysqli_stmt_bind_param($stmt3, "iissd",
                $_SESSION["user_id"], $car_id, $start, $end, $total_price
            );

            mysqli_stmt_execute($stmt3);

            echo "<script>alert('Broneering loodud!'); window.location='minu_rendid.php';</script>";
            exit;
        }
    }
}
?>

<div class="container mt-5">
    <div class="row">

        <!-- Pilt vasakul (loremflickr nagu index.php-s) -->
        <div class="col-md-6 mb-3">
            <img src="https://loremflickr.com/600/400/<?php echo str_replace(' ', '', $car['mark']); ?>"
                 alt="<?php echo htmlspecialchars($car["mark"] . ' ' . $car["model"]); ?>"
                 class="img-fluid rounded shadow-sm">
        </div>

        <!-- Info + kalender paremal -->
        <div class="col-md-6">
            <h2><?php echo htmlspecialchars($car["mark"] . " " . $car["model"]); ?></h2>

            <p><strong>Mootor:</strong> <?php echo htmlspecialchars($car["engine"]); ?></p>
            <p><strong>Kütus:</strong> <?php echo htmlspecialchars($car["fuel"]); ?></p>
            <p><strong>Hind päevas:</strong> <?php echo htmlspecialchars($car["price"]); ?> €</p>

            <!-- Auto staatus -->
            <p><strong>Staatus:</strong> <?php echo htmlspecialchars($car["status"]); ?></p>

            <hr>

            <h4>Broneeri see auto</h4>

            <form method="POST">

                <label>Alguskuupäev:</label>
                <input type="date" id="start" name="start_date" class="form-control" required>

                <label class="mt-2">Lõppkuupäev:</label>
                <input type="date" id="end" name="end_date" class="form-control" required>

                <button class="btn btn-primary mt-3 w-100">Broneeri</button>
            </form>
        </div>

    </div>
</div>

<script>
let disabledRanges = <?php echo json_encode($disabled); ?>;

function isDisabled(date) {
    if (!date) return false;
    let d = new Date(date);
    for (let r of disabledRanges) {
        let start = new Date(r.start);
        let end = new Date(r.end);
        if (d >= start && d <= end) return true;
    }
    return false;
}

document.getElementById("start").addEventListener("input", function() {
    if (isDisabled(this.value)) {
        alert("Sellel kuupäeval on auto juba broneeritud.");
        this.value = "";
    }
});

document.getElementById("end").addEventListener("input", function() {
    if (isDisabled(this.value)) {
        alert("Sellel kuupäeval on auto juba broneeritud.");
        this.value = "";
    }
});
</script>

</body>
</html>
