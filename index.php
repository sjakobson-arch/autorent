<?php
session_start();
include("config.php");
include("header.php");

$paring = mysqli_query($yhendus, "SELECT * FROM cars");
?>

<div class="container">

    <div class="row">

        <?php while ($rida = mysqli_fetch_assoc($paring)): ?>
            <div class="col-md-4 mb-4">

                <div class="card h-100">

                    <img src="https://loremflickr.com/400/250/<?php echo str_replace(' ', '', $rida['mark']); ?>"
                         class="card-img-top"
                         alt="<?php echo htmlspecialchars($rida['mark'] . ' ' . $rida['model']); ?>">

                    <div class="card-body">

                        <h5 class="card-title">
                            <?php echo htmlspecialchars($rida['mark'] . ' ' . $rida['model']); ?>
                        </h5>

                        <p class="card-text">
                            Mootor: <?php echo htmlspecialchars($rida['engine']); ?><br>
                            Kütus: <?php echo htmlspecialchars($rida['fuel']); ?><br>
                            Hind: <?php echo htmlspecialchars($rida['price']); ?> € / päev
                        </p>

                        <a href="single_car.php?id=<?php echo $rida['id']; ?>"
                           class="btn btn-primary">
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
