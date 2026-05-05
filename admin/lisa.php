<?php
include("admin_check.php");
include("../config.php");
include("../header.php");

$vead = "";

if (isset($_POST["lisa"])) {
    $mark = $_POST["mark"];
    $model = $_POST["model"];
    $engine = $_POST["engine"];
    $fuel = $_POST["fuel"];
    $price = $_POST["price"];

    $paring = "INSERT INTO cars (mark, model, engine, fuel, price)
               VALUES ('$mark', '$model', '$engine', '$fuel', '$price')";

    mysqli_query($yhendus, $paring);

    header("Location: cars.php");
    exit();
}
?>

<div class="container mt-5" style="max-width: 600px;">
    <h2>Lisa uus auto</h2>

    <form method="POST">
        <div class="mb-3">
            <label>Mark</label>
            <input type="text" name="mark" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Mudel</label>
            <input type="text" name="model" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Mootor</label>
            <input type="text" name="engine" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Kütus</label>
            <input type="text" name="fuel" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Hind (€ / päev)</label>
            <input type="number" name="price" class="form-control" required>
        </div>

        <button type="submit" name="lisa" class="btn btn-success w-100">Lisa auto</button>
    </form>
</div>

</body>
</html>
