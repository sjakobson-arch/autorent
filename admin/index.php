<?php
include("admin_check.php");
include("../config.php");
include("../header.php");

// Statistika päringud
$autod_kokku = mysqli_fetch_assoc(mysqli_query($yhendus, "SELECT COUNT(*) AS total FROM cars"))["total"];
$broneeringud_kokku = mysqli_fetch_assoc(mysqli_query($yhendus, "SELECT COUNT(*) AS total FROM reservations"))["total"];
$broneeringud_aktiivsed = mysqli_fetch_assoc(mysqli_query($yhendus, "SELECT COUNT(*) AS total FROM reservations WHERE status='confirmed'"))["total"];
$broneeringud_ootel = mysqli_fetch_assoc(mysqli_query($yhendus, "SELECT COUNT(*) AS total FROM reservations WHERE status='pending'"))["total"];
$broneeringud_tuhistatud = mysqli_fetch_assoc(mysqli_query($yhendus, "SELECT COUNT(*) AS total FROM reservations WHERE status='cancelled'"))["total"];
?>

<div class="container mt-5">
    <h1 class="mb-4">Admini juhtpaneel</h1>

    <!-- STATISTIKA -->
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

    <!-- GRAAFIK -->
    <div class="row mb-5">
        <div class="col-md-6">
            <div class="card shadow-sm p-3">
                <h4 class="text-center mb-3">Broneeringute jaotus</h4>
                <canvas id="broneeringuGraafik" height="200"></canvas>
            </div>
        </div>
    </div>

    <!-- HALDUSKAARDID -->
    <div class="row">

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
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// PHP → JS andmed
const aktiivsed = <?php echo $broneeringud_aktiivsed; ?>;
const ootel = <?php echo $broneeringud_ootel; ?>;
const tuh = <?php echo $broneeringud_tuhistatud; ?>;

// Graafik
const ctx = document.getElementById('broneeringuGraafik').getContext('2d');
new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Aktiivsed', 'Ootel', 'Tühistatud'],
        datasets: [{
            data: [aktiivsed, ootel, tuh],
            backgroundColor: [
                'rgba(40, 167, 69, 0.8)',   // roheline
                'rgba(255, 193, 7, 0.8)',   // kollane
                'rgba(220, 53, 69, 0.8)'    // punane
            ],
            borderColor: [
                'rgba(40, 167, 69, 1)',
                'rgba(255, 193, 7, 1)',
                'rgba(220, 53, 69, 1)'
            ],
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});
</script>

</body>
</html>
