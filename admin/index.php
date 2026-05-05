<?php
// Admini ligipääsu kontroll
include("admin_check.php");

// Andmebaasi ühendus
include("../config.php");

// Ühine header (navbar jne)
include("../header.php");
?>

<div class="container mt-5">
    <h1 class="mb-4">Admini juhtpaneel</h1>

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

        <!-- Kasutajate haldus -->
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h4 class="card-title">Kasutajad</h4>
                    <p class="card-text">Vaata kasutajaid ja muuda rolle.</p>
                    <a href="users.php" class="btn btn-primary w-100">Halda kasutajaid</a>
                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>
