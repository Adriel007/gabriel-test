<?php
header("Content-Type: application/json; charset=UTF-8");
require '../Database.php';
session_start();

$db = new Database();
$response = [];

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET['logout'])) {
        unset($_SESSION["authorized"]);
        $response['success'] = true;
    } else if (isset($_GET['table'])) {
        $db->connect();
        $results = $db->query("SELECT pet.ID AS pet_id, adopt.name_ AS adopter_name, adopt.email_ AS adopter_email, adopt.animal_id_ AS animal_id, pet.status_ AS status_ FROM pet INNER JOIN adopt ON pet.ID = adopt.animal_id_;");

        $response["results"] = [];
        foreach ($results as $row) {
            array_push($response["results"], [
                "user" => $row["adopter_name"],
                "email" => $row["adopter_email"],
                "status" => $row['status_'],
            ]);
        }

        $response["success"] = true;
    }
}
// Check if the request method is POST
else if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if the required fields are set
    if (
        !isset($postData["email"]) || !isset($postData["password"])
        || empty($postData["email"]) || empty($postData["password"])
    ) {
        $response["failure"] = "Preencha todos os campos";
    }

    $email = filter_var($postData['email'], FILTER_SANITIZE_EMAIL);
    $password = htmlspecialchars($postData['password']);

    $db->connect();

    // Use prepared statements to prevent SQL injection
    $results = $db->select('adm', '*', "email_ = ? AND password_ = ?", [$email, $password]);

    if (count($results) > 0) {
        $results[0]["name_"];
        $results[0]["email_"];
    } else {
        $response['failure'] = 'Email ou senha inválido';
    }

} else {
    // Invalid request method
    $response['failure'] = 'Método de requisição inválido';
}

echo json_encode($response);
exit(0);