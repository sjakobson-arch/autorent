include("admin_protect.php");

<?php
include("admin_check.php");
include("../config.php");

if (!isset($_GET["id"])) {
    die("ID puudub");
}

$id = intval($_GET["id"]);

// Kontrollime, kas broneering eksisteerib
$check = mysqli_query($yhendus, "SELECT id FROM reservations WHERE id=$id");
if (mysqli_num_rows($check) === 0) {
    die("Broneeringut ei leitud");
}

// Tühistame broneeringu
mysqli_query($yhendus, "UPDATE reservations SET status='cancelled' WHERE id=$id");

header("Location: reservations.php");
exit();
