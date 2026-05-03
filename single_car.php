<?php
session_start();
include("config.php");

$vead = "";

// Kontrollime, kas ID on olemas
if (!isset($_GET["id"])) {
    header("Location: index.php");
    exit();
}

$car_id = intval($_GET["id"]);

// Võtame auto andmed
$paring = "SELECT * FROM cars WHERE id=$car_id";
$valjund = mysqli_query($yhendus, $paring);
$auto = mysqli_fetch_assoc($valjund);

if (!$auto) {
    echo "<h2>Autot ei leitud.</h2>";
    exit();
}

// Kui kasutaja rendib
if (isset($_POST["rent"])) {

    if (!isset($_SESSION["user_id"])) {
        header("Location: login.php");
        exit();
    }

    $user_id = $_SESSION["user_id"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];

    // Kontroll: kas kuupäevad kattuvad mõne olemasoleva broneeringuga
    $kontroll = "SELECT * FROM reservations
                 WHERE car_id = $car_id
                 AND (
                     start_date <= '$end_date'
                     AND end_date >= '$start_date'
                 )";

    $kontroll_valjund = mysqli_query($yhendus, $kontroll);

    if (mysqli_num_rows($kontroll_valjund) > 0) {
        $vead = "See auto on valitud ajavahemikul juba broneeritud.";
    } else {

        // Lisa broneering
        $paring = "INSERT INTO reservations (user_id, car_id, start_date, end_date, status)
                   VALUES ($user_id, $car_id, '$start_date', '$end_date', 'confirmed')";

        mysqli_query($yhendus, $paring);

        header("Location: minu_rendid.php");
        exit();
    }
}

include("header.php");
?>

<div class="container mt-5" style="max-width: 800px;">
    <h2><?php echo $auto["mark"] . " " . $auto["model"]; ?></h2>

    <?php if (!empty($vead)): ?>
        <div class="alert alert-danger mt-3"><?php echo $vead; ?></div>
    <?php endif; ?>

    <div class="row mt-4">
        <div class="col-md-6">
            <img src="https://loremflickr.com/600/400/<?php echo str_replace(' ', '', $auto['mark']); ?>" 
                 class="img-fluid rounded">
        </div>

        <div class="col-md-6">
            <p><strong>Mootor:</strong> <?php echo $auto["engine"]; ?></p>
            <p><strong>Kütus:</strong> <?php echo $auto["fuel"]; ?></p>
            <p><strong>Hind:</strong> <?php echo $auto["price"]; ?> €/päev</p>

            <?php if (isset($_SESSION["user_id"])): ?>
                <form method="POST">

                    <div class="mb-3">
                        <label>Alguskuupäev</label>
                        <input type="date" name="start_date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Lõppkuupäev</label>
                        <input type="date" name="end_date" class="form-control" required>
                    </div>

                    <button type="submit" name="rent" class="btn btn-success w-100">
                        Rendi see auto
                    </button>
                </form>
            <?php else: ?>
                <div class="alert alert-info">Rendiks pead olema sisse logitud.</div>
                <a href="login.php" class="btn btn-primary w-100">Logi sisse</a>
            <?php endif; ?>
        </div>
    </div>
</div>

</body>
</html>
