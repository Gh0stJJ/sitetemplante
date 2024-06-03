<?php
  
    require_once './data/orm.php';
    require_once 'user.php';
    $error = null;
    $orm = new ORM();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
        $error = "Name is required";
        } else if (empty($_POST["email"])) {
        $error = "Email is required";
        } else if (empty($_POST["password"])) {
        $error = "Password is required";
        } else {
            $statement = $orm->findBy(new Users(), "email", $_POST["email"]);
        // Check if email already exists
        if (sizeof($statement) > 0) {
            $error = "Email already exists"; 
        }
        $statement = null;
        // Check if name already exists
        $statement = $orm->findBy(new Users(), "name", $_POST["name"]);
        if (sizeof($statement) > 0) {
            $error = "Name already exists";
        }
        $statement = null;
        if (!$error) {
            
            $user = $orm->insert(new Users($_POST["name"], $_POST["email"], password_hash($_POST["password"], PASSWORD_BCRYPT)));
            $user = $orm->findBy(new Users(), "email", $_POST["email"])[0];

            session_start();
            $_SESSION['user'] = $user; //Coockie
            header("Location: /Joomla/index.php");
        } 
        }
        
    }

?>