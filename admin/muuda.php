<?php
include("admin_check.php");
include("../config.php");
include("../header.php");

$id = intval($_GET["id"]);
$paring = "SELECT * FROM cars WHERE id=$id";
$valjund = mysqli_query($yhendus, $paring);
$auto = mysqli_fetch_assoc($valjund);

if (!$auto) {
    echo "<h2>Autot ei leitud.</h2>";
    exit();
}

if (isset($_POST["muuda"])) {
    $mark = $_POST["mark"];
    $model = $_POST["model"];
    $engine = $_POST["engine"];
    $fuel = $_POST["fuel"];
    $price = $_POST["price"];

    $paring = "UPDATE cars SET 
                mark='$mark',
                model='$model',
                engine='$engine',
                fuel='$fuel',
                price='$price'
               WHERE id=$id";

    mysqli_query($yhendus, $paring);

    header("Location: cars.php");
    exit();
}
?>

<div class="container mt-5" style="max-width: 600px;">
    <h2>Muuda auto andmeid</h2>

    <form method="POST">
        <div class="mb-3">
            <label>Mark</label>
            <input type="text" name="mark" class="form-control" value="<?php echo $auto['mark']; ?>" required>
        </div>

        <div class="mb-3">
            <label>Mudel</label>
            <input type="text" name="model" class="form-control" value="<?php echo $auto['model']; ?>" required>
        </div>

        <div class="mb-3">
            <label>Mootor</label>
            <input type="text" name="engine" class="form-control" value="<?php echo $auto['engine']; ?>" required>
        </div>

        <div class="mb-3">
            <label>Kütus</label>
            <input type="text" name="fuel" class="form-control" value="<?php echo $auto['fuel']; ?>" required>
        </div>

        <div class="mb-3">
            <label>Hind (€ / päev)</label>
            <input type="number" name="price" class="form-control" value="<?php echo $auto['price']; ?>" required>
        </div>

        <button type="submit" name="muuda" class="btn btn-primary w-100">Salvesta muudatused</button>
    </form>
</div>

</body>
</html>
