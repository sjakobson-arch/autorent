<?php
include("admin_check.php");
include("../config.php");
include("../header.php");

// --- STATISTIKA PÄRINGUD ---
// Autod kokku
$q1 = mysqli_query($yhendus, "SELECT COUNT(*) AS total FROM cars");
$autod_kokku = mysqli_fetch_assoc($q1)["total"];

// Broneeringud kokku
$q2 = mysqli_query($yhendus, "SELECT COUNT(*) AS total FROM reservations");
$broneeringud_kokku = mysqli_fetch_assoc($q2)["total"];

// Aktiivsed broneeringud
$q3 = mysqli_query($yhendus, "SELECT COUNT(*) AS total FROM reservations WHERE status='confirmed'");
$broneeringud_aktiivsed = mysqli_fetch_assoc($q3)["total"];

// Ootel broneeringud
$q4 = mysqli_query($yhendus, "SELECT COUNT(*) AS total FROM reservations WHERE status='pending'");
$broneeringud_ootel = mysqli_fetch_assoc($q4)["total"];

// Tühistatud broneeringud
$q5 = mysqli_query($yhendus, "SELECT COUNT(*) AS total FROM reservations WHERE status='cancelled'");
$broneeringud_tuhistatud = mysqli_fetch_assoc($q5)["total"];
?>

<div class="container mt-5">
    <h1 class="mb-4">Admini juhtpaneel</h1>

    <!-- HALDUSKAARDID (KÕIGE ÜLEVAL) -->
    <div class="row mb-4">

        <!-- Autode haldus -->
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h4 class="card-title">Autode haldus</h4>
                    <p class="card-text">Lisa, muuda või kustuta autosid.</p>
                    <a href="cars.php" class="btn btn-primary w-100">Halda autosid</a>
                </div>
            </div>
        </div>

        <!-- Broneeringute haldus -->
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h4 class="card-title">Broneeringud</h4>
                    <p class="card-text">Vaata ja halda kõiki broneeringuid.</p>
                    <a href="reservations.php" class="btn btn-primary w-100">Halda broneeringuid</a>
                </div>
            </div>
        </div>

    </div>

    <!-- STATISTIKA (NUPPUDE ALL) -->
    <div class="row mb-4">

        <div class="col-md-3">
            <div class="card shadow-sm text-center p-3">
                <h4>Autod kokku</h4>
                <h2><?php echo $autod_kokku; ?></h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm text-center p-3">
                <h4>Broneeringud kokku</h4>
                <h2><?php echo $broneeringud_kokku; ?></h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm text-center p-3">
                <h4>Aktiivsed</h4>
                <h2 class="text-success"><?php echo $broneeringud_aktiivsed; ?></h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm text-center p-3">
                <h4>Ootel</h4>
                <h2 class="text-warning"><?php echo $broneeringud_ootel; ?></h2>
            </div>
        </div>

        <div class="col-md-3 mt-3">
            <div class="card shadow-sm text-center p-3">
                <h4>Tühistatud</h4>
                <h2 class="text-danger"><?php echo $broneeringud_tuhistatud; ?></h2>
            </div>
        </div>

    </div>

</div>

</body>
</html>
