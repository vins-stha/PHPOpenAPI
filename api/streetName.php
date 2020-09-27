<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../core/initialize.php');
include_once('../includes/config.php');

$db = new \database\Database();
$conn = $db->dbConnect();

$posti = new \posti\Posti($conn);

$posti->postal_code = isset($_POST['postal_code']) ? $_POST['postal_code'] : die();

$result = $posti->retrieveStreetName($posti->postal_code);

print_r(json_encode($result));