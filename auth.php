<?php
// incepe sesiunea
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// verifica daca utilizatorul este logat
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}
?>