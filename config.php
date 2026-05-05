<?php
$server = "localhost";
$kasutaja = "autorent";
$parool = "Parool123!";
$andmebaas = "autorent";

$yhendus = new mysqli($server, $kasutaja, $parool, $andmebaas);

if ($yhendus->connect_error) {
    die("Andmebaasi ühendus ebaõnnestus: " . $yhendus->connect_error);
}
?>
