<?php
  require_once '../data/orm.php';
  require_once 'contact.php';
  session_start();
  if (!isset($_SESSION['user'])){
    header('Location: login.php');
    return;
  }
  //Diccionario de datos enviados por la URL usando GET
  $id = $_GET['id']; //Obtenemos el id del contacto a eliminar
  $orm = new ORM();
  //Comprobamos que exista el id
  $statement =  $orm->findBy(new Contacts(), 'id', $id);
  if (empty($statement)) {
    http_response_code(404);
    die('HTTP 404 Contact not found');
  }

  //Avoid deleting contacts that do not belong to the user
  $contact = $statement[0];
  if ($contact['user_id'] != $_SESSION['user']['id']){
    http_response_code(403);
    die('HTTP 403 Forbidden');
  }
  // delete contact
  $del_contact = new Contacts();
  $del_contact->id = $id;
  $orm->delete($del_contact);
  
  //flash message
  $_SESSION['flash'] = ["message" => "Contact {$_POST['name']} deleted."];
  header("Location: /Joomla/templates/sitetemplante/home.php"); // Redirect to the index page
  return; //Cerramos ejecucion hacia abajo

?>