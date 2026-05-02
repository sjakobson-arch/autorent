<?php
$server = "localhost";
$kasutaja = "root";
$parool = "";
$andmebaas = "autorent";

$yhendus = new mysqli($server, $kasutaja, $parool, $andmebaas);

if ($yhendus->connect_error) {
    die("Andmebaasi ühendus ebaõnnestus: " . $yhendus->connect_error);
}
?>
