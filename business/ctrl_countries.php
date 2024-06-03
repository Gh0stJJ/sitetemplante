<?php
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        require_once './data/orm.php';
    }else{
        require_once '../data/orm.php';
    }
    require 'country.php';
    session_start();
    $error = null;

    if (!isset($_SESSION['user'])){
        header('Location: /templates/sitetemplante/login.php');
        return;
    }
    $orm = new ORM();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            http_response_code(400);
            echo json_encode(['error' => 'Name is required']);
        } else {
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            $name = $_POST["name"];
            $country = new Countries();
            $country->name = $name;
    
            if ($id) {
                $country->id = $id;
                $orm->update($country);
                http_response_code(200);
                echo json_encode(['success' => 'Country updated successfully']);
            } else {
                $orm->insert($country);
                http_response_code(200);
                echo json_encode(['success' => 'Country added successfully']);
            }
        }
    }else if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
        parse_str(file_get_contents("php://input"), $data);
        $id = $data['id'];
        $country = new Countries();
        $country->id = $id;
        $orm->delete($country);
        http_response_code(200);
        echo "Country deleted successfully";
        
    }else if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
        $id = $_GET['id'];
        $country = new Countries();
        $country->id = $id;
        $country = $orm->find($country);
        echo json_encode($country);

    }

?>