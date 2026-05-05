
<?php
include("admin_protect.php");
include("admin_check.php");
include("../config.php");
include("../header.php");

// Mitu rida korraga
$per_page = 50;

// Praegune leht
$page = isset($_GET["page"]) ? max(1, intval($_GET["page"])) : 1;

// Mitme rea vahele jätmine
$start = ($page - 1) * $per_page;

// Kokku autode arv
$total_query = mysqli_query($yhendus, "SELECT COUNT(*) AS total FROM cars");
$total_rows = mysqli_fetch_assoc($total_query)["total"];

// Lehekülgede arv
$total_pages = ceil($total_rows / $per_page);

// Võtame 50 rida
$paring = "SELECT * FROM cars ORDER BY id DESC LIMIT $start, $per_page";
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

    <!-- PAGINATION -->
    <nav>
        <ul class="pagination">

            <!-- Eelmine -->
            <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                <a class="page-link" href="?page=<?php echo $page - 1; ?>">Eelmine</a>
            </li>

            <!-- Lehekülje numbrid -->
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>">
                        <?php echo $i; ?>
                    </a>
                </li>
            <?php endfor; ?>

            <!-- Järgmine -->
            <li class="page-item <?php if ($page >= $total_pages) echo 'disabled'; ?>">
                <a class="page-link" href="?page=<?php echo $page + 1; ?>">Järgmine</a>
            </li>

        </ul>
    </nav>

</div>

</body>
</html>
