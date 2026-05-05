<?php
include("admin_check.php");
include("../config.php");
include("../header.php");

// Võtame kõik autod
$paring = "SELECT * FROM cars ORDER BY id DESC";
$valjund = mysqli_query($yhendus, $paring);
?>

<div class="container mt-5">
    <h2 class="mb-4">Autode haldus</h2>

    <a href="lisa.php" class="btn btn-success mb-3">Lisa uus auto</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Mark</th>
                <th>Mudel</th>
                <th>Mootor</th>
                <th>Kütus</th>
                <th>Hind</th>
                <th>Tegevused</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($rida = mysqli_fetch_assoc($valjund)): ?>
                <tr>
                    <td><?php echo $rida["id"]; ?></td>
                    <td><?php echo $rida["mark"]; ?></td>
                    <td><?php echo $rida["model"]; ?></td>
                    <td><?php echo $rida["engine"]; ?></td>
                    <td><?php echo $rida["fuel"]; ?></td>
                    <td><?php echo $rida["price"]; ?> €</td>
                    <td>
                        <a href="muuda.php?id=<?php echo $rida['id']; ?>" class="btn btn-primary btn-sm">Muuda</a>
                        <a href="kustuta.php?id=<?php echo $rida['id']; ?>" class="btn btn-danger btn-sm"
                           onclick="return confirm('Kas oled kindel, et soovid kustutada?');">
                           Kustuta
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
