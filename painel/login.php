<?php
// login de usuário
header("Content-Type: application/json; charset=UTF-8");
require '../Database.php';

$db = new Database();
$response = [];

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve and sanitize user input (make sure to implement proper input validation and security measures)
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // Perform user authentication (modify this based on your authentication logic)
    $sql = "SELECT * FROM ADM WHERE email = :email";
    $stmt = $db->connect()->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Successful authentication
        $response['success'] = true;
    } else {
        // Failed authentication
        $response['failure'] = 'Invalid email or password';
    }
} else {
    // Invalid request method
    $response['failure'] = 'Invalid request method';
}

echo json_encode($response);
exit(0);
?>