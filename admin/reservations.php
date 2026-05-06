<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("../config.php");
include("admin_protect.php");
include("../header.php");

// Kõik broneeringud koos kasutaja ja auto infoga
$query = "
    SELECT r.*, 
           u.first_name,
           u.last_name,
           c.mark AS car_mark,
           c.model AS car_model
    FROM reservations r
    LEFT JOIN users u ON r.user_id = u.id
    LEFT JOIN cars c ON r.car_id = c.id
    ORDER BY r.created_at DESC
";

$result = mysqli_query($yhendus, $query);
?>

<div class="container mt-4">
    <h2 class="mb-4">Broneeringute haldus</h2>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Kasutaja</th>
                <th>Auto</th>
                <th>Algus</th>
                <th>Lõpp</th>
                <th>Hind (€)</th>
                <th>Staatus</th>
                <th>Tegevused</th>
            </tr>
        </thead>
        <tbody>

        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>

                <td>
                    <?php echo htmlspecialchars($row["first_name"] . " " . $row["last_name"]); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($row["car_mark"] . " " . $row["car_model"]); ?>
                </td>

                <td><?php echo $row["start_date"]; ?></td>
                <td><?php echo $row["end_date"]; ?></td>

                <td>
                    <?php echo $row["total_price"] !== null ? $row["total_price"] : "—"; ?>
                </td>

                <td>
                    <?php if ($row["status"] === "confirmed"): ?>
                        <span class="badge bg-success">Kinnitatud</span>
                    <?php elseif ($row["status"] === "cancelled"): ?>
                        <span class="badge bg-danger">Tühistatud</span>
                    <?php else: ?>
                        <span class="badge bg-warning text-dark">Ootel</span>
                    <?php endif; ?>
                </td>

                <td>
                    <?php if ($row["status"] !== "confirmed"): ?>
                        <a href="reservations_confirm.php?id=<?php echo $row['id']; ?>" 
                           class="btn btn-success btn-sm">Kinnita</a>
                    <?php endif; ?>

                    <?php if ($row["status"] !== "cancelled"): ?>
                        <a href="reservations_cancel.php?id=<?php echo $row['id']; ?>" 
                           class="btn btn-danger btn-sm">Tühista</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>

        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
