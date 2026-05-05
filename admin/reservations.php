<?php
include("admin_check.php");
include("../config.php");
include("../header.php");

// Mitu rida korraga
$per_page = 50;

// Praegune leht
$page = isset($_GET["page"]) ? max(1, intval($_GET["page"])) : 1;

// Mitme rea vahele jätmine
$start = ($page - 1) * $per_page;

// Kokku broneeringute arv
$total_query = mysqli_query($yhendus, "SELECT COUNT(*) AS total FROM reservations");
$total_rows = mysqli_fetch_assoc($total_query)["total"];

// Lehekülgede arv
$total_pages = ceil($total_rows / $per_page);

// Võtame broneeringud koos kasutaja ja auto infoga
$paring = "
    SELECT r.*, 
           u.first_name, u.last_name, 
           c.mark, c.model
    FROM reservations r
    JOIN users u ON r.user_id = u.id
    JOIN cars c ON r.car_id = c.id
    ORDER BY r.id DESC
    LIMIT $start, $per_page
";

$valjund = mysqli_query($yhendus, $paring);
?>

<div class="container mt-5">
    <h2 class="mb-4">Broneeringute haldus</h2>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Kasutaja</th>
                <th>Auto</th>
                <th>Algus</th>
                <th>Lõpp</th>
                <th>Hind</th>
                <th>Staatus</th>
                <th>Tegevused</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($r = mysqli_fetch_assoc($valjund)): ?>
                <tr>
                    <td><?php echo $r["id"]; ?></td>
                    <td><?php echo $r["first_name"] . " " . $r["last_name"]; ?></td>
                    <td><?php echo $r["mark"] . " " . $r["model"]; ?></td>
                    <td><?php echo $r["start_date"]; ?></td>
                    <td><?php echo $r["end_date"]; ?></td>
                    <td><?php echo $r["total_price"]; ?> €</td>
                    <td>
                        <?php
                            if ($r["status"] === "pending") echo "<span class='badge bg-warning'>Ootel</span>";
                            if ($r["status"] === "confirmed") echo "<span class='badge bg-success'>Kinnitatud</span>";
                            if ($r["status"] === "cancelled") echo "<span class='badge bg-danger'>Tühistatud</span>";
                        ?>
                    </td>
                    <td>
                        <?php if ($r["status"] !== "confirmed"): ?>
                            <a href="reservations_confirm.php?id=<?php echo $r['id']; ?>" class="btn btn-success btn-sm">Kinnita</a>
                        <?php endif; ?>

                        <?php if ($r["status"] !== "cancelled"): ?>
                            <a href="reservations_cancel.php?id=<?php echo $r['id']; ?>" class="btn btn-danger btn-sm">Tühista</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- PAGINATION -->
    <nav>
        <ul class="pagination">

            <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                <a class="page-link" href="?page=<?php echo $page - 1; ?>">Eelmine</a>
            </li>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>

            <li class="page-item <?php if ($page >= $total_pages) echo 'disabled'; ?>">
                <a class="page-link" href="?page=<?php echo $page + 1; ?>">Järgmine</a>
            </li>

        </ul>
    </nav>

</div>

</body>
</html>
