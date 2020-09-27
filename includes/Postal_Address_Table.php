<?php
namespace basic_postal_address_table;
use database\Database;

require_once('config.php');

 class class_postal_address_table {
    public function createTableIfNotExist()
    {
        $db = new \database\Database();

        if ($db->dbConnect()) {
            $query = "CREATE TABLE IF NOT EXISTS `restapi`.`posti_address` 
        ( `id` INT NOT NULL AUTO_INCREMENT , 
        `postal_code` VARCHAR(5) NOT NULL , 
        `postal_code_name_fi` INT(30) NOT NULL , 
        `postal_code_name_swe` INT(30) NULL , 
        `abbr_fi` INT(10) NULL , 
        `abbr_swe` INT(10) NULL , 
        `street_fi` INT(30) NULL ,
        `street_swe` INT(30) NULL ,
        `municipality_fi` INT(30) NULL , 
        `municipality_swe` INT(30) NULL , 
       
                
        PRIMARY KEY (`id`)) ;";

            $stmt = $db->dbConnect()->prepare($query);

            if ($stmt->execute()) {
                echo "Table created";
            } else {
                echo "Something went wrong could not create table";
            }
        } else {
            echo "Error occured !!";
        }
    }

}