<?php
include '../config/db.php';
session_start();

$car_id = $_POST['car_id'];
$start = $_POST['start'];
$end = $_POST['end'];

$stmt = $pdo->prepare("
SELECT * FROM rents 
WHERE car_id=? 
AND (
    (start_date <= ? AND end_date >= ?) OR
    (start_date <= ? AND end_date >= ?) OR
    (? <= start_date AND ? >= end_date)
)
");
$stmt->execute([$car_id, $start, $start, $end, $end, $start, $end]);

if ($stmt->rowCount() > 0) {
    die("Auto on sellel perioodil juba broneeritud.");
}

$stmt = $pdo->prepare("INSERT INTO rents (user_id, car_id, start_date, end_date) VALUES (?,?,?,?)");
$stmt->execute([$_SESSION['user_id'], $car_id, $start, $end]);

header("Location: my_rents.php");
exit;
