<?php
include("admin_check.php");
include("../config.php");

if (!isset($_GET["id"])) {
    die("ID puudub");
}

$id = intval($_GET["id"]);

mysqli_query($yhendus, "UPDATE reservations SET status='confirmed' WHERE id=$id");

header("Location: reservations.php");
exit();
