<?php
  require_once './data/orm.php';
  require_once 'contact.php';
  require_once 'country.php';
  session_start();

  if (!isset($_SESSION['user'])){
    header('Location: login.php');
    return;
  }

  $orm = new ORM();
  //obtenemos los contactos del usuario logeado
  $user_id = $_SESSION['user']['id'];
  $contact = new Contacts();
//   SELECT * FROM contacts WHERE user_id = 1;
  $contacts = $orm->findBy($contact,'user_id', $user_id);

  // Append country to each contact 
  foreach ($contacts as $key => $contact) {
    $country = new Countries();
    $country_name = $orm->getCountry($country, $contact['country_id']);
    $contacts[$key]['country'] = $country_name;
  }
?>