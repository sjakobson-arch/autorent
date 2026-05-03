<?php
session_start();
include("config.php");

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

// Kui autot ei leitud
if (!$auto) {
    echo "<h2>Autot ei leitud.</h2>";
    exit();
}

// Kui kasutaja vajutas "Rendi"
if (isset($_POST["rent"])) {

    if (!isset($_SESSION["user_id"])) {
        header("Location: login.php");
        exit();
    }

    $user_id = $_SESSION["user_id"];

    // Lisa kirje reservations tabelisse
    $paring = "INSERT INTO reservations (user_id, car_id, status)
               VALUES ($user_id, $car_id, 'active')";
    mysqli_query($yhendus, $paring);

    // Uuenda auto staatust
    mysqli_query($yhendus, "UPDATE cars SET status='renditud' WHERE id=$car_id");

    header("Location: index.php");
    exit();
}

include("header.php");
?>

<div class="container mt-5" style="max-width: 800px;">
    <h2><?php echo $auto["mark"] . " " . $auto["model"]; ?></h2>

    <div class="row mt-4">
        <div class="col-md-6">
            <img src="<?php echo $auto["image"]; ?>" class="img-fluid rounded">
        </div>

        <div class="col-md-6">
            <p><strong>Aasta:</strong> <?php echo $auto["year"]; ?></p>
            <p><strong>Mootor:</strong> <?php echo $auto["engine"]; ?></p>
            <p><strong>Kütus:</strong> <?php echo $auto["fuel"]; ?></p>
            <p><strong>Käigukast:</strong> <?php echo $auto["transmission"]; ?></p>
            <p><strong>Istekohti:</strong> <?php echo $auto["seats"]; ?></p>
            <p><strong>Hind:</strong> <?php echo $auto["price"]; ?> €/päev</p>
            <p><strong>Staatus:</strong> <?php echo $auto["status"]; ?></p>

            <p class="mt-3"><?php echo $auto["description"]; ?></p>

            <?php if ($auto["status"] !== "vaba"): ?>
                <div class="alert alert-warning">See auto ei ole hetkel saadaval.</div>
            <?php else: ?>

                <?php if (isset($_SESSION["user_id"])): ?>
                    <form method="POST">
                        <button type="submit" name="rent" class="btn btn-success w-100">
                            Rendi see auto
                        </button>
                    </form>
                <?php else: ?>
                    <div class="alert alert-info">
                        Rendiks pead olema sisse logitud.
                    </div>
                    <a href="login.php" class="btn btn-primary w-100">Logi sisse</a>
                <?php endif; ?>

            <?php endif; ?>
        </div>
    </div>
</div>

</body>
</html>
