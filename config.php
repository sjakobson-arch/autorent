<?php
session_start([
    'cookie_httponly' => true,
    'cookie_secure' => isset($_SERVER['HTTPS']),
    'cookie_samesite' => 'Strict'
]);


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
