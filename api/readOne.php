<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../core/initialize.php');
include_once('../includes/config.php');

$db = new \database\Database();
$conn = $db->dbConnect();

$posti = new \posti\Posti($conn);

$posti->id = isset($_POST['id']) ? $_POST['id'] : die();

$result = $posti->retrieveOne();

$posti_item = array(
    'id' => $posti->id,
    'postal_code' => $posti->postal_code,
    'postal_code_name_fi' => $posti->postal_code_name_fi,
    'postal_code_name_swe' => $posti->postal_code_name_swe,
    'abbr_fi' => $posti->abbr_fi,
    'abbr_swe' => $posti->abbr_swe,
    'street_fi' => $posti->street_fi,
    'street_swe'=> $posti->street_swe,
    'municipality_fi' => $posti->municipality_fi,
    'municipality_swe' => $posti->municipality_swe
);

print_r(json_encode($posti_item));