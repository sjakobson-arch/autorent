<?php
// Tagab, et sessioon on alati olemas
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kontrollime, kas kasutaja on sisse logitud JA kas ta on admin
if (
    !isset($_SESSION["user_id"]) ||
    !isset($_SESSION["role"]) ||
    $_SESSION["role"] !== "admin"
) {
    // Suuname õigesse login.php faili (juurkausta)
    header("Location: ../login.php");
    exit;
}
