<?php
include("admin_check.php");
include("../config.php");

$id = intval($_GET["id"]);

$paring = "DELETE FROM cars WHERE id=$id";
mysqli_query($yhendus, $paring);

header("Location: cars.php");
exit();
