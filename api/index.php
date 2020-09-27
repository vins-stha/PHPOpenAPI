<?php
require_once('../includes/importDataFromFile.php');
require_once('config.php');
require_once('../includes/Postal_Address_Table.php');


$db = new \database\Database();

$create_table = new \basic_postal_address_table\class_postal_address_table();
try {
    $create_table->createTableIfNotExist();
} catch (Exception $e) {
    printf('Could not create table %s', $e->getMessage());
}

$readFromFile = new \importDataFromFile\importDataFromFile();
$readFromFile->readFromFile();