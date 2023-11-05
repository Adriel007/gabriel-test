<?php
// login de usuário
header("Content-Type: application/json; charset=UTF-8");
require '../Database.php';

try {
    $db = new Database();
    $response = ['' => ''];
    $postData = json_decode(file_get_contents("php://input"), true);

    // Check if the required fields are set
    if (!isset($postData["email"]) || !isset($postData["password"])) {
        $response["failure"] = "Preencha todos os campos";
    }
    // Check if the request method is POST
    else if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = filter_var($postData['email'], FILTER_SANITIZE_EMAIL);
        $password = htmlspecialchars($postData['password']);

        $db->connect();

        $results = $db->select('adm', '*', "email_ = '$email' AND password_ = '$password'");
        log_error_json(var_export($results, true));

        if (count($results) > 0) {
            session_start();
            $_SESSION["username"] = $results[0]["username_"];
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

function log_error_json($custom = "")
{
    file_put_contents('log.json', json_encode([
        'last_error' => error_get_last(),
        'json_last_error' => json_last_error(),
        'json_last_error_msg' => json_last_error_msg(),
        'custom' => $custom
    ]));
}

?>