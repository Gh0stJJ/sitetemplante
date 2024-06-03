<?php
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once '../data/orm.php';
    }else{
        require_once './data/orm.php';
    }

    require 'user.php';
    require 'contact.php';
    require 'country.php';
    // Check if the user is logged in
    session_start();
    if (!isset($_SESSION['user'])){
        header('Location: login.php');
        return;
    }

    $error = null;
    $orm = new ORM();
    $countries = $orm->all(new Countries());

    if(sizeof($countries) == 0){
        $error = "No countries found, add a country";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $error = "Name is required";
        } else if (empty($_POST["phone_number"])) {
            $error = "Phone number is required";
        }else if (!preg_match("/^[0-9]{10}$/", $_POST["phone_number"])) {
            $error = "Phone number must be 10 digits";
        }else if (empty($_POST["country"])) {
            $error = "Country is required";
        }else if ($_POST["country"] == "0") {
            $error = "Select a valid country";
        }else if ($_POST["cities"] == "0") {
            $error = "Select a city";
        }else {
            $name = $_POST["name"];
            $phone_number = $_POST["phone_number"];
            $country = $_POST["country"];
            $city = $_POST["cities"];


            $contact = new Contacts($name, $_SESSION['user']['id'], $phone_number,$_POST["country"], $city);
            $orm->insert($contact);

            //flash message
            $_SESSION['flash'] = ["message" => "Contact {$_POST['name']} added."];
            header("Location: ../add.php"); // Redirect to the index page
            return;
        }
        

    }

?>