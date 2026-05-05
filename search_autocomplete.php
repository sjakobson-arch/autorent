<?php
include("config.php");

$term = $_GET["term"] ?? "";

$paring = mysqli_prepare($yhendus, "
    SELECT mark, model, image 
    FROM cars 
    WHERE mark LIKE ? OR model LIKE ? 
    LIMIT 10
");

$like = "%".$term."%";
mysqli_stmt_bind_param($paring, "ss", $like, $like);
mysqli_stmt_execute($paring);
$result = mysqli_stmt_get_result($paring);

$autod = [];

while ($r = mysqli_fetch_assoc($result)) {
    $autod[] = [
        "name" => $r["mark"] . " " . $r["model"],
        "image" => "/autorent/" . $r["image"]
    ];
}

echo json_encode($autod);
