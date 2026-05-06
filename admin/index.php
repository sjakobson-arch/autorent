<?php
session_start();
include("../config.php");
include("../header.php");
?>

<div class="container mt-4">

    <h2 class="mb-4">Admini töölaud</h2>

    <div class="row">

        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Autode haldus</h5>
                    <p class="card-text">Lisa, muuda või kustuta autosid.</p>
                    <a href="cars.php" class="btn btn-primary w-100">Halda autosid</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Broneeringute haldus</h5>
                    <p class="card-text">Kinnita või tühista broneeringuid.</p>
                    <a href="reservations.php" class="btn btn-primary w-100">Halda broneeringuid</a>
                </div>
            </div>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
