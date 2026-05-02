<?php

<?php include ('../config.php');>
<?php include ('../header.php');>

if ($_POST) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (name,email,password) VALUES (?,?,?)");
    $stmt->execute([$name, $email, $pass]);

    header("Location: login.php");
    exit;
}
?>
