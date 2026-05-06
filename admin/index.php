<?php
session_start();
include("../config.php");
include("../admin_protect.php");
include("../header.php");
?>

<div class="container mt-4">
    <h1 class="mb-4">Admini töölaud</h1>

    <div class="row g-4">

        <!-- Autode haldus -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Autod</h5>
                    <p class="card-text">Lisa, muuda või kustuta autosid.</p>
                    <a href="cars.php" class="btn btn-primary mt-auto">Halda autosid</a>
                </div>
            </div>
        </div>

        <!-- Broneeringud -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Broneeringud</h5>
                    <p class="card-text">Vaata ja halda kõiki broneeringuid.</p>
                    <a href="reservations.php" class="btn btn-primary mt-auto">Halda broneeringuid</a>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
