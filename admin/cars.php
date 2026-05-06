<?php
session_start();
include("../config.php");
include("../admin_protect.php");
include("../header.php");

// Võtame autod
$paring = mysqli_query($yhendus, "SELECT * FROM cars");
?>

<div class="container mt-4">
    <h1 class="mb-4">Autode haldus</h1>

    <a href="add_car.php" class="btn btn-success mb-3">Lisa uus auto</a>

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Mark</th>
                    <th>Mudel</th>
                    <th>Mootor</th>
                    <th>Kütus</th>
                    <th>Hind (€)</th>
                    <th>Staatus</th>
                    <th>Tegevused</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($r = mysqli_fetch_assoc($paring)): ?>
                    <tr>
                        <td><?php echo $r["id"]; ?></td>
                        <td><?php echo htmlspecialchars($r["mark"]); ?></td>
                        <td><?php echo htmlspecialchars($r["model"]); ?></td>
                        <td><?php echo htmlspecialchars($r["engine"]); ?></td>
                        <td><?php echo htmlspecialchars($r["fuel"]); ?></td>
                        <td><?php echo htmlspecialchars($r["price"]); ?></td>
                        <td><?php echo htmlspecialchars($r["status"]); ?></td>
                        <td>
                            <a href="muuda.php?id=<?php echo $r['id']; ?>" class="btn btn-sm btn-primary">Muuda</a>
                            <a href="lisa.php?id=<?php echo $r['id']; ?>" class="btn btn-sm btn-primary">Lisa</a>
                            <a href="kustuta.php?id=<?php echo $r['id']; ?>" class="btn btn-sm btn-danger"
                               onclick="return confirm('Kas oled kindel, et soovid kustutada?');">
                                Kustuta
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
