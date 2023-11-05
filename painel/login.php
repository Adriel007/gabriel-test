<?php
// login de usuário
header("Content-Type: application/json; charset=UTF-8");
require '../Database.php';

try {
    session_start();

    $db = new Database();
    $response = ['' => ''];
    $postData = json_decode(file_get_contents("php://input"), true);

    // Check if the required fields are set
    if (
        !isset($postData["email"]) || !isset($postData["password"])
        || empty($postData["email"]) || empty($postData["password"])
    ) {
        $response["failure"] = "Preencha todos os campos";
    }
    // Check if the request method is POST
    else if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = filter_var($postData['email'], FILTER_SANITIZE_EMAIL);
        $password = htmlspecialchars($postData['password']);

        $db->connect();

        // Use prepared statements to prevent SQL injection
        $results = $db->select('adm', '*', "email_ = ? AND password_ = ?", [$email, $password]);

        if (count($results) > 0) {
            $_SESSION["authorized"] = true;
            $_SESSION["name"] = $results[0]["name_"];
            $_SESSION["email"] = $results[0]["email_"];
            $_SESSION["password"] = $results[0]["password_"];
            $response['success'] = true;
        } else {
            $response['failure'] = 'Email ou senha inválido';
        }

    } else {
        // Invalid request method
        $response['failure'] = 'Método de requisição inválido';
    }

    echo json_encode($response);
    exit(0);
} catch (Exception $e) {
    log_error_json($e);
}

?>