<?php
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once '../data/orm.php';
    }else{
        require_once './data/orm.php';
    }
    require_once 'contact.php';
    require_once 'country.php';
    // Check if the user is logged in
    session_start();
    if (!isset($_SESSION['user'])){
        header('Location: /templates/sitetemplante/login.php');
        return;
    }
    $id = $_GET["id"];
    $orm = new ORM();
    $statement = $orm->findBy(new Contacts(), 'id', $id);

    $countries = $orm->all(new Countries());
    if (empty($statement)){
        http_response_code(404);
        echo("HTTP 404 NOT FOUND");
        return;
    }

    $contact = $statement[0];
    if ($contact['user_id'] != $_SESSION['user']['id']){
        http_response_code(403);
        die('HTTP 403 Forbidden');
    }


    $error = null;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"]) || empty($_POST["phone_number"] || empty($_POST["country_id"] || empty($_POST["city"])))) {
            $error = "Please fill all the fields.";
        } else if (strlen($_POST["phone_number"]) < 9) {
            $error = "Phone number must be at least 9 characters.";
        } else {
            $name = $_POST["name"];
            $phoneNumber = $_POST["phone_number"];
            //id in the url
            $contact = new Contacts($name, $_SESSION['user']['id'], $phoneNumber, $_POST["country_id"], $_POST["city"]);
            $orm->update($contact, $id);
            //flash message
            $_SESSION['flash'] = ["message" => "Contact {$_POST['name']} updated."];
            header("Location: /Joomla/templates/sitetemplante/home.php"); // Redirect to the index page
            return; //Cerramos ejecucion hacia abajo
        }
    }
?>