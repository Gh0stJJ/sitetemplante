<?php
require_once '../data/orm.php';
require 'country.php';

header('Content-Type: application/json');

$orm = new ORM();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $country = $orm->findBy(new Countries(),'id', $id);
    if ($country) {
        echo json_encode($country[0]);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Country not found']);
    }
} else {
    ob_clean();
    $countries = $orm->all(new Countries());
    echo json_encode($countries);
}
?>

