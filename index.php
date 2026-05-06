<?php
session_start();
include("config.php");
include("header.php");

// Võtame autod
$paring = mysqli_query($yhendus, "SELECT * FROM cars");
?>

<div class="container">
    <h1 class="mb-4">Meie autod</h1>

    <div class="row g-4">

        <?php while ($rida = mysqli_fetch_assoc($paring)): ?>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">

                    <img src="https://loremflickr.com/400/250/<?php echo str_replace(' ', '', $rida['mark']); ?>"
                         class="card-img-top"
                         alt="<?php echo htmlspecialchars($rida['mark'] . ' ' . $rida['model']); ?>">

                    <div class="card-body d-flex flex-column">

                        <h5 class="card-title">
                            <?php echo htmlspecialchars($rida['mark'] . ' ' . $rida['model']); ?>
                        </h5>

                        <p class="card-text mb-1">
                            <strong>Mootor:</strong> <?php echo htmlspecialchars($rida['engine']); ?>
                        </p>

                        <p class="card-text mb-1">
                            <strong>Kütus:</strong> <?php echo htmlspecialchars($rida['fuel']); ?>
                        </p>

                        <p class="card-text mb-2">
                            <strong>Hind päevas:</strong> <?php echo htmlspecialchars($rida['price']); ?> €
                        </p>

                        <a href="single_car.php?id=<?php echo $rida['id']; ?>"
                           class="btn btn-primary mt-auto">
                            Vaata lähemalt
                        </a>

                    </div>
                </div>
            </div>
        <?php endwhile; ?>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
