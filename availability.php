<?php
include("config.php");

$car_id = intval($_GET["car_id"]);

$car_q = mysqli_query($yhendus, "SELECT mark, model FROM cars WHERE id = $car_id");
$car = mysqli_fetch_assoc($car_q);

$res_q = mysqli_query($yhendus, "
    SELECT start_date, end_date FROM reservations
    WHERE car_id = $car_id AND status != 'cancelled'
");
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Saadavus – <?php echo $car["mark"] . " " . $car["model"]; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">

<h2><?php echo $car["mark"] . " " . $car["model"]; ?> – saadavus</h2>

<table class="table table-bordered mt-4">
    <thead>
        <tr>
            <th>Algus</th>
            <th>Lõpp</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($r = mysqli_fetch_assoc($res_q)): ?>
            <tr class="table-danger">
                <td><?php echo $r["start_date"]; ?></td>
                <td><?php echo $r["end_date"]; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<a href="single_car.php?id=<?php echo $car_id; ?>" class="btn btn-secondary">Tagasi</a>

</body>
</html>
