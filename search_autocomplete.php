<?php
include("config.php");

$term = $_GET["term"] ?? "";

if (strlen($term) < 1) {
    echo json_encode([]);
    exit;
}

$term = "%".$term."%";

$stmt = mysqli_prepare($yhendus, "
    SELECT CONCAT(mark, ' ', model) AS name
    FROM cars
    WHERE mark LIKE ? OR model LIKE ?
    LIMIT 5
");
mysqli_stmt_bind_param($stmt, "ss", $term, $term);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$names = [];
while ($row = mysqli_fetch_assoc($result)) {
    $names[] = $row["name"];
}

echo json_encode($names);
exit;
