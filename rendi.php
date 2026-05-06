<?php
session_start();
include("config.php");

if (!isset($_SESSION["user_id"])) {
    echo "<div class='container mt-4'><div class='alert alert-danger'>Palun logi sisse.</div></div>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $car_id = intval($_POST["car_id"]);
    $user_id = $_SESSION["user_id"];
    $start = $_POST["start_date"];
    $end = $_POST["end_date"];

    // Võtame auto hinna
    $stmt = mysqli_prepare($yhendus, "SELECT price FROM cars WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $car_id);
    mysqli_stmt_execute($stmt);
    $car = mysqli_stmt_get_result($stmt)->fetch_assoc();

    if (!$car) {
        echo "<div class='container mt-4'><div class='alert alert-danger'>Autot ei leitud.</div></div>";
        exit;
    }

    $price_per_day = $car["price"];

    // Arvutame päevade arvu
    $days = (strtotime($end) - strtotime($start)) / 86400;
    if ($days < 1) $days = 1;

    $total_price = $days * $price_per_day;

    // Salvestame broneeringu
    $stmt2 = mysqli_prepare($yhendus, "
        INSERT INTO reservations (car_id, user_id, start_date, end_date, total_price, status)
        VALUES (?, ?, ?, ?, ?, 'pending')
    ");
    mysqli_stmt_bind_param($stmt2, "i ss sd", $car_id, $user_id, $start, $end, $total_price);
    mysqli_stmt_execute($stmt2);

    echo "<div class='container mt-4'>
            <div class='alert alert-success'>
                Broneering salvestatud! Leiad selle lehelt <a href='minu_rendid.php'>Minu rendid</a>.
            </div>
          </div>";
    exit;
}

echo "<div class='container mt-4'><div class='alert alert-danger'>Vigane päring.</div></div>";
?>
