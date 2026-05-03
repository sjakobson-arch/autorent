<?php
session_start();
include("config.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

$paring = "SELECT cars.mark, cars.model, cars.price,
           reservations.start_date, reservations.end_date, reservations.status
           FROM reservations
           JOIN cars ON reservations.car_id = cars.id
           WHERE reservations.user_id = $user_id
           ORDER BY reservations.start_date DESC";

$valjund = mysqli_query($yhendus, $paring);

include("header.php");
?>

<div class="container mt-5">
    <h2>Minu rendid</h2>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>Auto</th>
                <th>Hind</th>
                <th>Algus</th>
                <th>Lõpp</th>
                <th>Staatus</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($rida = mysqli_fetch_assoc($valjund)): ?>
                <tr>
                    <td><?php echo $rida["mark"] . " " . $rida["model"]; ?></td>
                    <td><?php echo $rida["price"]; ?> €/päev</td>
                    <td><?php echo $rida["start_date"]; ?></td>
                    <td><?php echo $rida["end_date"]; ?></td>
                    <td><?php echo $rida["status"]; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
