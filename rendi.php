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
    $price = $_POST["total_price"];

    $stmt = mysqli_prepare($yhendus, "
        INSERT INTO reservations (car_id, user_id, start_date, end_date, total_price, status)
        VALUES (?, ?, ?, ?, ?, 'pending')
    ");
    mysqli_stmt_bind_param($stmt, "i ss sd", $car_id, $user_id, $start, $end, $price);
    mysqli_stmt_execute($stmt);

    echo "<div class='container mt-4'>
            <div class='alert alert-success'>
                Broneering salvestatud! Leiad selle lehelt <a href='minu_rendid.php'>Minu rendid</a>.
            </div>
          </div>";
    exit;
}

echo "<div class='container mt-4'><div class='alert alert-danger'>Vigane päring.</div></div>";
?>
