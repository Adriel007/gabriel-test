<?php
// autenticação
header("Content-Type: application/json; charset=UTF-8");
require '../Database.php';

session_start();
if (isset($_SESSION['authorized'])) {
    echo json_encode(['success' => true]);
}

exit(0);
?>