<?php
session_start();
include("config.php");
include("header.php");

if (!isset($_SESSION["user_id"])) {
    echo "<div class='container'><div class='alert alert-danger mt-4'>Palun logi sisse.</div></div>";
    exit;
}

$user_id = $_SESSION["user_id"];

$paring = mysqli_prepare($yhendus, "
    SELECT r.*, c.mark, c.model
    FROM reservations r
    JOIN cars c ON r.car_id = c.id
    WHERE r.user_id = ?
    ORDER BY r.id DESC
");
mysqli_stmt_bind_param($paring, "i", $user_id);
mysqli_stmt_execute($paring);
$valjund = mysqli_stmt_get_result($paring);
?>

<div class="container mt-4">
    <h2 class="mb-4">Minu rendid</h2>

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Auto</th>
                    <th>Algus</th>
                    <th>Lõpp</th>
                    <th>Hind (€)</th>
                    <th>Staatus</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($r = mysqli_fetch_assoc($valjund)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($r["mark"] . " " . $r["model"]); ?></td>
                        <td><?php echo $r["start_date"]; ?></td>
                        <td><?php echo $r["end_date"]; ?></td>
                        <td><?php echo $r["total_price"]; ?></td>
                        <td>
                            <?php if ($r["status"] === "pending"): ?>
                                <span class="badge bg-warning text-dark">Ootel</span>
                            <?php elseif ($r["status"] === "confirmed"): ?>
                                <span class="badge bg-success">Kinnitatud</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Tühistatud</span>
                            <?php endif; ?>
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
