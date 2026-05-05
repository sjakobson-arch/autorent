<?php
include("admin_check.php");
include("../config.php");

$id = intval($_GET["id"]);

mysqli_query($yhendus, "UPDATE reservations SET status='cancelled' WHERE id=$id");

header("Location: reservations.php");
exit();
