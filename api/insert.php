<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, X-Requested-With');

include_once('../core/initialize.php');

$db = new Database();
$conn = $db->dbConnect();

$posti = new \posti\Posti($conn);

//Get data
$data = json_decode(file_get_contents("php://input"));

$posti->postal_code = $data->postal_code;
$posti->postal_code_name_fi = $data->postal_code_name_fi;
$posti->postal_code_name_swe = $data->postal_code_name_swe;
$posti->abbr_fi = $data->abbr_fi;
$posti->abbr_swe = $data->abbr_swe;
$posti->street_fi = $data->street_fi;
$posti->street_swe = $data->street_swe;
$posti->municipality_fi = $data->municipality_fi;
$posti->municipality_swe = $data->municipality_swe;


if ($posti->insert()) {
    echo json_encode(array('message' => 'Address Registered'));
} else {

    echo json_encode(array('message' => 'Something went wrong!'));
}
