<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../core/initialize.php');
include_once('../includes/config.php');

$db = new \database\Database();
$conn = $db->dbConnect();

$posti = new \posti\Posti($conn);

$result = $posti->retreiveAll();

$num = $result->rowCount();

if($num > 0)
{
    $posti_array = array();
    $posti_array['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        extract($row);
        $item = array(
            'id' => $id,
            'postal_code' => $postal_code,
            'postal_code_name_fi' => $postal_code_name_fi,
            'postal_code_name_swe' => $postal_code_name_swe,
            'abbr_fi' => $abbr_fi,
            'abbr_swe' => $abbr_swe,
            'street_fi' => $street_fi,
            'street_swe'=> $street_swe,
            'municipality_fi' => $municipality_fi,
            'municipality_swe' => $municipality_swe
        );
        array_push($posti_array['data'], $item);
    }
    echo json_encode($posti_array);
} else {
    echo json_encode(array('message' => 'No records found'));
}


