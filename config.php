<?php
// Vaikimisi väärtused (Ubuntu server / tavaline install)
$db_server    = 'localhost';
$db_andmebaas = 'autorent';
$db_kasutaja  = 'autorent';
$db_salasona  = 'Parool123!';

// Kui Dockeris on keskkonnamuutujad määratud, kirjutame need üle
if (getenv('DB_HOST')) {
    $db_server = getenv('DB_HOST');
}
if (getenv('DB_NAME')) {
    $db_andmebaas = getenv('DB_NAME');
}
if (getenv('DB_USER')) {
    $db_kasutaja = getenv('DB_USER');
}
if (getenv('DB_PASSWORD')) {
    $db_salasona = getenv('DB_PASSWORD');
}

// Ühendus andmebaasiga
$yhendus = mysqli_connect($db_server, $db_kasutaja, $db_salasona, $db_andmebaas);

// Ühenduse kontroll
if (!$yhendus) {
    die('Ei saa ühendust andmebaasiga');
}
?>
