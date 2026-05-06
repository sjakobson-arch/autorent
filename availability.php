<?php
session_start();
include("config.php");
include("header.php");

$start = $_GET["start_date"] ?? "";
$end = $_GET["end_date"] ?? "";

$autod = [];

if (!empty($start) && !empty($end)) {

    $stmt = mysqli_prepare($yhendus, "
        SELECT * FROM cars
        WHERE id NOT IN (
            SELECT car_id FROM reservations
            WHERE NOT (end_date < ? OR start_date > ?)
        )
    ");
    mysqli_stmt_bind_param($stmt, "ss", $start, $end);
    mysqli_stmt_execute($stmt);
    $autod = mysqli_stmt_get_result($stmt);
}
?>

<div class="container mt-4">

    <h2 class="mb-4">Kontrolli auto saadavust</h2>

    <form method="GET" class="card p-4 shadow-sm mb-4">

        <div class="row">
            <div class="col-md-5 mb-3">
                <label class="form-label">Alguskuupäev</label>
                <input type="date" name="start_date" class="form-control"
                       value="<?php echo htmlspecialchars($start); ?>" required>
            </div>

            <div class="col-md-5 mb-3">
                <label class="form-label">Lõppkuupäev</label>
                <input type="date" name="end_date" class="form-control"
                       value="<?php echo htmlspecialchars($end); ?>" required>
            </div>

            <div class="col-md-2 d-flex align-items-end mb-3">
                <button class="btn btn-primary w-100">Otsi</button>
            </div>
        </div>

    </form>

    <?php if (!empty($start) && !empty($end)): ?>

        <h4 class="mb-3">Saadaval autod:</h4>

        <div class="row">

            <?php while ($r = mysqli_fetch_assoc($autod)): ?>
                <div class="col-md-4 mb-4">

                    <div class="card h-100">

                        <img src="https://loremflickr.com/400/250/<?php echo str_replace(' ', '', $r['mark']); ?>"
                             class="card-img-top"
                             alt="<?php echo htmlspecialchars($r['mark'] . ' ' . $r['model']); ?>">

                        <div class="card-body">

                            <h5 class="card-title">
                                <?php echo htmlspecialchars($r['mark'] . ' ' . $r['model']); ?>
                            </h5>

                            <p class="card-text">
                                Mootor: <?php echo htmlspecialchars($r['engine']); ?><br>
                                Kütus: <?php echo htmlspecialchars($r['fuel']); ?><br>
                                Hind: <?php echo htmlspecialchars($r['price']); ?> € / päev
                            </p>

                            <a href="single_car.php?id=<?php echo $r['id']; ?>"
                               class="btn btn-primary">
                                Vaata lähemalt
                            </a>

                        </div>
                    </div>

                </div>
            <?php endwhile; ?>

        </div>

    <?php endif; ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
